<?php

namespace App\Exports;

use App\Models\Auditor;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AuditorExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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
        return Auditor::where(['dept'=>Auth::user()->department_id])->get([
            'name','fname','job','rank','email','phone','remarks'
        ]);
    }

    public function headings(): array
    {
        return [
          'نام مکمل',
          'نام پدر',
          'عنوان بست',
          'درجه بست',
          'ایمیل',
          'نمبر تماس',
          'ملاحظات'
        ];
    }
}
