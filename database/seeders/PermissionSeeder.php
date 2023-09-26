<?php

namespace Database\Seeders;

use App\Consts\PermissionGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function getData()
    {
        return [
            [
                'group' => PermissionGroup::DASHBOARD,
                'permissions' => [
                    ['name' => 'access-dashboard', 'label' => 'Accéder au tableau de bord'],
                ]
            ],
        ];
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->getData() as $data) {
            foreach ($data['permissions'] as $permission) {
                Permission::updateOrCreate([
                    'name' => $permission['name'],
                ], [
                    'guard_name' => 'web',
                    'group' => $data['group'],
                    'label' => $permission['label'],
                ]);
            }
        }
    }
}
