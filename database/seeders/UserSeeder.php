<?php

namespace Database\Seeders;

use App\Models\Land;
use App\Models\Limit;
use App\Models\PlantType;
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
        PlantType::create([
            'name' => 'Bawang Merah',
        ]);
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'role' => 'Admin',
        ]);
        User::create([
            'name' => 'Saiful Bahri',
            'email' => 'saiful@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'Petani',
        ]);
        User::create([
            'name' => 'Rahyit',
            'email' => 'rahyit@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'Petani',
        ]);
        User::create([
            'name' => 'Abdullah',
            'email' => 'dulla@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'Petani',
        ]);
        User::create([
            'name' => 'Rapik',
            'email' => 'rapik@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'Tengkulak',
            'lattitude' => "113.5267590",
            'longitude' => "-7.7091710",
        ]);
        User::create([
            'name' => 'Tengkulak',
            'email' => 'tengkulak@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'Tengkulak',
            'lattitude' => "113.5277590",
            'longitude' => "-7.7092710",
        ]);
        Land::create([
            'name' => "Lahan 1",
            'lattitude' => "113.5193120",
            'longitude' => "-7.7208140",
            'status' => "Proses Tanam",
            'large' => "250",
            'user_id' => 1,
            'plant_type_id' => 1,
        ]);
        Land::create([
            'name' => "Lahan 2",
            'lattitude' => 113.519457,
            'longitude' => -7.720265,
            'status' => "Proses Tanam",
            'large' => "125",
            'user_id' => 1,
            'plant_type_id' => 1,
        ]);
        Land::create([
            'name' => "Lahan 3",
            'lattitude' => 113.5227927,
            'longitude' => -7.7104989,
            'status' => "Proses Tanam",
            'large' => "250",
            'user_id' => 2,
            'plant_type_id' => 1,
        ]);
        Land::create([
            'name' => "Lahan 4",
            'lattitude' => 113.5227954,
            'longitude' => -7.7112598,
            'status' => "Proses Tanam",
            'large' => "250",
            'user_id' => 2,
            'plant_type_id' => 1,
        ]);
        Land::create([
            'name' => "Lahan 5",
            'lattitude' => 113.5227890,
            'longitude' => -7.7105448,
            'status' => "Proses Tanam",
            'large' => "350",
            'user_id' => 3,
            'plant_type_id' => 1,
        ]);
        Limit::create([
            "limit" => "0",
        ]);
    }
}
