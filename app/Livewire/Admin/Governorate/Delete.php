<?php

namespace App\Livewire\Admin\Governorate;

use Livewire\Component;
use App\Services\Admin\GovernorateService;
use App\Livewire\Admin\Governorate\Data;

class Delete extends Component
{
    protected $listeners = ['governorateDelete' => 'delete'];

    public function delete($id): void
    {
        $governorateService = app(GovernorateService::class);
        $governorate = $governorateService->find($id);

        if ($governorate) {
            $governorateService->delete($governorate->id);
            $this->dispatch('governoratesDeleteMS');
            $this->dispatch('refreshData')->to(Data::class);
        }
    }

    public function render()
    {
        return view('livewire.admin.governorate.delete');
    }
}