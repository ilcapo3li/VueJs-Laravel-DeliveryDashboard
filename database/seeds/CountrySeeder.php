<?php

use Illuminate\Database\Seeder;
use App\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $json = File::get('database/data/countries.json');
        foreach (json_decode($json) as $row) {
            Country::Create([
            'en_country' => $row->en_country,
            'ar_country' => $row->ar_country,
            'en_nationality' => $row->en_nationality,
            'ar_nationality' => $row->ar_nationality,
            'code' => $row->code,
           ]);
        }
    }
}
