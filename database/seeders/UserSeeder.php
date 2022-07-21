<?php

namespace Database\Seeders;

use App\Models\Limit;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'role' => 'Admin',
        ]);
        User::create([
            'name' => 'Suep',
            'email' => 'petani@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'Petani',
        ]);
        User::create([
            'name' => 'Tono',
            'email' => 'tengkulak@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'Tengkulak',
        ]);
        Limit::create([
            "limit" => "0",
        ]);
    }
}
