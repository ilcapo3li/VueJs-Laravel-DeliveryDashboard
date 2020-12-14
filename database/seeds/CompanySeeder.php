<?php
use App\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'name' => 'Company',
            'password' => '123456',
            'email' => 'company@company.com',
            'phonePrimary' => '01223153933',
        ]);
    }
}
