<?php

namespace Database\Seeders\Admin;

use App\Models\Governorate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ------------ 1-----------
        Governorate::create(
            [
                'name' => 'القاهرة',
                'status' => 'active',
                'created_by' => 1,
                'updated_by' => 1,

            ]);


        // ---------------- 2 -----------------
        Governorate::create(
            [
                'name' => 'الجيزة',
                'status' => 'active',
                'created_by' => 1,
                'updated_by' => 1,

            ]);

        // ---------------- 3 -----------------
        Governorate::create(
            [
                'name' => 'الاسكندرية',
                'status' => 'active',
                'created_by' => 1,
                'updated_by' => 1,


            ]);

        // ---------------- 4 -----------------
        Governorate::create(
            [
                'name' => 'الدقهلية',
                'status' => 'active',
                'created_by' => 1,
                'updated_by' => 1,
            ]);

        // ---------------- 5 -----------------
        Governorate::create(
            [
                'name' => 'البحيرة',
                'status' => 'active',
                'created_by' => 1,
                'updated_by' => 1,
            ]);

        // ---------------- 6 -----------------
        Governorate::create(
            [
                'name' => 'المنوفية',
                'status' => 'active',
                'created_by' => 1,
                'updated_by' => 1,
            ]);

        // ---------------- 7 -----------------
        Governorate::create(
            [
                'name' => 'المنيا',
                'status' => 'active',
                'created_by' => 1,
                'updated_by' => 1,
            ]);
    }
}
