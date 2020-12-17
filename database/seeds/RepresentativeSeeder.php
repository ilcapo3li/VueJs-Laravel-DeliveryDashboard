<?php
use App\Representative ; 
use Illuminate\Database\Seeder;

class RepresentativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Representative::create([
            'name' => 'Representative',
            'password' => '123456',
            'email' => 'representative@representative.com',
            'phonePrimary' => '01123154343933',
        ]);
    }
}
