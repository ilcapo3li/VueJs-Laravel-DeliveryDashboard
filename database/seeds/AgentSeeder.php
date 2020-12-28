<?php

use App\Agent;
use Illuminate\Database\Seeder;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Agent::create([
            'name' => 'Agent',
            'password' => '123456',
            'email' => 'agent@agent.com',
            'phonePrimary' => '01123153933',
        ]);
    }
}
