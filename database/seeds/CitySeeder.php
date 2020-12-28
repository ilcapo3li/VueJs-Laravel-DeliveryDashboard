<?php

use Illuminate\Database\Seeder;
use App\City;


class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('cities')->delete();
        // $json = File::get('database/data/cities.json');
        // foreach (json_decode($json) as $row) {
        //     City::Create([
        //     'en_name' => $row->en_country,
        //     'ar_name' => $row->ar_country,
        //    ]);
        // }
        City::create([
            'en_name' => 'Alexandria',
            'ar_name' => 'الاسكندرية',
            'country_id' => 64,
        ]);
    }
}
