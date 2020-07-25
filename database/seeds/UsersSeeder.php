<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Agent',
            'password' => '123456',
            'email' => 'agent@agent.com',
            'role_id' => 1,
        ]);

        User::create([
            'name' => 'Admin',
            'password' => '123456',
            'email' => 'admin@admin.com',
            'role_id' => 2,
        ]);

        User::create([
            'name' => 'Super',
            'password' => '123456',
            'email' => 'super@super.com',
            'role_id' => 4,
        ]);

        User::create([
            'name' => 'Tayar',
            'password' => '123456',
            'email' => 'tayar@tayar.com',
            'role_id' => 5,
        ]);

        User::create([
            'name' => 'Supplier',
            'password' => '123456',
            'email' => 'supplier@supplier.com',
            'role_id' => 2,
        ]);

        User::create([
            'name' => 'Lead1',
            'created_by' => '5',
            'password' => '123456',
            'email' => 'lead1@lead.com',
            'phonePrimary' => '01023153933',
            'role_id' => 6,
        ]);
        User::create([
            'name' => 'Lead2',
            'created_by' => '1',
            'password' => '123456',
            'email' => 'lead2@lead.com',
            'phonePrimary' => '01155207824',
            'role_id' => 6,
        ]);
    }
}
