<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Illuminate\Database\Seeder;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('departments')->insert([
        	['id'=>1,'department'=>'مقام اداره'],
            ['id'=>2,'department'=>'معاونیت در امور مالی و اداری'],
            ['id'=>3,'department'=>' معاونیت در امور تفتیش عملکرد و تکنالوژی معلوماتی'],
            ['id'=>4,'department'=>'معاونیت در امور تفتیش مالی و تفتیش رعایت اسناد تقنینی'],
			['id'=>5,'department'=>'مشاوریت ارشد ریس عمومی'],
			['id'=>6,'department'=>'ریاست دفتر'],
			['id'=>7,'department'=>'ریاست پالیسی و پلان'],
			['id'=>8,'department'=>'ریاست تفتیش داخلی و اطمینان کیفیت'],
			['id'=>9,'department'=>'مشاوریت حقوقی'],
			['id'=>10,'department'=>'ریاست تکنالوژی معلوماتی'],
			['id'=>11,'department'=>'ریاست منابع بشری'],
			['id'=>12,'department'=>'ریاست مالی و اداری'],
			['id'=>13,'department'=>'آمریت تدارکات'],
			['id'=>14,'department'=>'آمریت جندر'],
        	['id'=>15,'department'=>'ریاست عمومی تفتیش عملکرد و خاص'],
        	['id'=>16,'department'=>'ریاست تفتیش عملکرد'],
        	['id'=>17,'department'=>'ریاست تفتیش پروژه های عامه'],
			['id'=>18,'department'=>'ریاست تفتیش فرانزیک و تفتیش خاص'],
			['id'=>19,'department'=>'ریاست تفتیش تکنالوژی معلوماتی'],
			['id'=>20 ,'department'=>'ریاست پیگیری یافته های تفتیش و گزارش دهی'],
			['id'=>21 ,'department'=>'ریاست انکشاف مسلکی'],
			['id'=>22 ,'department'=>'آمریت مشارکت عامه در روند تفتیش'],
			['id'=>23 ,'department'=>'ریاست عمومی تفتیش مالی'],
			['id'=>24,'department'=>'ریاست تفتیش حساب قطعیه دولت و ارتباط پارلمانی'],
			['id'=>25,'department'=>'ریاست تفتیش شرکت های دولتی'],
			['id'=>26,'department'=>'ریاست تفتیش مساعدت های خارجی'],
			['id'=>27,'department'=>'ریاست عمومی تفتیش اسناد تقنینی'],
			['id'=>28,'department'=>'ریاست تفتیش سکتور امنیتی، دفاعی و مصئونیت اجتماعی'],
			['id'=>29,'department'=>'ریاست تفتیش سکتور حکومتداری و حاکمیت قانون'],
			['id'=>30,'department'=>'ریاست تفتیش سکتور معارف، صحت و فرهنگ'],
			['id'=>31,'department'=>'ریاست تفتیش سکتور زیربنا، منابع طبیعی،اقتصاد و زراعت'],
			['id'=>32,'department'=>'ریاست تفتیش عواید'],
			['id'=>33,'department'=>'ریاست تفتیش شاروالی ها'],
			['id'=>34,'department'=>'ریاست تحلیل گزارشات']
        ]);
    }
}
