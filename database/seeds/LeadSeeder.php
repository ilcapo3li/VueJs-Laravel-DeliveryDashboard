<?php

use App\Lead;
use Illuminate\Database\Seeder;

class LeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Leed::create([
            'name' => 'Lead1',
            'created_by' => '1',
            'password' => '123456',
            'email' => 'lead1@lead.com',
            'phonePrimary' => '01023153933',
        ]);

        Leed::create([
            'name' => 'Lead2',
            'created_by' => '1',
            'password' => '123456',
            'email' => 'lead2@lead.com',
            'phonePrimary' => '01155207824',
        ]);
    }
}
