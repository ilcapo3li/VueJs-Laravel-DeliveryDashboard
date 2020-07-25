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
		array_push($permissions,

			
		
		/////////////////////////////Super Admin Permission and Operation////////////////////////////////
		 ['en_name' => 'Update Settings', 'ar_name' => 'تعديل الاعدادت', 'role_id' => '1'],
		 ['en_name' => 'View Settings', 'ar_name' => 'مشاهده الاعدادت', 'role_id' => '1'],
		 ['en_name' => 'Update ADS', 'ar_name' => '', 'role_id' => '1'],
		 ['en_name' => 'View ADS', 'ar_name' => '', 'role_id' => '1'],
		 ['en_name' => 'Update ADS', 'ar_name' => '', 'role_id' => '1'],
		 ['en_name' => 'View ADS', 'ar_name' => '', 'role_id' => '1'],
		 ['en_name' => 'Send Notify', 'ar_name' => 'ارسال اشعار', 'role_id' => '1'],
		 ['en_name' => 'Super Dashboard', 'ar_name' => '' ,'role_id' => '1'],
		////////////////////////////////////////////////////////////////////////////////////////////////
		 ['en_name' => 'View Companies', 'ar_name' => '', 'role_id' => '1'],
		 ['en_name' => 'Save Company', 'ar_name' => '', 'role_id' => '1'],
		 ['en_name' => 'Update Company', 'ar_name' => '', 'role_id' => '1'],
		 ['en_name' => 'Delete Company', 'ar_name' => '', 'role_id' => '1'],
		////////////////////////////////////////////////////////////////////////////////////////////////
		 ['en_name' => 'View Countries', 'ar_name' => '', 'role_id' => '1'],
		 ['en_name' => 'Save Country', 'ar_name' => '', 'role_id' => '1'],
		 ['en_name' => 'Update Country', 'ar_name' => '', 'role_id' => '1'],
		 ['en_name' => 'Delete Country', 'ar_name' => '', 'role_id' => '1'],
		 ////////////////////////////////////////////////////////////////////////////////////////////////
		 ['en_name' => 'View Currencies', 'ar_name' => '', 'role_id' => '1'],
		 ['en_name' => 'Save Currency', 'ar_name' => '', 'role_id' => '1'],
		 ['en_name' => 'Update Currency', 'ar_name' => '', 'role_id' => '1'],
		 ['en_name' => 'Delete Currency', 'ar_name' => '', 'role_id' => '1'],
		////////////////////////////////////////////////////////////////////////////////////////////////
		 ['en_name' => 'View Cities', 'ar_name' => '', 'role_id' => '1'],
		 ['en_name' => 'Save City', 'ar_name' => '', 'role_id' => '1'],
		 ['en_name' => 'Update City', 'ar_name' => '', 'role_id' => '1'],
		 ['en_name' => 'Delete City', 'ar_name' => '', 'role_id' => '1'],
		////////////////////////////////////////////////////////////////////////////////////////////////
		 ['en_name' => 'View Powers', 'ar_name' => '', 'role_id' => '1'],
		 ['en_name' => 'Save Power', 'ar_name' => '', 'role_id' => '1'],
		 ['en_name' => 'Update Power', 'ar_name' => '', 'role_id' => '1'],
		 ['en_name' => 'Delete Power', 'ar_name' => '', 'role_id' => '1'],
		////////////////////////////////////////////////////////////////////////////////////////////////
		 ['en_name' => 'View SubscriptionTypes', 'ar_name' => '', 'role_id' => '1'],
		 ['en_name' => 'Save SubscriptionType', 'ar_name' => '', 'role_id' => '1'],
		 ['en_name' => 'Update SubscriptionType', 'ar_name' => '', 'role_id' => '1'],
		 ['en_name' => 'Delete SubscriptionType', 'ar_name' => '', 'role_id' => '1'],
		////////////////////////////////////////////////////////////////////////////////////////////////
		 ['en_name' => 'View Subscriptions', 'ar_name' => '', 'role_id' => '1'],
		 ['en_name' => 'print Subscriptions', 'ar_name' => '', 'role_id' => '1'],
		///////////////////////////////////////////End Super Admin Permission and Operation/////////////////////////////////////////////////////
		/////////////////////////////////////////////Start Power Permission and Operation///////////////////////////////////////////////////
		 ['en_name' => 'View Reports', 'ar_name' => 'مشاهده البلاغات', 'role_id' => '7'],
		 ['en_name' => 'Update Reports', 'ar_name' => '', 'role_id' => '7'],
		 ['en_name' => 'View Dashboard', 'ar_name' => '' ,'role_id' => '7'],
		////////////////////////////////////////////////////////////////////////////////////////////////
		 ['en_name' => 'View Admins', 'ar_name' => '', 'role_id' => '7'],
		 ['en_name' => 'Save Admin', 'ar_name' => '', 'role_id' => '7'],
		 ['en_name' => 'Update Admin', 'ar_name' => '', 'role_id' => '7'],
		 ['en_name' => 'Delete Admin', 'ar_name' => '', 'role_id' => '7'],
		/////////////////////////////////////////////////////////////////////////////////////////////////
		 ['en_name' => 'View Tayar', 'ar_name' => '', 'role_id' => '7'],
		 ['en_name' => 'Save Tayar', 'ar_name' => '', 'role_id' => '7'],
		 ['en_name' => 'Update Tayar', 'ar_name' => '', 'role_id' => '7'],
		 ['en_name' => 'Delete Tayar', 'ar_name' => '', 'role_id' => '7'],
		/////////////////////////////////////////////////////////////////////////////////////////////////
		 ['en_name' => 'View Agents', 'ar_name' => '', 'role_id' => '7'],
		 ['en_name' => 'Save Agent', 'ar_name' => '', 'role_id' => '7'],
		 ['en_name' => 'Update Agent', 'ar_name' => '', 'role_id' => '7'],
		 ['en_name' => 'Delete Agent', 'ar_name' => '', 'role_id' => '7'],
		 /////////////////////////////////////////////////////////////////////////////////////////////////
		 ['en_name' => 'View Suppliers', 'ar_name' => '', 'role_id' => '7'],
		 ['en_name' => 'Save Supplier', 'ar_name' => '', 'role_id' => '7'],
		 ['en_name' => 'Update Supplier', 'ar_name' => '', 'role_id' => '7'],
		 ['en_name' => 'Delete Supplier', 'ar_name' => '', 'role_id' => '7'],
		 /////////////////////////////////////////////////////////////////////////////////////////////////
		 ['en_name' => 'View Leads', 'ar_name' => '', 'role_id' => '7'],
		 ['en_name' => 'Save Lead', 'ar_name' => '', 'role_id' => '7'],
		 ['en_name' => 'Update Lead', 'ar_name' => '', 'role_id' => '7'],
		 ['en_name' => 'Delete Lead', 'ar_name' => '', 'role_id' => '7'],





		 ['en_name' => 'Delete Tayar', 'ar_name' => '', 'role_id' => '7']
		
	);
		
		\DB::table('permissions')->insert($permissions);
	}
}
