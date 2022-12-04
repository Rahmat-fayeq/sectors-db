<?php

namespace App\Exports;
use App\Models\Claim;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class CliamExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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
        return Claim::where(['dept'=>Auth::user()->department_id])->get([
            'maktob_no','subject','status','reject_no','reject_date','reject_subject','source','analyzed_no','claim_no','claim_date','claim','claim_files',
            'auditors','group_no','group_date','group_recived_date','authority_date',
            'hukm_no','hukm_date','hukm','board_no','board_date','result_no','result_date',
            'result','send_no','send_date','remarks'
        ]);
    }

    public function headings(): array
    {
        return [
            'نمبرصلاحیت نامه',
            'موضوع اعتراض',
            'حالت',
            'نمبرمکتوب رد',
            'تاریخ مکتوب رد',
            'موضوع مکتوب رد',
          'مرجع',
          'نمبرمکتوب نظرتحلیلی',
          'نمبراعتراضیه',
          'تاریخ اعتراضیه',
          'ضمایم',
          'مفتیشین',
          'نمبرمکتوب هیئت',
          'تاریخ مکتوب هیئت',
          'تاریخ دریافت از هیئت',
          'تاریخ پیشنهاد مقام',
          'نمبر حکم',
          'تاریخ حکم',
          'حکم مقام',
          'نمبرمکتوب کمیته اعتراض',
          'تاریخ مکتوب کمیته اعتراض',
          'ضمایم',
          'نمبر مصوبه',
          'تاریخ مصوبه',
          'مصوبه',
          'نمبرابلاغ مرجع',
          'تاریخ ابلاغ مرجع',
          'ملاحظات'
        ];
    }
}
