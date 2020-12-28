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
            'name' => 'Super',
            'password' => '123456',
            'email' => 'super@super.com',
            'role_id' => 1,
            'phonePrimary' => '02123153933',
        ]);
    
        User::create([
            'name' => 'Admin',
            'password' => '123456',
            'email' => 'admin@admin.com',
            'role_id' => 2,
            'phonePrimary' => '03223153933',
        ]);
    }
}
