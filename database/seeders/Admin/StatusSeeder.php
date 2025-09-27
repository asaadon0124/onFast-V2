<?php

namespace Database\Seeders\Admin;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StatusSeeder extends Seeder
{

     public function run()
    {
        $statuses = [
            ['name' => 'داخل الشركة'],
            ['name' => 'خرج للشحن'],
            ['name' => 'تم رفضه'],
            ['name' => 'تاجيل'],
            ['name' => 'تم التوصيل'],
            ['name' => 'تم التحصيل'],
            ['name' => 'تم تسليم المرتجع للعميل'],
        ];

        // اضف التوقيت
        $now = now();
        foreach ($statuses as &$status) {
            $status['created_at'] = $now;
            $status['updated_at'] = $now;
        }

        // تخزين في الداتا بيز
        DB::table('status')->insert($statuses);

        // تخزين في الكاش
        Cache::forever('statuses', DB::table('status')->get());
    }
    // public function run()
    // {
    //     DB::table('status')->insert(
    //         [
    //             [
    //                 'name' => 'داخل الشركة',
    //                 'created_at' => date('Y-m-d H:i:s'),
    //                 'updated_at' => date('Y-m-d H:i:s'),
    //             ],
    //             [
    //                 'name' => 'خرج للشحن',
    //                 'created_at' => date('Y-m-d H:i:s'),
    //                 'updated_at' => date('Y-m-d H:i:s'),
    //             ],
    //             [
    //                 'name' => 'تم رفضه',
    //                 'created_at' => date('Y-m-d H:i:s'),
    //                 'updated_at' => date('Y-m-d H:i:s'),
    //             ],
    //             [
    //                 'name' => 'تاجيل',
    //                 'created_at' => date('Y-m-d H:i:s'),
    //                 'updated_at' => date('Y-m-d H:i:s'),
    //             ],
    //             [
    //                 'name' => 'تم التوصيل',
    //                 'created_at' => date('Y-m-d H:i:s'),
    //                 'updated_at' => date('Y-m-d H:i:s'),
    //             ],
    //             [
    //                 'name' => 'تم التحصيل',
    //                 'created_at' => date('Y-m-d H:i:s'),
    //                 'updated_at' => date('Y-m-d H:i:s'),
    //             ],
    //             [
    //                 'name' => 'تم تسليم المرتجع للعميل',
    //                 'created_at' => date('Y-m-d H:i:s'),
    //                 'updated_at' => date('Y-m-d H:i:s'),
    //             ],
    //         ]);
    // }
}
