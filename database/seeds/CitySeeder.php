<?php

use Illuminate\Database\Seeder;
use App\Country;


class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->delete();
        $json = File::get('database/data/cities.json');
        foreach (json_decode($json) as $row) {
            Country::Create([
            'en_name' => $row->en_country,
            'ar_name' => $row->ar_country,
           ]);
        }
    }
}
