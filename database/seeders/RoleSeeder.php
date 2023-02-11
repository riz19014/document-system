<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id'    => 1,
                'title' => 'Admin',
            ],
            [
                'id'    => 2,
                'title' => 'Editor',
            ],
            [
                'id'    => 3,
                'title' => 'Viewer',
            ],
            [
                'id'    => 4,
                'title' => 'Super Admin',
            ],
        ];

        Role::insert($roles);
    }
}
