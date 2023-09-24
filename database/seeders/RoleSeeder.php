<?php

namespace Database\Seeders;

use App\Consts\RoleName;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function getData()
    {
        return [
            [
                'name' => RoleName::ADMIN,
                'label' => "Administrateur",
                'permissions' => [
                    'access-dashboard',
                ],
            ],
        ];
    }

    /**
     * Run the database seeds
     */
    public function run(): void
    {
        foreach ($this->getData() as $data) {
            $role = Role::query()->updateOrCreate(
                [
                    'name' => $data['name']
                ],
                [
                    'guard_name' => 'web',
                    'name' => $data['name'],
                    'label' => $data['label'],
                ]
            );
            $role->syncPermissions($data['permissions']);
        }
    }
}
