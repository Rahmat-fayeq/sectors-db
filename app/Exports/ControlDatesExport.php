<?php

namespace App\Exports;

use App\Models\Control;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ControlDatesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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
    protected $from_date;
    protected $to_date;

    function __construct($from_date,$to_date) {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }

    public function collection()
    {
         return Control::where(['dept'=>Auth::user()->department_id])
        ->whereBetween(DB::raw('DATE(date)'),[ $this->from_date,$this->to_date])
         ->get(['source','auditors','date','controller','type','step','progress','result','decision','remarks']);
    }

    public function headings(): array
    {
        return [
          'مرجع',
          'مفتیشین',
          'تاریخ نظارت',
          'نظارت کننده',
          'نوعیت نظارت',
          'مرحله نظارت',
          'اجراآت',
          'نتیجه نظارت',
          'تصمیم',
          'ملاحظات'
        ];
    }
}
