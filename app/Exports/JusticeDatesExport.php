<?php

namespace App\Exports;
use App\Models\Justice;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class JusticeDatesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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
        return Justice::where(['dept'=>Auth::user()->department_id])
        ->whereBetween(DB::raw('DATE(sug_date)'),[ $this->from_date,$this->to_date])
        ->get([
            'source','auditors','subject','sug_no','sug_date',
            'board_no','board_date','result','result_no','result_date',
            'judge_no','judge_date','remarks'
        ]);
    }

    public function headings(): array
    {
        return [
          'مرجع',
          'مفتیشین',
          'موضوع',
          'پیشنهاد نمبر',
          'پیشنهاد تاریخ',
          'نمبرمکتوب کمیته عدلی',
          'تاریخ مکتوب کمیته عدلی',
          'مصوبه جلسه',
          'نمبر مصوبه',
          'تاریخ مصوبه',
          'نمبر مکتوب ثارنوال',
          'تاریخ مکتوب ثارنوال',
          'ملاحظات'
        ];
    }
}
