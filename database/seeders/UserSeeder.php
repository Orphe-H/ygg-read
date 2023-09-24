<?php

namespace Database\Seeders;

use App\Consts\RoleName;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::updateOrCreate(
            [
                'email' => 'admin@ygg-read.com',
            ],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'approved' => true,
            ]
        );

        $admin->assignRole([RoleName::ADMIN]);
    }
}
