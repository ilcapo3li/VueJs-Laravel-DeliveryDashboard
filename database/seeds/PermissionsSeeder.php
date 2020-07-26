<?php

use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [];
        array_push($permissions,
        /////////////////////////////Super Admin Permission and Operation////////////////////////////////
         ['en_name' => 'Update Settings', 'ar_name' => 'تعديل الاعدادت', 'role_id' => '1'],
         ['en_name' => 'View Settings', 'ar_name' => 'مشاهده الاعدادت', 'role_id' => '1'],
         ['en_name' => 'Update ADS', 'ar_name' => 'تعديل الاعلانات', 'role_id' => '1'],
         ['en_name' => 'View ADS', 'ar_name' => 'مشاهدة الاعلانات', 'role_id' => '1'],
         ['en_name' => 'Send Notify', 'ar_name' => 'ارسال اشعار', 'role_id' => '1'],
         ['en_name' => 'Super Dashboard', 'ar_name' => 'لوحة البيانات', 'role_id' => '1'],
        ////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View Companies', 'ar_name' => 'مشاهدة الشركات', 'role_id' => '1'],
         ['en_name' => 'Save Company', 'ar_name' => 'انشاء الشركات', 'role_id' => '1'],
         ['en_name' => 'Update Company', 'ar_name' => 'تعديل الشركات', 'role_id' => '1'],
	   ['en_name' => 'Delete Company', 'ar_name' => 'حذف الشركات', 'role_id' => '1'],
         ['en_name' => 'print Companies', 'ar_name' => 'طباعة الشركات', 'role_id' => '1'],
	   
        ////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View Countries', 'ar_name' => 'مشاهدة الدول', 'role_id' => '1'],
         ['en_name' => 'Save Country', 'ar_name' => 'انشاء الدول', 'role_id' => '1'],
         ['en_name' => 'Update Country', 'ar_name' => 'تعديل الدول', 'role_id' => '1'],
         ['en_name' => 'Delete Country', 'ar_name' => 'حذف الدول', 'role_id' => '1'],
         ////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View Currencies', 'ar_name' => 'مشاهدة العملات', 'role_id' => '1'],
         ['en_name' => 'Save Currency', 'ar_name' => 'انشاء العملات', 'role_id' => '1'],
         ['en_name' => 'Update Currency', 'ar_name' => 'تعديل العملات', 'role_id' => '1'],
         ['en_name' => 'Delete Currency', 'ar_name' => 'حذف العملات', 'role_id' => '1'],
        ////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View Cities', 'ar_name' => 'مشاهدة المدن', 'role_id' => '1'],
         ['en_name' => 'Save City', 'ar_name' => 'انشاء المدن', 'role_id' => '1'],
         ['en_name' => 'Update City', 'ar_name' => 'تعديل المدن', 'role_id' => '1'],
         ['en_name' => 'Delete City', 'ar_name' => 'حذف المدن', 'role_id' => '1'],
        ////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View Powers', 'ar_name' => 'مشاهدة سوبر ادمن الشركات', 'role_id' => '1'],
         ['en_name' => 'Save Power', 'ar_name' => 'انشاء  سوبر ادمن الشركات', 'role_id' => '1'],
	   ['en_name' => 'Update Power', 'ar_name' => 'تعديل  سوبر ادمن الشركات', 'role_id' => '1'],
         ['en_name' => 'print Powers', 'ar_name' => 'طباعة ادمن الشركات', 'role_id' => '1'],
	   
         ////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View SuperPowers', 'ar_name' => 'مشاهدة سوبر ادمن التحكم', 'role_id' => '1'],
         ['en_name' => 'Save SuperPower', 'ar_name' => 'انشاء سوبر ادمن لوحة التحكم', 'role_id' => '1'],
         ['en_name' => 'Update SuperPower', 'ar_name' => 'تعديل سوبر ادمن التحكم', 'role_id' => '1'],
        ////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View SubscriptionTypes', 'ar_name' => 'مشاهدة انواع الاشتراكات', 'role_id' => '1'],
         ['en_name' => 'Save SubscriptionType', 'ar_name' => 'انشاء انواع الاشتراكات', 'role_id' => '1'],
         ['en_name' => 'Update SubscriptionType', 'ar_name' => 'تعديل انواع الاشتراكات', 'role_id' => '1'],
         ['en_name' => 'Delete SubscriptionType', 'ar_name' => 'حذف انواع الاشتراكات', 'role_id' => '1'],
         ////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View MaterialTypes', 'ar_name' => 'مشاهدة انواع المواد', 'role_id' => '1'],
         ['en_name' => 'Save MaterialType', 'ar_name' => 'انشاء انواع المواد', 'role_id' => '1'],
         ['en_name' => 'Update MaterialType', 'ar_name' => 'تعديل انواع المواد', 'role_id' => '1'],
         ['en_name' => 'Delete MaterialType', 'ar_name' => 'حذف انواع المواد', 'role_id' => '1'],
         ////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View DeliveryStatuses', 'ar_name' => 'مشاهدة حالات التوصيل', 'role_id' => '1'],
         ['en_name' => 'Save DeliveryStatus', 'ar_name' => 'انشاء حالات التوصيل', 'role_id' => '1'],
         ['en_name' => 'Update DeliveryStatus', 'ar_name' => 'تعديل حالات التوصيل', 'role_id' => '1'],
         ['en_name' => 'Delete DeliveryStatus', 'ar_name' => 'حذف حالات التوصيل', 'role_id' => '1'],
        ////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View Subscriptions', 'ar_name' => 'مشاهدة الاشتراكات', 'role_id' => '1'],
         ['en_name' => 'print Subscriptions', 'ar_name' => 'طباعة الاشتراكات', 'role_id' => '1'],
        ///////////////////////////////////////////End Super Admin Permission and Operation/////////////////////////////////////////////////////
        /////////////////////////////////////////////Start Power Permission and Operation///////////////////////////////////////////////////
         ['en_name' => 'View Reports', 'ar_name' => 'مشاهده البلاغات', 'role_id' => '7'],
         ['en_name' => 'Update Reports', 'ar_name' => 'تعديل البلاغات', 'role_id' => '7'],
         ['en_name' => 'View Dashboard', 'ar_name' => 'مشاهدة لوحة الشركة', 'role_id' => '7'],
        ////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View Admins', 'ar_name' => 'مشاهدة ادمن الشركة', 'role_id' => '7'],
         ['en_name' => 'Save Admin', 'ar_name' => 'انشاء ادمن الشركة', 'role_id' => '7'],
         ['en_name' => 'Update Admin', 'ar_name' => 'تعديل ادمن الشركة', 'role_id' => '7'],
        /////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View Tayar', 'ar_name' => 'مشاهدة الطيارين', 'role_id' => '7'],
         ['en_name' => 'Save Tayar', 'ar_name' => 'انشاء الطيارين', 'role_id' => '7'],
         ['en_name' => 'print Tayar', 'ar_name' => 'طباعة الطيارين', 'role_id' => '7'],
	  
        /////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View Agents', 'ar_name' => 'مشاهدة العملاء', 'role_id' => '7'],
	   ['en_name' => 'Save Agent', 'ar_name' => 'انشاء العملاء', 'role_id' => '7'],
         ['en_name' => 'print Agents', 'ar_name' => 'طباعة العملاء', 'role_id' => '7'],
	   

         /////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View Suppliers', 'ar_name' => '', 'role_id' => '7'],
	   ['en_name' => 'Save Supplier', 'ar_name' => '', 'role_id' => '7'],
         ['en_name' => 'print Suppliers', 'ar_name' => 'طباعة الموردين', 'role_id' => '7'],
	   

         /////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View Leads', 'ar_name' => '', 'role_id' => '7'],
	   ['en_name' => 'Save Lead', 'ar_name' => '', 'role_id' => '7'],
         ['en_name' => 'print Leads', 'ar_name' => 'طباعة المستفيدين', 'role_id' => '7'],
	   

         /////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View Zones', 'ar_name' => '', 'role_id' => '7'],
         ['en_name' => 'Save Zone', 'ar_name' => '', 'role_id' => '7'],
         ['en_name' => 'Update Zone', 'ar_name' => '', 'role_id' => '7'],
         ['en_name' => 'Delete Zone', 'ar_name' => '', 'role_id' => '7'],
         /////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View Zones', 'ar_name' => '', 'role_id' => '7'],
         ['en_name' => 'Save Zone', 'ar_name' => '', 'role_id' => '7'],
         ['en_name' => 'Update Zone', 'ar_name' => '', 'role_id' => '7'],
         ['en_name' => 'Delete Zone', 'ar_name' => '', 'role_id' => '7'],
         /////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View Orders', 'ar_name' => '', 'role_id' => '7'],
         ['en_name' => 'Save Order', 'ar_name' => '', 'role_id' => '7'],
         ['en_name' => 'Update Order', 'ar_name' => '', 'role_id' => '7'],
	   ['en_name' => 'Delete Order', 'ar_name' => '', 'role_id' => '7'],
         ['en_name' => 'print Orders', 'ar_name' => 'طباعة الطلبات', 'role_id' => '7'],
	   
         /////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View Locations', 'ar_name' => '', 'role_id' => '7'],
         ['en_name' => 'Save Location', 'ar_name' => '', 'role_id' => '7'],
         ['en_name' => 'Update Location', 'ar_name' => '', 'role_id' => '7'],
         ['en_name' => 'Delete Location', 'ar_name' => '', 'role_id' => '7']
         /////////////////////////////////////////////////////////////////////////////////////////////////
    );

        \DB::table('permissions')->insert($permissions);
    }
}
