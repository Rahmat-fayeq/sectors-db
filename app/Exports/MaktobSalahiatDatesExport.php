<?php

namespace App\Exports;
use Illuminate\Support\Facades\DB;
use App\Models\SectorSalahiatMaktob;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class MaktobSalahiatDatesExport implements FromCollection, WithHeadings, ShouldAutoSize, WithEvents
{
    public function registerEvents(): array
    {
        return [

            BeforeSheet::class  =>function(BeforeSheet $event){
                $event->getDelegate()->setRightToLeft(true);
            }
        ];
    }

    protected $from_date;
    protected $to_date;

    function __construct($from_date,$to_date) {
        $this->from_date = $from_date;
        $this->to_date = $to_date;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return SectorSalahiatMaktob::join('sector_maktobs','sector_maktobs.maktob_no', '=', 'sector_salahiat_maktobs.maktob_no')
        ->join('cities','cities.id', '=', 'sector_salahiat_maktobs.city_id')
        ->where(['sector_maktobs.dept'=>Auth::user()->department_id])
        ->whereBetween(DB::raw('DATE(sector_maktobs.maktob_date)'),[ $this->from_date,$this->to_date])
        ->get([
            'sector_maktobs.maktob_no','sector_maktobs.maktob_date','sector_maktobs.maktob_subject',
            'sector_maktobs.maktob_sender','sector_maktobs.maktob_type','sector_maktobs.received_no','sector_maktobs.received_date',
            'sector_salahiat_maktobs.hukm_no','sector_salahiat_maktobs.hukm_date','sector_salahiat_maktobs.audit_dept',
            'sector_salahiat_maktobs.audit_year','sector_salahiat_maktobs.audited_year','sector_salahiat_maktobs.quarter',
            'sector_salahiat_maktobs.head_auditor','sector_salahiat_maktobs.auditor1','sector_salahiat_maktobs.auditor2','sector_salahiat_maktobs.auditor3','sector_salahiat_maktobs.auditor4','sector_salahiat_maktobs.auditor5','sector_salahiat_maktobs.auditor6',
            'cities.city','sector_salahiat_maktobs.start_date','sector_salahiat_maktobs.end_date',
            'sector_salahiat_maktobs.doc_no','sector_salahiat_maktobs.shelf_no','sector_salahiat_maktobs.shelf_row','sector_salahiat_maktobs.year','sector_salahiat_maktobs.remarks'
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
          'نمبرحکم',
          'تاریخ حکم',
          'مرجع',
          'سال بررسی',
          'سال تحت بررسی',
          'ربع بررسی',
          'آمرگروپ',
          'مفتیش1',
          'مفتیش2',
          'مفتیش3',
          'مفتیش4',
          'مفتیش5',
          'مفتیش6',
          'ولایت',
          'تاریخ شروع',
          'تارختم',
          'نمبرکارتن',
          'نمبرالماری',
          'ردیف الماری',
          'سال',
          'ملاحظات'
        ];
    }
}
