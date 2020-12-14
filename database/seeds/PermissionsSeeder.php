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
        //////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'Update Settings', 'ar_name' => 'تعديل الاعدادت'],
         ['en_name' => 'View Settings'  , 'ar_name' => 'مشاهده الاعدادت'],
         ['en_name' => 'Update ADS'     , 'ar_name' => 'تعديل الاعلانات'],
         ['en_name' => 'View ADS'       , 'ar_name' => 'قراءة الاعلانات'],
         ['en_name' => 'Send Notify'    , 'ar_name' => 'ارسال اشعار'],
         ['en_name' => 'Super Dashboard', 'ar_name' => 'لوحة البيانات'],

        ////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View Companies' , 'ar_name' => 'قراءة الشركات'],
         ['en_name' => 'Save Company'   , 'ar_name' => 'انشاء الشركات'],
         ['en_name' => 'Update Company' , 'ar_name' => 'تعديل الشركات'],
	     ['en_name' => 'Delete Company' , 'ar_name' => 'حذف الشركات'],
         ['en_name' => 'Print Companies', 'ar_name' => 'طباعة الشركات'],
	   
        ////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View Countries', 'ar_name' => 'قراءة الدول'],
         ['en_name' => 'Save Country'  , 'ar_name' => 'انشاء الدول'],
         ['en_name' => 'Update Country', 'ar_name' => 'تعديل الدول'],
         ['en_name' => 'Delete Country', 'ar_name' => 'حذف الدول'],

         ////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View Currencies', 'ar_name' => 'قراءة العملات'],
         ['en_name' => 'Save Currency'  , 'ar_name' => 'انشاء العملات'],
         ['en_name' => 'Update Currency', 'ar_name' => 'تعديل العملات'],
         ['en_name' => 'Delete Currency', 'ar_name' => 'حذف العملات'],

        ////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View Cities', 'ar_name' => 'قراءة المدن'],
         ['en_name' => 'Save City'  , 'ar_name' => 'انشاء المدن'],
         ['en_name' => 'Update City', 'ar_name' => 'تعديل المدن'],
         ['en_name' => 'Delete City', 'ar_name' => 'حذف المدن'],
         
        ////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View SubscriptionTypes' , 'ar_name' => 'قراءة انواع الاشتراكات'],
         ['en_name' => 'Save SubscriptionType'  , 'ar_name' => 'انشاء انواع الاشتراكات'],
         ['en_name' => 'Update SubscriptionType', 'ar_name' => 'تعديل انواع الاشتراكات'],
         ['en_name' => 'Delete SubscriptionType', 'ar_name' => 'حذف انواع الاشتراكات'],

         ////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View MaterialTypes' , 'ar_name' => 'قراءة انواع المواد'],
         ['en_name' => 'Save MaterialType'  , 'ar_name' => 'انشاء انواع المواد'],
         ['en_name' => 'Update MaterialType', 'ar_name' => 'تعديل انواع المواد'],
         ['en_name' => 'Delete MaterialType', 'ar_name' => 'حذف انواع المواد'],

          ////////////////////////////////////////////////////////////////////////////////////////////////
          ['en_name' => 'View Materials' , 'ar_name' => 'قراءة  المواد'],
          ['en_name' => 'Save Material'  , 'ar_name' => 'انشاء  المواد'],
          ['en_name' => 'Update Material', 'ar_name' => 'تعديل  المواد'],
          ['en_name' => 'Delete Material', 'ar_name' => 'حذف  المواد'],

         ////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View DeliveryStatus'  , 'ar_name' => 'قراءة حالات التوصيل'],
         ['en_name' => 'Save DeliveryStatue'  , 'ar_name' => 'انشاء حالات التوصيل'],
         ['en_name' => 'Update DeliveryStatue', 'ar_name' => 'تعديل حالات التوصيل'],
         ['en_name' => 'Delete DeliveryStatue', 'ar_name' => 'حذف حالات التوصيل'],

        ////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View Subscriptions' , 'ar_name' => 'قراءة الاشتراكات'],
         ['en_name' => 'Print Subscriptions', 'ar_name' => 'طباعة الاشتراكات'],

        ////////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View Reports'  , 'ar_name' => 'مشاهده البلاغات'],
         ['en_name' => 'Update Reports', 'ar_name' => 'تعديل البلاغات'],
         ['en_name' => 'View Dashboard', 'ar_name' => 'قراءة لوحة الشركة'],

        ////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View Admins' , 'ar_name' => 'قراءة ادمن الشركة'],
         ['en_name' => 'Save Admin'  , 'ar_name' => 'انشاء ادمن الشركة'],
         ['en_name' => 'Update Admin', 'ar_name' => 'تعديل ادمن الشركة'],

        /////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View Representative' , 'ar_name' => 'قراءة المناديب'],
         ['en_name' => 'Save Representative' , 'ar_name' => 'انشاء المناديب'],
         ['en_name' => 'Print Representative', 'ar_name' => 'طباعة المناديب'],
	  
        /////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View Agents' , 'ar_name' => 'قراءة العملاء'],
	     ['en_name' => 'Save Agent'  , 'ar_name' => 'انشاء العملاء'],
         ['en_name' => 'Print Agents', 'ar_name' => 'طباعة العملاء'],
	   
         /////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View Leads' , 'ar_name' => 'قراءة العملاء'],
	     ['en_name' => 'Save Lead'  , 'ar_name' => ' انشاء العملاء'],
         ['en_name' => 'Print Leads', 'ar_name' => 'طباعة العملاء'],
	   
         /////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View Zones' , 'ar_name' => 'قراءة المناطق'],
         ['en_name' => 'Save Zone'  , 'ar_name' => 'انشاء المناطق'],
         ['en_name' => 'Update Zone', 'ar_name' => 'تعديل المناطق'],
         ['en_name' => 'Delete Zone', 'ar_name' => 'حذف المناطق'],
         ['en_name' => 'Print Zone' , 'ar_name' => 'طباعة المناطق'],

         /////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View Orders' , 'ar_name' => 'قراءة الطلبات'],
         ['en_name' => 'Save Order'  , 'ar_name' => 'انشاء الطلبات'],
         ['en_name' => 'Update Order', 'ar_name' => ' تعديل الطلبات'],
	     ['en_name' => 'Delete Order', 'ar_name' => 'حذف الطلبات'],
         ['en_name' => 'Print Orders', 'ar_name' => 'طباعة الطلبات'],
	   
         /////////////////////////////////////////////////////////////////////////////////////////////////
         ['en_name' => 'View Locations' , 'ar_name' => 'قراءة العناوين'],
         ['en_name' => 'Save Location'  , 'ar_name' => 'انشاء العناوين'],
         ['en_name' => 'Update Location', 'ar_name' => 'تعديل العناوين'],
         ['en_name' => 'Delete Location', 'ar_name' => 'حذف العناوين']

         /////////////////////////////////////////////////////////////////////////////////////////////////
    );

        \DB::table('permissions')->insert($permissions);
    }
}
