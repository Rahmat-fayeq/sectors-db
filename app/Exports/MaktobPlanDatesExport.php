<?php

namespace App\Exports;

use App\Models\SectorPlanMaktob;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MaktobPlanDatesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    public function registerEvents(): array
    {
        return [

            BeforeSheet::class  =>function(BeforeSheet $event){
                $event->getDelegate()->setRightToLeft(true);
            }
        ];
    }

    protected $from_date;
    protected $to_date;

    function __construct($from_date,$to_date) {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
         return SectorPlanMaktob::join('sector_plan_maktobs')
         ->where(['dept'=>Auth::user()->department_id])
         ->whereBetween(DB::raw('DATE(plan_date)'),[ $this->from_date,$this->to_date])
         ->get([
            'maktob_no','plan_no','plan_date','plan_status','quality','verify_date','rmaktob_no','rmaktob_date','rmaktob_subject',
            'doc_no','shelf_no','shelf_row','year','remarks'
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
