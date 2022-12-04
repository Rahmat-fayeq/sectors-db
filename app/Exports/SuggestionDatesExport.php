<?php

namespace App\Exports;
use App\Models\Suggestion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SuggestionDatesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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
        return Suggestion::where(['dept'=>Auth::user()->department_id])
        ->whereBetween(DB::raw('DATE(suggestions.sug_date)'),[ $this->from_date,$this->to_date])
        ->get([
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
