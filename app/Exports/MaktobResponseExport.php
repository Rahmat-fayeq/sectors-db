<?php

namespace App\Exports;

use App\Models\SectorResponseMaktob;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MaktobResponseExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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
        return SectorResponseMaktob::join('sector_maktobs','sector_maktobs.maktob_no', '=', 'sector_response_maktobs.maktob_no')
        ->where(['sector_maktobs.dept'=>Auth::user()->department_id])
        ->get([
            'sector_maktobs.maktob_no','sector_maktobs.maktob_date','sector_maktobs.maktob_subject',
            'sector_maktobs.maktob_sender','sector_maktobs.maktob_type','sector_maktobs.received_no','sector_maktobs.received_date',
            'sector_response_maktobs.export_no','sector_response_maktobs.export_date','sector_response_maktobs.subject','sector_response_maktobs.target_dept',
            'sector_response_maktobs.doc_no','sector_response_maktobs.shelf_no',
            'sector_response_maktobs.shelf_row','sector_response_maktobs.year','sector_response_maktobs.remarks'
        ]);
    }

    public function headings(): array
    {
        return [
          'نمبرمکتوب',
          'تاریخ مکتوب',
          'موضوع',
          'مرجع',
          'نوعیت',
          'نمبر وارده',
          'تاریخ وارده',
          'نمبرصادره',
          'تاریخ صادره',
          'موضوع صادره',
          'مرسل الیه',
          'نمبرکارتن',
          'نمبرالماری',
          'ردیف الماری',
          'سال',
          'ملاحظات'
        ];
    }
}
