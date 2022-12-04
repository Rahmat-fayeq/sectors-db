<?php

namespace App\Exports;

use App\Models\SectorPlanMaktob;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MaktobPlanExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    public function registerEvents(): array
    {
        return [

            BeforeSheet::class  =>function(BeforeSheet $event){
                $event->getDelegate()->setRightToLeft(true);
            }
        ];
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
         return SectorPlanMaktob::join('sector_maktobs','sector_maktobs.maktob_no', '=', 'sector_plan_maktobs.maktob_no')
         ->where(['sector_maktobs.dept'=>Auth::user()->department_id])->get([
            'sector_plan_maktobs.maktob_no','sector_plan_maktobs.plan_no','sector_plan_maktobs.plan_date',
            'sector_plan_maktobs.plan_status','sector_plan_maktobs.quality','sector_plan_maktobs.verify_date',
            'sector_plan_maktobs.rmaktob_no','sector_plan_maktobs.rmaktob_date','sector_plan_maktobs.rmaktob_subject',
            'sector_plan_maktobs.doc_no','sector_plan_maktobs.shelf_no','sector_plan_maktobs.shelf_row','sector_plan_maktobs.year','sector_plan_maktobs.remarks'
        ]);
    }

    public function headings(): array
    {
        return [
          'نمبرصلاحیت نامه',
          'نمبرمکتوب پلان',
          'تاریخ مکتوب پلان',
          'حالت',
          'کیفیت',
          'تاریخ ارائه به مقام',
          'نمبرمکتوب جواب',
          'تاریخ مکتوب جواب',
          'خلاصه موضوع',
          'نمبرکارتن',
          'نمبرالماری',
          'ردیف الماری',
          'سال',
          'ملاحظات'
        ];
    }
}
