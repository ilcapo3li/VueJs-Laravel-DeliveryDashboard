<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run() {
		$this->call(UsersSeeder::class);
		$this->call(PermissionsSeeder::class);
		// DB::unprepared(file_get_contents(app_path('/data/cities.sql')));
	}
}
