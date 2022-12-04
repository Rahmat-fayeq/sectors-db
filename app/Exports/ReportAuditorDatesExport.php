<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;
use App\Models\SectorAuditorReport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportAuditorDatesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    public function registerEvents(): array
    {
        return [

            BeforeSheet::class  =>function(BeforeSheet $event){
                $event->getDelegate()->setRightToLeft(true);
            }
        ];
    }

    function __construct($from_date,$to_date) {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
         return SectorAuditorReport::join('sector_maktobs','sector_maktobs.maktob_no', '=', 'sector_auditor_reports.maktob_no')
         ->where(['sector_maktobs.dept'=>Auth::user()->department_id])
         ->whereBetween(DB::raw('DATE(sector_maktobs.maktob_date)'),[ $this->from_date,$this->to_date])
         ->get([
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
