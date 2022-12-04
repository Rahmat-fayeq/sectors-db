<?php

namespace App\Exports;

use App\Models\Control;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ControlExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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
         return Control::where(['dept'=>Auth::user()->department_id])->get(['source','auditors','date','controller','type','step','progress','result','decision','remarks']);
        // return Control::join('departments','departments.id', '=', 'controls.dept')->
        // get(['departments.department','controls.source','controls.auditors','controls.date','controls.controller','controls.type','controls.step','controls.progress','controls.result','controls.decision','controls.remarks']);
    }

    public function headings(): array
    {
        return [
        //   'ریاست',
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
