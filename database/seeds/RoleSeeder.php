<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Role::create([
            'name' => 'Super',
        ]);

        Role::create([
            'name' => 'Admin',
        ]);

        Role::create([
            'name' => 'Supplier',
        ]);

        Role::create([
            'name' => 'Agent',
        ]);

        Role::create([
            'name' => 'Tayar',
        ]);

        Role::create([
            'name' => 'Lead',
        ]);

        Role::create([
            'name' => 'Power',
        ]);
        Role::create([
            'name' => 'SuperPower',
        ]);
    }
}
