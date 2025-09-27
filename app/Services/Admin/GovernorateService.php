<?php

namespace App\Services\Admin;

use App\Models\Governorate;
use App\Admin\GovernorateInterface;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\LengthAwarePaginator;

class GovernorateService implements GovernorateInterface
{
    private const CACHE_KEY = 'governorates';

    public function index($search = null)
    {
        $governorates = $this->getGovernoratesFromCache();

        if ($search)
        {
            $governorates = $governorates->filter(function ($governorate) use ($search)
            {
                return str_contains(strtolower($governorate->name), strtolower($search));
            });
        }

        return $this->paginate($governorates, PAGINATION_PER_PAGE);
    }

    public function create($data)
    {
        $data['created_by'] = auth('admin')->id();
        $data['updated_by'] = auth('admin')->id();
        $data['date']       = now()->toDateString();

        $governorate = Governorate::create($data);

        $this->recacheGovernorates();

        return $governorate;
    }

    public function find($id)
    {
        return $this->getGovernoratesFromCache()->firstWhere('id', $id) ?? Governorate::findOrFail($id);
    }

    public function update($data, Governorate $governorate)
    {
        $data['updated_by'] = auth('admin')->id();
        $data['date'] = now()->toDateString();

        $governorate->update($data);

        $this->recacheGovernorates();

        return $governorate;
    }

    public function delete($id)
    {
        $governorate = Governorate::findOrFail($id);
        $result = $governorate->delete();

        $this->recacheGovernorates();

        return $result;
    }

    private function getGovernoratesFromCache()
    {
        return Cache::rememberForever(self::CACHE_KEY, function ()
        {
            return Governorate::with('adminCreate')->latest()->get();
        });
    }

    private function recacheGovernorates()
    {
        Cache::forget(self::CACHE_KEY);
        return $this->getGovernoratesFromCache();
    }

    private function paginate($items, $perPage)
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentItems = $items->slice(($currentPage - 1) * $perPage, $perPage)->values();
        $paginator = new LengthAwarePaginator($currentItems, $items->count(), $perPage, $currentPage,
        [
            'path' => LengthAwarePaginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);

        return $paginator;
    }
}
