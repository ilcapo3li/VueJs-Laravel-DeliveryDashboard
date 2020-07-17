<?php

use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$permissions = [];

		$edit_settings = ['en_name' => 'Edit Settings', 'ar_name' => 'تعديل الاعدادت'];
		$view_settings = ['en_name' => 'View Settings', 'ar_name' => 'مشاهده الاعدادت'];
		$send_notify = ['en_name' => 'Send Notify', 'ar_name' => 'ارسال اشعار'];
		$view_reports = ['en_name' => 'View Reports', 'ar_name' => 'مشاهده البلاغات'];
		// $view_orders = ['en_name' => 'View Orders', 'ar_name' => 'مشاهده البلاغات'];
		// $edit_orders = ['en_name' => 'Edit Orders', 'ar_name' => 'مشاهده البلاغات'];
		// $delete_orders = ['en_name' => 'View Reports', 'ar_name' => 'مشاهده البلاغات'];
		// $collect_orders = ['en_name' => 'View Reports', 'ar_name' => 'مشاهده البلاغات'];
		// $update_orders = ['en_name' => 'View Reports', 'ar_name' => 'مشاهده البلاغات'];
		// $view_leads_orders = ['en_name' => 'View Reports', 'ar_name' => 'مشاهده البلاغات'];
		// $update_leads_orders = ['en_name' => 'View Reports', 'ar_name' => 'مشاهده البلاغات'];

		array_push($permissions,

			$edit_settings,
			$view_settings,
			$send_notify,
			$view_reports,
			// $view_orders,
			// $edit_orders,
			// $delete_orders,
			// $collect_orders,
			// $update_orders
		);
		\DB::table('permissions')->insert($permissions);
	}
}
