<?php

use Illuminate\Database\Seeder;
use App\Admin ; 

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'superAdmin',
            'password' => '123456',
            'email' => 'superAdmin@admin.com',
            'phonePrimary' => '01124523153933',
            'role_id' => 1 ,
        ]);

        Admin::create([
            'name' => 'Admin',
            'password' => '123456',
            'email' => 'admin@admin.com',
            'phonePrimary' => '011231564313933',
            'role_id' => 2 ,
        ]);
    }
}
