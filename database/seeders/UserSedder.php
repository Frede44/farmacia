<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user =User::create([
            'name' => "admin",
            'email' => "admin@gmail.com",
            'password' => bcrypt("admin123"),
        ])->assignRole("Administrador");


    }
}
