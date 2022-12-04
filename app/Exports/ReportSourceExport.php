<?php

namespace App\Exports;
use App\Models\SectorSourceReport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportSourceExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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
         return SectorSourceReport::join('sector_maktobs','sector_maktobs.maktob_no', '=', 'sector_source_reports.maktob_no')
         ->join('cities','cities.id','=','sector_source_reports.city')
         ->where(['sector_maktobs.dept'=>Auth::user()->department_id])->get([
            'sector_source_reports.maktob_no','sector_source_reports.report_no',
            'sector_source_reports.report_date','sector_source_reports.report_subject','cities.city','sector_source_reports.source',
            'sector_source_reports.doc_no','sector_source_reports.shelf_no','sector_source_reports.shelf_row','sector_source_reports.year','sector_source_reports.remarks'
        ]);
    }

    public function headings(): array
    {
        return [
          'نمبرصلاحیت نامه',
          'نمبرمکتوب',
          'تاریخ مکتوب ',
          'موضوع مکتوب',
          'ولایت',
          'مرجع',
          'نمبرکارتن',
          'نمبرالماری',
          'ردیف الماری',
          'سال',
          'ملاحظات'
        ];
    }
}
