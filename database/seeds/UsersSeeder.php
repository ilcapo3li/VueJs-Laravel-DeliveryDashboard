<?php

use App\ApiKey;
use App\Branch;
use App\Lead;
use App\Role;
use App\User;
use App\Currency;
use App\DeliverySetting;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {

		Role::create([
			'name' => 'Agent',
		]);

		Role::create([
			'name' => 'Supplier',
		]);

		Role::create([
			'name' => 'Admin',
		]);

		Role::create([
			'name' => 'Super',
		]);

		Role::create([
			'name' => 'Tayar',
		]);

		ApiKey::create([
			'token' => 'pc',
		]);

		User::create([
			'name' => 'Agent',
			'password' => '123456',
			'email' => 'agent@agent.com',
			'role_id' => 1,
		]);

		User::create([
			'name' => 'Admin',
			'password' => '123456',
			'email' => 'admin@admin.com',
			'role_id' => 2,
		]);

		User::create([
			'name' => 'Super',
			'password' => '123456',
			'email' => 'super@super.com',
			'role_id' => 3,
		]);

		User::create([
			'name' => 'Tayar',
			'password' => '123456',
			'email' => 'tayar@tayar.com',
			'role_id' => 4,
		]);

		User::create([
			'name' => 'Supplier',
			'password' => '123456',
			'email' => 'supplier@supplier.com',
			'role_id' => 5,
		]);

		Lead::create([
			'name' => 'Lead1',
            'sender_id' => '5',
			'password' => '123456',
			'email' => 'lead1@lead.com',
            'phone' =>'01023153933',
            'address' =>'25 sidibesher Alexandria moustafa kamel',
            'location' =>   json_encode('{
                                "country_code": "EG",
                                "country_name": "Egypt",
                                "city": "Alexandria",
                                "postal": 21533,
                                "latitude": 24.6537,
                                "longitude": 46.7152,
                                "IPv4": "51.39.2.101",
                                "state": "Alexandria"
                                }');
		]);

        Lead::create([
            'name' => 'Lead2',
            'sender_id' => '1',
            'password' => '123456',
            'email' => 'lead2@lead.com',
            'phone' =>'01155207824',
            'address' =>'25 kom-eldeka Alexandria Foad street',
            'location' =>   json_encode('{
                                "country_code": "EG",
                                "country_name": "Egypt",
                                "city": "Alexandria",
                                "postal": 21426,
                                "latitude": 24.6537,
                                "longitude": 46.7152,
                                "IPv4": "51.39.2.231",
                                "state": "Alexandria"
                                }');
        ]);

		Branch::create([
			'application_name' => 'Region1',
			'firebase_token' => '',
		]);

		Branch::create([
			'application_name' => 'Region2',
			'firebase_token' => '',
		]);

         Currency::create([
            'ar_name' =>'نيه مصري',
            'en_name' =>'Egyptian Pound',
            'rate'='0.12'
            
        ]);

        DeliverySetting::create([
            'orderPrice' => 7.0,
            'kmCost' => 0.3,
            'mQubeCost' => 20.0,
            'kgCost' => 30.0,
            'retriveCost' => 40,
            'currency_id' => 1 
            
        ]);

	}
}
