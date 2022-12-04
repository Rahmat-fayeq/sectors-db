<?php

namespace App\Exports;
use App\Models\Suggestion;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SuggestionExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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
        return Suggestion::where(['dept'=>Auth::user()->department_id])->get([
            'sug_no','sug_date','sug_subject','sug_verify_date','sug_status','sug_remarks'
        ]);
    }

    public function headings(): array
    {
        return [
          'نمبر پیشنهاد',
          'تاریخ پیشنهاد',
          'موضوع پیشنهاد',
          'تاریخ حکم',
          'حالت',
          'ملاحظات'
        ];
    }
}
