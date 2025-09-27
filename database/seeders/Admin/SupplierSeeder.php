<?php

namespace Database\Seeders\Admin;

use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Supplier::create(
        [
            'name' => 'ahmed عميل',
            'governorate_id' => 1,
            'city_id' => 1,
            'adress'    => 'dswdfs',
            'phone'     => '0106001191',
            'status' => 'active',
            'created_by' => 1,
            'updated_by' => 1,
        ]);

        Supplier::create(
        [
            'name' => 'ali عميل',
            'governorate_id' => 1,
            'city_id' => 1,
            'adress'    => 'dsw',
            'phone'     => '01060001191',
            'status' => 'active',
            'created_by' => 1,
            'updated_by' => 1,
        ]);


        Supplier::create(
        [
            'name' => 'mohamed عميل',
            'governorate_id' => 1,
            'city_id' => 1,
            'adress'    => 'dsw',
            'phone'     => '01060',
            'status' => 'active',
            'created_by' => 1,
            'updated_by' => 1,
        ]);

    }
}
