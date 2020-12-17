<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run() {
		$this->call(RoleSeeder::class);
		$this->call(UsersSeeder::class);
		$this->call(AdminSeeder::class);
		$this->call(AgentSeeder::class);
		$this->call(LeadSeeder::class);
		$this->call(RepresentativeSeeder::class);
		$this->call(LocationsSeeder::class);
		$this->call(CountrySeeder::class);
		// $this->call(CitySeeder::class);
		$this->call(PermissionsSeeder::class);
		
		// DB::unprepared(file_get_contents(app_path('/data/cities.sql')));
	}
}
