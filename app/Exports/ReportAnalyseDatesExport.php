<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use App\Models\SectorAnalyseReport;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportAnalyseDatesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
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
         return SectorAnalyseReport::join('sector_maktobs','sector_maktobs.maktob_no', '=', 'sector_analyse_reports.maktob_no')
         ->where(['sector_maktobs.dept'=>Auth::user()->department_id])
         ->whereBetween(DB::raw('DATE(sector_maktobs.maktob_date)'),[ $this->from_date,$this->to_date])
         ->get([
            'sector_analyse_reports.maktob_no','sector_analyse_reports.send_report_no','sector_analyse_reports.send_report_date',
            'sector_analyse_reports.send_report_subject','sector_analyse_reports.receive_report_no','sector_analyse_reports.receive_report_no','sector_analyse_reports.receive_report_date',
            'sector_analyse_reports.receive_report_subject','sector_analyse_reports.status','sector_analyse_reports.send_verify_date',
            'sector_analyse_reports.receive_verify_date','sector_analyse_reports.export_date',
            'sector_analyse_reports.doc_no','sector_analyse_reports.shelf_no','sector_analyse_reports.shelf_row','sector_analyse_reports.year','sector_analyse_reports.remarks'
        ]);
    }

    public function headings(): array
    {
        return [
          'نمبرصلاحیت نامه',
          'نمبرمکتوب ارسال',
          'تاریخ مکتوب ارسال',
          'موضوع مکتوب ارسال',
          'نمبرمکتوب دریافت',
          'تاریخ مکتوب دریافت',
          'موضوع مکتوب دریافت',
          'حالت گزارش',
          'تاریخ ارئه گزارش به مقام',
          'تاریخ دریافت گزارش ازمقام',
          'تاریخ ارسال به ریاست دفتر',
          'نمبرکارتن',
          'نمبرالماری',
          'ردیف الماری',
          'سال',
          'ملاحظات'
        ];
    }
}
