<?php


use Illuminate\Support\Facades\Cache;
use App\Models\City;
use App\Models\Governorate;

define('PAGINATION_PER_PAGE', 2);

    function refreshGovernoratesCache()
    {
        // مسح الكاش القديم
        Cache::forget('governorates_all');



        // حفظ الكاش لمدة ساعة
        return $data = Cache::remember('governorates_all',60*60,function()
        {
            return $governorates = Governorate::with('cities')->get();
        });
    }

    function refreshCitiesCache()
    {
        $cities = City::with('governorate')->get(); // جلب كل المدن مع المحافظات
        Cache::put('cities_all', $cities, 60*60); // حفظ الكاش لمدة ساعة
    }

