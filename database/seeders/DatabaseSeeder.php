<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolSeeder::class,
            // Add other seeders here
        ]);
        // \App\Models\User::factory(10)->create();
        $this->call([
            UserSedder::class,
            // Add other seeders here
        ]);
        $this->call([
            CategoriaSeeder::class,
            // Add other seeders here
        ]);
    }
}
