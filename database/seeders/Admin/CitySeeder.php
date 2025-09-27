<?php

namespace Database\Seeders\Admin;

use App\Models\City;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::create(
        [
            'name' => 'مدينة نصر',
            'governorate_id' => '1',
            'status' => 'active',
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        City::create(
            [
                'name' => 'القاهرة الجديدة',
                'governorate_id' => '1',
                'status' => 'active',
                'created_by' => 1,
                'updated_by' => 1,
            ]);

        City::create(
            [
                'name' => 'الهرم',
                'governorate_id' => '2',
                'status' => 'active',
                'created_by' => 1,
                'updated_by' => 1,
            ]);

        City::create(
            [
                'name' => 'فيصل',
                'governorate_id' => '2',
                'status' => 'active',
                'created_by' => 1,
                'updated_by' => 1,
            ]);

        City::create(
            [
                'name' => 'العصافرة',
                'governorate_id' => '3',
                'status' => 'active',
                'created_by' => 1,
                'updated_by' => 1,
            ]);

        City::create(
            [
                'name' => 'العجمي',
                'governorate_id' => '3',
                'status' => 'active',
                'created_by' => 1,
                'updated_by' => 1,
            ]);


        City::create(
        [
            'name' => 'المنصورة',
            'governorate_id' => '4',
            'status' => 'active',
            'created_by' => 1,
            'updated_by' => 1,
        ]);


        City::create(
            [
                'name' => 'سندوب',
                'governorate_id' => '4',
                'status' => 'active',
                'created_by' => 1,
                'updated_by' => 1,
            ]);

        City::create(
            [
                'name' => 'دمنهور',
                'governorate_id' => '5',
                'status' => 'active',
                'created_by' => 1,
                'updated_by' => 1,
            ]);


    City::create(
        [
            'name' => 'ايتاي البارود',
            'governorate_id' => '5',
            'status' => 'active',
            'created_by' => 1,
            'updated_by' => 1,
        ]);

    City::create(
        [
            'name' => 'شبين الكوم',
            'governorate_id' => '6',
            'status' => 'active',
            'created_by' => 1,
            'updated_by' => 1,
        ]);


        City::create(
            [
                'name' => 'اشمون',
                'governorate_id' => '6',
                'status' => 'active',
                'created_by' => 1,
                'updated_by' => 1,
            ]);

        City::create(
            [
                'name' => 'ملوي',
                'governorate_id' => '7',
                'status' => 'active',
                'created_by' => 1,
                'updated_by' => 1,
            ]);






    }
}
