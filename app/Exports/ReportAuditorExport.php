<?php

namespace App\Exports;
use App\Models\SectorAuditorReport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportAuditorExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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
         return SectorAuditorReport::join('sector_maktobs','sector_maktobs.maktob_no', '=', 'sector_auditor_reports.maktob_no')
         ->where(['sector_maktobs.dept'=>Auth::user()->department_id])->get([
            'sector_auditor_reports.maktob_no','sector_auditor_reports.report_no','sector_auditor_reports.report_date',
            'sector_auditor_reports.report_subject','sector_auditor_reports.report_quality',
            'sector_auditor_reports.doc_no','sector_auditor_reports.shelf_no','sector_auditor_reports.shelf_row','sector_auditor_reports.year','sector_auditor_reports.remarks'
        ]);
    }

    public function headings(): array
    {
        return [
          'نمبرصلاحیت نامه',
          'نمبرمکتوب گزارش',
          'تاریخ مکتوب گزارش',
          'موضوع مکتوب',
          'کیفیت گزارش',
          'نمبرکارتن',
          'نمبرالماری',
          'ردیف الماری',
          'سال',
          'ملاحظات'
        ];
    }
}
