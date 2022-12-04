<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cities')->insert([
        	['id'=>1,'city'=>'ارزگان'],
            ['id'=>2,'city'=>'بادغیس'],
            ['id'=>3,'city'=>'بامیان'],
            ['id'=>4,'city'=>'بدخشان'],
            ['id'=>5,'city'=>'بغلان'],
            ['id'=>6,'city'=>'بلخ'],
            ['id'=>7,'city'=>'پروان'],
            ['id'=>8,'city'=>'پکتیا'],
            ['id'=>9,'city'=>'پکتیکا'],
            ['id'=>10,'city'=>'پنجشیر'],
            ['id'=>11,'city'=>'تخار'],
            ['id'=>12,'city'=>'جوزجان'],
            ['id'=>13,'city'=>'خوست'],
            ['id'=>14,'city'=>'دایکندی'],
            ['id'=>15,'city'=>'زابل'],
            ['id'=>16,'city'=>'سرپل'],
            ['id'=>17,'city'=>'سمنگان'],
            ['id'=>18,'city'=>'غزنی'],
            ['id'=>19,'city'=>'غور'],
            ['id'=>20,'city'=>'فاریاب'],
            ['id'=>21,'city'=>'فراه'],
            ['id'=>22,'city'=>'قندهار'],
            ['id'=>23,'city'=>'کابل'],
            ['id'=>24,'city'=>'کاپیسا'],
            ['id'=>25,'city'=>'کندز'],
            ['id'=>26,'city'=>'کنر'],
            ['id'=>27,'city'=>'لغمان'],
            ['id'=>28,'city'=>'لوگر'],
            ['id'=>29,'city'=>'میدان وردگ'],
            ['id'=>30,'city'=>'ننگرهار'],
            ['id'=>31,'city'=>'نورستان'],
            ['id'=>32,'city'=>'نیمروز'],
            ['id'=>33,'city'=>'هرات'],
            ['id'=>34,'city'=>'هلمند'],
        ]);
    }
}
