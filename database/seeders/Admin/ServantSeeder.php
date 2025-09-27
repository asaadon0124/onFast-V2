<?php

namespace Database\Seeders\Admin;

use App\Models\Servant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Servant::create(
        [
            'name' => 'ahmed مندوب',
            'adress' => 'فيصل',
            'phone' => '010045878845454',
            'password' => bcrypt('ahmed1191'),
            'status' => 'active',
        ]);



        Servant::create(
        [
            'name' => 'علي مندوب',
            'adress' => 'فيصل',
            'phone' => '010045478845454',
            'password' => bcrypt('ahmed1191'),
            'status' => 'active',
        ]);


        Servant::create(
        [
            'name' => 'ميدو مندوب',
            'adress' => 'فيصل',
            'phone' => '0100458788475454',
            'password' => bcrypt('ahmed1191'),
            'status' => 'active',
        ]);
    }
}
