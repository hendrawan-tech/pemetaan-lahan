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
            'address' => 'Desa Sumberanyar RT 32 RW 5',
            'phone' => '08127364773'
        ]);
        User::create([
            'name' => 'Heri Yanto',
            'email' => 'heri@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'Petani',
            'address' => 'Desa Sumberanyar RT 30 RW 5',
            'phone' => '08234747344'
        ]);
        User::create([
            'name' => 'Muhammad Rahyit',
            'email' => 'rahyit@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'Petani',
            'phone' => '08232432233',
            'address' => 'Desa Sumberanyar RT 32 RW 5'
        ]);
        User::create([
            'name' => 'Abdullah',
            'email' => 'abdullah@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'Petani',
            'phone' => '08973643334',
            'address' => 'Desa Sumberanyar RT 32 RW 5'
        ]);
        User::create([
            'name' => 'Rapik Abdillah',
            'email' => 'rapik@gmail.com',
            'password' => Hash::make('password'),
            'address' => 'Desa Sumberanyar RT 32 RW 5',
            'phone' => '0824838748',
            'role' => 'Tengkulak',
            'lattitude' => "113.5267590",
            'longitude' => "-7.7091710",
        ]);
        User::create([
            'name' => 'Ridwan Basofi',
            'email' => 'ridwan@gmail.com',
            'password' => Hash::make('password'),
            'address' => 'Desa Sumberanyar RT 15 RW 2',
            'phone' => '08533847732',
            'role' => 'Tengkulak',
            'lattitude' => "113.527013",
            'longitude' => "-7.731907",
        ]);
        Land::create([
            'name' => "Lahan Saiful Bahri",
            'lattitude' => "113.5193120",
            'longitude' => "-7.7208140",
            'status' => "Proses Tanam",
            'large' => "250",
            'user_id' => 2,
            'plant_type_id' => 1,
        ]);
        Land::create([
            'name' => "Lahan Heri Yanto",
            'lattitude' => "113.5227954",
            'longitude' => "-7.7112598",
            'status' => "Proses Tanam",
            'large' => "350",
            'user_id' => 3,
            'plant_type_id' => 1,
        ]);
        Land::create([
            'name' => "Lahan M. Rahyit",
            'lattitude' => 113.5227927,
            'longitude' => -7.7104989,
            'status' => "Proses Tanam",
            'large' => "200",
            'user_id' => 4,
            'plant_type_id' => 1,
        ]);
        Land::create([
            'name' => "Lahan Abdullah",
            'lattitude' => 113.522042,
            'longitude' => -7.710701,
            'status' => "Proses Tanam",
            'large' => "250",
            'user_id' => 5,
            'plant_type_id' => 1,
        ]);
        Limit::create([
            "limit" => "0",
        ]);
    }
}
