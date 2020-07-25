<?php

use Illuminate\Database\Seeder;
use App\Location;

class LocationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Location::create([
            'user_id' => '2',

            'address' => '25 kom-eldeka Alexandria Foad street',
            'location' => '{
                                "country_code": "EG",
                                "country_name": "Egypt",
                                "city": "Alexandria",
                                "postal": 21426,
                                "latitude": 24.6537,
                                "longitude": 46.7152,
                                "IPv4": "51.39.2.231",
                                "state": "Alexandria"
                                }',
        ]);
        Location::create([
            'user_id' => '1',

            'address' => '25 kom-eldeka Alexandria Foad street',
            'location' => '{
                                "country_code": "EG",
                                "country_name": "Egypt",
                                "city": "Alexandria",
                                "postal": 21426,
                                "latitude": 24.6537,
                                "longitude": 46.7152,
                                "IPv4": "51.39.2.231",
                                "state": "Alexandria"
                                }',
        ]);
        Location::create([
            'user_id' => '5',

            'address' => '25 kom-eldeka Alexandria Foad street',
            'location' => '{
                                "country_code": "EG",
                                "country_name": "Egypt",
                                "city": "Alexandria",
                                "postal": 21426,
                                "latitude": 24.6537,
                                "longitude": 46.7152,
                                "IPv4": "51.39.2.231",
                                "state": "Alexandria"
                                }',
        ]);

        Location::create([
            'user_id' => '6',

            'address' => '25 kom-eldeka Alexandria Foad street',
            'location' => '{
                                "country_code": "EG",
                                "country_name": "Egypt",
                                "city": "Alexandria",
                                "postal": 21426,
                                "latitude": 24.6537,
                                "longitude": 46.7152,
                                "IPv4": "51.39.2.231",
                                "state": "Alexandria"
                                }',
        ]);
        Location::create([
            'user_id' => '7',

            'address' => '25 kom-eldeka Alexandria Foad street',
            'location' => '{
                                "country_code": "EG",
                                "country_name": "Egypt",
                                "city": "Alexandria",
                                "postal": 21426,
                                "latitude": 24.6537,
                                "longitude": 46.7152,
                                "IPv4": "51.39.2.231",
                                "state": "Alexandria"
                                }',
        ]);
    }
}
