<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\Admin\CitySeeder;
use Database\Seeders\Admin\loginSeeder;
use Database\Seeders\Admin\StatusSeeder;
use Database\Seeders\Admin\ServantSeeder;
use Database\Seeders\Admin\SupplierSeeder;
use Database\Seeders\Admin\GovernorateSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

            $this->call(
            [
                loginSeeder::class,
                StatusSeeder::class,
                GovernorateSeeder::class,
                CitySeeder::class,
                SupplierSeeder::class,
                ServantSeeder::class,
            ]);
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
