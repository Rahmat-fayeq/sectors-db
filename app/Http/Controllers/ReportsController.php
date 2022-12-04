<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\CliamDatesExport;
use App\Exports\ControlDatesExport;
use App\Exports\JusticeDatesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MaktobPlanDatesExport;
use App\Exports\SuggestionDatesExport;
use App\Exports\MaktobSavedDatesExport;
use App\Exports\ReportSourceDatesExport;
use App\Exports\ReportAnalyseDatesExport;
use App\Exports\ReportAuditorDatesExport;
use App\Exports\MaktobResponseDatesExport;
use App\Exports\MaktobSalahiatDatesExport;

class ReportsController extends Controller
{
    public function index()
    {
        return view('reports.index');
    }

    public function search(Request $request)
    {
        $ruls = [
            'type'=>'required',
            'start_date'=>'required',
            'end_date'=>'required'
        ];

      $customMessages = [
        'type.required' => 'نوعیت سند را مشخص کنید',
        'start_date.required' => 'تاریخ آغار را مشخص کنید',
        'end_date.required' => 'تاریخ ختم را مشخص کنید'

        ];
        $this->validate($request,$ruls,$customMessages);

        if ($request->type == 'saved') 
		{
            $from_date=$request->start_date;
            $to_date = $request->end_date;

            $file_name = 'مکاتیب حفظیه'.date('Y_m_d_H_i_s').'.xlsx';
            return Excel::download(new MaktobSavedDatesExport($from_date,$to_date),$file_name);
		}

        else if($request->type == 'response')
        {
            $from_date=$request->start_date;
            $to_date = $request->end_date;

            $file_name = 'مکاتیب جواب'.date('Y_m_d_H_i_s').'.xlsx';
            return Excel::download(new MaktobResponseDatesExport($from_date,$to_date),$file_name);
        }

        else if($request->type == 'salahiat')
        {
            $from_date=$request->start_date;
            $to_date = $request->end_date;

            $file_name = 'صلاحیت نامه'.date('Y_m_d_H_i_s').'.xlsx';
            return Excel::download(new MaktobSalahiatDatesExport($from_date,$to_date),$file_name);
        }

        else if($request->type == 'plan')
        {
            $from_date=$request->start_date;
            $to_date = $request->end_date;

            $file_name = 'مکاتیب پلان'.date('Y_m_d_H_i_s').'.xlsx';
            return Excel::download(new MaktobPlanDatesExport($from_date,$to_date),$file_name);
        }

        else if($request->type == 'auditors')
        {
            $from_date=$request->start_date;
            $to_date = $request->end_date;

            $file_name = 'گزارشات مفتیشین'.date('Y_m_d_H_i_s').'.xlsx';
            return Excel::download(new ReportAuditorDatesExport($from_date,$to_date),$file_name);
        }

        else if($request->type == 'analyse')
        {
            $from_date=$request->start_date;
            $to_date = $request->end_date;

            $file_name = 'گزارشات تحلیل'.date('Y_m_d_H_i_s').'.xlsx';
            return Excel::download(new ReportAnalyseDatesExport($from_date,$to_date),$file_name);
        }

        else if($request->type == 'source')
        {
            $from_date=$request->start_date;
            $to_date = $request->end_date;

            $file_name = 'گزارشات مراجع'.date('Y_m_d_H_i_s').'.xlsx';
            return Excel::download(new ReportSourceDatesExport($from_date,$to_date),$file_name);
        }

        else if($request->type == 'suggestion')
        {
            $from_date=$request->start_date;
            $to_date = $request->end_date;

            $file_name = 'پیشنهادات'.date('Y_m_d_H_i_s').'.xlsx';
            return Excel::download(new SuggestionDatesExport($from_date,$to_date),$file_name);
        }

        else if($request->type == 'cliam')
        {
            $from_date=$request->start_date;
            $to_date = $request->end_date;

            $file_name = 'اعتراضات'.date('Y_m_d_H_i_s').'.xlsx';
            return Excel::download(new CliamDatesExport($from_date,$to_date),$file_name);
        }

        else if($request->type == 'justice')
        {
            $from_date=$request->start_date;
            $to_date = $request->end_date;

            $file_name = 'تعقیب عدلی'.date('Y_m_d_H_i_s').'.xlsx';
            return Excel::download(new JusticeDatesExport($from_date,$to_date),$file_name);
        }

        else if($request->type == 'control')
        {
            $from_date=$request->start_date;
            $to_date = $request->end_date;

            $file_name = 'نظارت'.date('Y_m_d_H_i_s').'.xlsx';
            return Excel::download(new ControlDatesExport($from_date,$to_date),$file_name);
        }

       
    }

    public function export(Request $request)
    {
        $ruls = [
            'rtype'=>'required',
        ];

      $customMessages = [
        'rtype.required' => 'نوعیت سند را مشخص کنید',

        ];
        $this->validate($request,$ruls,$customMessages);

        if($request->rtype == 'saved')
        {
            
            return redirect(route('sector.maktob_saved_excel'));
        }
        else if($request->rtype == 'response')
        {
            return redirect(route('sector.maktob_response_excel'));  
        }
        else if($request->rtype == 'salahiat')
        {
            return redirect(route('sector.maktob_salahiat_excel'));  
        }
        else if($request->rtype == 'plan')
        {
            return redirect(route('sector.maktob_plan_excel'));  
        }
        
        else if($request->rtype == 'auditors')
        {
            return redirect(route('sector.report_auditor_excel'));  
        }
        else if($request->rtype == 'analyse')
        {
            return redirect(route('sector.report_analyse_excel'));  
        }
        else if($request->rtype == 'source')
        {
            return redirect(route('sector.report_source_excel'));  
        }
        else if($request->rtype == 'suggestion')
        {
            return redirect(route('sector.suggestion_excel'));  
        }
        else if($request->rtype == 'cliam')
        {
            return redirect(route('sector.cliam_excel'));  
        }
        else if($request->rtype == 'justice')
        {
            return redirect(route('sector.justice_excel'));  
        }
        else if($request->rtype == 'control')
        {
            return redirect(route('sector.control_excel'));  
        }
        else if($request->rtype == 'auditor')
        {
            return redirect(route('sector.auditor_excel'));  
        }
    }
}
