<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\SectorMaktob;
use App\Models\SectorSavedMaktob;
use App\Models\SectorResponseMaktob;
use App\Models\SectorSalahiatMaktob;
use App\Models\SectorPlanMaktob;
use App\Models\SectorAuditorReport;
use App\Models\SectorAnalyseReport;
use App\Models\SectorSourceReport;
use App\Models\Auditor;
use App\Models\City;
use App\Models\Suggestion;
use App\Models\Claim;
use App\Models\Justice;
use App\Models\Control;
use App\Exports\ControlExport;
use App\Exports\JusticeExport;
use App\Exports\CliamExport;
use App\Exports\SuggestionExport;
use App\Exports\AuditorExport;
use App\Exports\MaktobSavedExcel;
use App\Exports\MaktobResponseExport;
use App\Exports\MaktobSalahiatExport;
use App\Exports\MaktobPlanExport;
use App\Exports\ReportAuditorExport;
use App\Exports\ReportAnalyseExport;
use App\Exports\ReportSourceExport;
// old
use App\Models\User;
use App\Models\Department;
use Session;
use Excel;
use DB;
use Hash;


class SectorsController extends Controller
{

	public function showMaktob()
	{
		if (Auth::user()->hasRole('sector')) 
		{
		    $arr['info'] = SectorMaktob::where(['dept'=>Auth::user()->department_id])->orderBy('created_at','DESC')->get();
			return view('sectors.maktob_show')->with($arr);
		}
	}
	public function editMaktob(Request $request,$id)
	{
		if (Auth::user()->hasRole('sector')) 
	    {
			if($request->isMethod('post'))
			{
				$ruls = [
					'maktob_no'=>'required',
					'maktob_date'=>'required',
					'maktob_subject'=>'required',
					'maktob_sender'=>'required',
					'maktob_type'=>'required',
				];

			$customMessages = [
				'maktob_no.required' => 'نمبر مکتوب ضروری است',
				'maktob_date.required' => 'تاریخ مکتوب ضروری است',
				'maktob_subject.required' => 'موضوع مکتوب ضروری است',
				'maktob_sender.required' => 'مرجع ضروری است',
				'maktob_type.required' => 'نوعیت مکتوب ضروری است',
				];
				$this->validate($request,$ruls,$customMessages);

				$data = $request->all();
					
				$result = SectorMaktob::where('id',$id)->update([
						'maktob_no' => $data['maktob_no'],
						'maktob_date' => $data['maktob_date'],
						'maktob_subject' => $data['maktob_subject'],
						'maktob_sender' => $data['maktob_sender'],
						'maktob_type' => $data['maktob_type'],
						'type' => $data['type'],
						'received_no' => $data['received_no'],
						'received_date' => $data['received_date'],
						'dept' => Auth::user()->department_id,
						]);
				return redirect(route('sector.maktob_show'))->with('success_message','معلومات موفقانه تغیر داده شد');
			}

				$data = SectorMaktob::findOrFail($id)->toArray();
				$departments =  Department::where(['id'=>auth()->user()->department_id])->get();
				return view('sectors.maktob_edit')->with(compact('data','departments'));
		}
	}	
	public function deleteMaktob($id)
    { 
		if (Auth::user()->hasRole('sector')) 
		{
			$data = SectorMaktob::findOrFail($id);
			$data->delete();
			return redirect('dashboard/maktob-show')->with('success_message','مکتوب مربوطه از سیستم حذف گردید');
		}	
	}
	public function addMaktob(Request $request)
	{
		if (Auth::user()->hasRole('sector')) 
	    {
			if($request->isMethod('post'))
			{
				$ruls = [
					'maktob_no'=>'required',
					'maktob_date'=>'required',
					'maktob_subject'=>'required',
					'maktob_sender'=>'required',
					'maktob_type'=>'required',
					'type'=>'required',
				];

			$customMessages = [
				'maktob_no.required' => 'نمبر مکتوب ضروری است',
				'maktob_date.required' => 'تاریخ مکتوب ضروری است',
				'maktob_subject.required' => 'موضوع مکتوب ضروری است',
				'maktob_sender.required' => 'مرجع ضروری است',
				'maktob_type.required' => 'نوعیت مکتوب ضروری است',
				'type.required' => 'نوعیت مکتوب ضروری است',
				];
				$this->validate($request,$ruls,$customMessages);
				$data = $request->all();	
				$info = new SectorMaktob;
				
				$info->maktob_no = $data['maktob_no'];
				$info->maktob_date = $data['maktob_date'];
				$info->maktob_subject = $data['maktob_subject'];
				$info->maktob_sender = $data['maktob_sender'];
				$info->maktob_type = $data['maktob_type'];
				$info->type = $data['type'];
				$info->received_no = $data['received_no'];
				$info->received_date = $data['received_date'];
				$info->dept = Auth::user()->department_id;
				
				$info->save();	
				return redirect(route('sector.maktob_show'))->with('success_message','معلومات موفقانه ذخیره گردید');
			}
			$arr['departments'] = Department::where(['id'=>auth()->user()->department_id])->get();
			return view('sectors.maktob_add')->with($arr);
		}		
	}
	public function addSavedMaktob(Request $request)
	{
		if (Auth::user()->hasRole('sector')) 
	    {
				if($request->isMethod('post'))
				{
					$ruls = [
						'maktob_no'=>'required',
						 'file' => 'mimes:jpeg,png,jpg,pdf,rar,zip|max:2048'
					];

				$customMessages = [
					'maktob_no.required' => 'نمبر مکتوب ضروری است',
					];
					$this->validate($request,$ruls,$customMessages);
					$data = $request->all();	
					// echo "<pre>";print_r($data);die;
					if( $request->hasFile('file'))
				    { 
				        $img = $request->file('file'); 
				        $extension = $img->getClientOriginalExtension();
				        $doc = date('ymdHis').rand(1,99999).'.'.$extension; 
				      	 $request->file->storeAs('public/documents',$doc); 
				    } 
				    else {
				        $doc = "";
				    }

					$info = new SectorSavedMaktob;
					
					$info->dept = Auth::user()->department_id;
					$info->maktob_no = $data['maktob_no'];
					$info->doc_no = $data['doc_no'];
					$info->shelf_no = $data['shelf_no'];
					$info->shelf_row = $data['shelf_row'];
					$info->year = $data['year'];
					$info->remarks = $data['remarks'];
					$info->file = $doc;
					$info->save();	
					return redirect('dashboard/maktob-saved-show')->with('success_message','معلومات موفقانه ذخیره گردید');
				}
					$arr['maktob_numbers'] = SectorMaktob::where('dept',Auth::user()->department_id)->get();
					// $arr['departments'] = json_decode(json_encode($arr['departments']),true); 
					// echo "<pre>";print_r($arr['departments']);die;
					return view('sectors.maktob_saved_add')->with($arr);
		}		
	}
	public function showSavedMaktob()
	{
		if (Auth::user()->hasRole('sector')) 
		{
			$arr['info'] = SectorSavedMaktob::where('dept',Auth::user()->department_id)->get();
			return view('sectors.maktob_saved_show')->with($arr);
		}
	}
	public function fileDownload($file)
	{
		$path = public_path().'/storage/documents/'.$file;
		return response()->download($path);
	}
	public function deleteSavedMaktob($id)
    { 
		if (Auth::user()->hasRole('sector')) 
		{
			$data = SectorSavedMaktob::findOrFail($id);
			
			$data->delete();
			return redirect(route('sector.maktob_saved_show'))->with('success_message','مکتوب مربوطه از سیستم حذف گردید');
		}	
	}
	public function editSavedMaktob(Request $request,$id)
	{
		if (Auth::user()->hasRole('sector')) 
	    {
				if($request->isMethod('post'))
				{
					$ruls = [
						'maktob_no'=>'required',
						'file|prevFile' => 'mimes:jpeg,png,jpg,pdf,rar,zip|max:2048'
					];

				$customMessages = [
					'maktob_no.required' => 'نمبر مکتوب ضروری است',
					];
					$this->validate($request,$ruls,$customMessages);

				$data = $request->all();

				if( $request->hasFile('file'))
				{ 
				        $img = $request->file('file'); 

				        $extension = $img->getClientOriginalExtension();
				        $doc = date('ymdHis').rand(1,99999).'.'.$extension; 
				      	 // dd($file); 
				      	 $request->file->storeAs('public/documents',$doc); 
				    } 
				    else if(!empty($data['prevFile']))
		                {
		                    $doc = $data['prevFile'];
		                }
				    else {
				        $doc = "";
				}	
				$result = SectorSavedMaktob::where('id',$id)->update([
						'dept' => Auth::user()->department_id,
						'maktob_no' => $data['maktob_no'],
						'doc_no' => $data['doc_no'],
						'shelf_no' => $data['shelf_no'],
						'shelf_row' => $data['shelf_row'],
						'year' => $data['year'],
						'remarks' => $data['remarks'],
						'file' => $doc,
						]);
					return redirect('dashboard/maktob-saved-show')->with('success_message','معلومات موفقانه تغیر داده شد');
				}

				$data = SectorSavedMaktob::findOrFail($id)->toArray();
				$maktob_numbers = SectorMaktob::where('dept',Auth::user()->department_id)->orderBy('created_at','DESC')->get();
				return view('sectors.maktob_saved_edit')->with(compact('data','maktob_numbers'));
			}
		
	}
	public function showResponseMaktob()
	{
		if (Auth::user()->hasRole('sector')) 
		{
			$arr['info'] = SectorResponseMaktob::where(['dept'=>Auth::user()->department_id])->orderBy('created_at','DESC')->get();
			return view('sectors.maktob_response_show')->with($arr);
		}
	}
	public function addResponseMaktob(Request $request)
	{
		if (Auth::user()->hasRole('sector')) 
	    {
			if($request->isMethod('post'))
			{
				$ruls = [
					'maktob_no'=>'required',
					'export_no'=>'required',
					'export_date'=>'required',
					'subject'=>'required',
					'target_dept'=>'required',
					'export_date'=>'required',
					'file' => 'mimes:jpeg,png,jpg,pdf,rar,zip|max:2048'
				];

			$customMessages = [
				'maktob_no.required' => 'نمبر مکتوب ضروری است',
				'export_no.required' => 'نمبر صادره ضروری است',
				'export_date.required' => 'تاریخ صادره ضروری است',
				'subject.required' => 'موضوع مکتوب ضروری است',
				'target_dept.required' => 'مرسل الیه ضروری است',
				];
				$this->validate($request,$ruls,$customMessages);
				$data = $request->all();	
				// echo "<pre>";print_r($data);die;
				if( $request->hasFile('file'))
				{ 
					$img = $request->file('file'); 

					$extension = $img->getClientOriginalExtension();
					$doc = date('ymdHis').rand(1,99999).'.'.$extension; 
						// dd($file); 
						$request->file->storeAs('public/documents',$doc); 
				} 
				else {
					$doc = "";
				}

				$info = new SectorResponseMaktob;
				
				$info->dept = Auth::user()->department_id;
				$info->maktob_no = $data['maktob_no'];
				$info->export_no = $data['export_no'];
				$info->export_date = $data['export_date'];
				$info->subject = $data['subject'];
				$info->target_dept = $data['target_dept'];
				$info->doc_no = $data['doc_no'];
				$info->shelf_no = $data['shelf_no'];
				$info->shelf_row = $data['shelf_row'];
				$info->year = $data['year'];
				$info->remarks = $data['remarks'];
				$info->file = $doc;
				$info->save();	
				return redirect('dashboard/maktob-response-show')->with('success_message','معلومات موفقانه ذخیره گردید');
			}
			$arr['maktob_numbers'] = SectorMaktob::select(['maktob_no'])->orderBy('created_at','DESC')->get();
			// $arr['departments'] = json_decode(json_encode($arr['departments']),true); 
			// echo "<pre>";print_r($arr['departments']);die;
			return view('sectors.maktob_response_add')->with($arr);
		}		
	}
	public function editResponseMaktob(Request $request,$id)
	{
		if (Auth::user()->hasRole('sector')) 
	    {
				if($request->isMethod('post'))
				{
					$ruls = [
						'maktob_no'=>'required',
						'export_no'=>'required',
						'export_date'=>'required',
						'subject'=>'required',
						'target_dept'=>'required',
						'export_date'=>'required',
						'file|prevFile' => 'mimes:jpeg,png,jpg,pdf,rar,zip|max:2048'
					];

				$customMessages = [
					'maktob_no.required' => 'نمبر مکتوب ضروری است',
					'export_no.required' => 'نمبر صادره ضروری است',
					'export_date.required' => 'تاریخ صادره ضروری است',
					'subject.required' => 'موضوع مکتوب ضروری است',
					'target_dept.required' => 'مرسل الیه ضروری است',
					];
					$this->validate($request,$ruls,$customMessages);

				$data = $request->all();

				if( $request->hasFile('file'))
				{ 
				        $img = $request->file('file'); 

				        $extension = $img->getClientOriginalExtension();
				        $doc = date('ymdHis').rand(1,99999).'.'.$extension; 
				      	 $request->file->storeAs('public/documents',$doc); 
				    } 
				    else if(!empty($data['prevFile']))
		                {
		                    $doc = $data['prevFile'];
		                }
				    else {
				        $doc = "";
				}	
				$result = SectorResponseMaktob::where('id',$id)->update([
						'dept' => Auth::user()->department_id,
						'maktob_no' => $data['maktob_no'],
						'export_no' => $data['export_no'],
						'export_date' => $data['export_date'],
						'subject' => $data['subject'],
						'target_dept' => $data['target_dept'],
						'doc_no' => $data['doc_no'],
						'shelf_no' => $data['shelf_no'],
						'shelf_row' => $data['shelf_row'],
						'year' => $data['year'],
						'remarks' => $data['remarks'],
						'file' => $doc,
						]);
					return redirect('dashboard/maktob-response-show')->with('success_message','معلومات موفقانه تغیر داده شد');
				}

				$data = SectorResponseMaktob::findOrFail($id)->toArray();
				$maktob_numbers = SectorMaktob::all();
				return view('sectors.maktob_response_edit')->with(compact('data','maktob_numbers'));
			}
		
	}
	public function deleteResponseMaktob($id)
    { 
		if (Auth::user()->hasRole('sector')) 
		{
			$data = SectorResponseMaktob::findOrFail($id);
			$data->delete();
			return redirect('dashboard/maktob-response-show')->with('success_message','مکتوب مربوطه از سیستم حذف گردید');
		}	
	}
	public function addSalahiatMaktob(Request $request)
	{
		if (Auth::user()->hasRole('sector')) 
	    {
			if($request->isMethod('post'))
			{
				$ruls = [
					'maktob_no'=>'required',
					'hukm_no'=>'required',
					'hukm_date'=>'required',
					'audit_dept'=>'required',
					'audit_year'=>'required',
					'quarter'=>'required',
					'city_id'=>'required',
					'audited_year'=>'required',
					'start_date'=>'required',
					'end_date'=>'required',
					'head_auditor'=>'required',
					'file' => 'mimes:jpeg,png,jpg,pdf,rar,zip|max:2048'
				];

			$customMessages = [
				'maktob_no.required' => 'نمبر مکتوب ضروری است',
				'hukm_no.required' => 'نمبر حکم ضروری است',
				'hukm_date.required' => 'تاریخ حکم ضروری است',
				'audit_dept.required' => 'مرجع ضروری است',
				'audit_year.required' =>'سال تحت تفتیش ضروری است',
				'quarter.required' => 'ربع را مشخص کنید',
				'head_auditor.required' => 'مفتیش را مشخص کنید',
				];
				$this->validate($request,$ruls,$customMessages);
				$data = $request->all();	
				if( $request->hasFile('file'))
				{ 
					$img = $request->file('file'); 

					$extension = $img->getClientOriginalExtension();
					$doc = date('ymdHis').rand(1,99999).'.'.$extension; 
					$request->file->storeAs('public/documents',$doc); 
				} 
				else {
					$doc = "";
				}

				$info = new SectorSalahiatMaktob;
				
				$info->dept = Auth::user()->department_id;
				$info->maktob_no = $data['maktob_no'];
				$info->hukm_no = $data['hukm_no'];
				$info->hukm_date = $data['hukm_date'];
				$info->audit_dept = $data['audit_dept'];
				$info->audit_year = $data['audit_year'];
				$info->audited_year = $data['audited_year'];
				$info->quarter = $data['quarter'];
				$info->head_auditor = $data['head_auditor'];
				$info->auditor1 = $data['auditor1'];
				$info->auditor2 = $data['auditor2'];
				$info->auditor3 = $data['auditor3'];
				$info->auditor4 = $data['auditor4'];
				$info->auditor5 = $data['auditor5'];
				$info->auditor6 = $data['auditor6'];
				$info->city_id = $data['city_id'];
				$info->start_date = $data['start_date'];
				$info->end_date = $data['end_date'];
				$info->doc_no = $data['doc_no'];
				$info->shelf_no = $data['shelf_no'];
				$info->shelf_row = $data['shelf_row'];
				$info->year = $data['year'];
				$info->remarks = $data['remarks'];
				$info->file = $doc;
				$info->save();	
				return redirect(route('sector.maktob_salahiat_show'))->with('success_message','معلومات موفقانه ذخیره گردید');
			}
			
			$arr['maktob_numbers'] = SectorMaktob::select(['maktob_no'])->orderBy('created_at','DESC')->get();
			$arr['cities'] = City::all();
			$arr['auditors'] = Auditor::select(['id','name'])->get();

			return view('sectors.maktob_salahiat_add')->with($arr);
		}		
	}
	public function showSalahiatMaktob()
	{
		if (Auth::user()->hasRole('sector')) 
		{
			$arr['info'] = SectorSalahiatMaktob::where(['dept'=>Auth::user()->department_id])->orderBy('created_at','DESC')->get();
			return view('sectors.maktob_salahiat_show')->with($arr);
		}
	}
	public function salahiatFileDownload($file)
	{
		$path = public_path().'/storage/documents/'.$file;
		return response()->download($path);
	}
	public function deleteSalahiatMaktob($id)
    { 
		if (Auth::user()->hasRole('sector')) 
		{
			$data = SectorSalahiatMaktob::findOrFail($id);
			$data->delete();
			return redirect('dashboard/maktob-salahiat-show')->with('success_message','صلاحیت نامه مربوطه از سیستم حذف گردید');
		}	
	}
	public function editSalahiatMaktob(Request $request,$id)
	{
		if (Auth::user()->hasRole('sector')) 
	    {
			if($request->isMethod('post'))
			{
				$ruls = [
					'maktob_no'=>'required',
					'hukm_no'=>'required',
					'hukm_date'=>'required',
					'audit_dept'=>'required',
					'audit_year'=>'required',
					'quarter'=>'required',
					 'head_auditor'=>'required',
				    'file' => 'mimes:jpeg,png,jpg,pdf|max:2048'
				];

			$customMessages = [
				'maktob_no.required' => 'نمبر مکتوب ضروری است',
				'hukm_no.required' => 'نمبر حکم ضروری است',
				'hukm_date.required' => 'تاریخ حکم ضروری است',
				'audit_dept.required' => 'مرجع ضروری است',
				'audit_year.required' =>'سال تحت تفتیش ضروری است',
				'quarter.required' => 'ربع را مشخص کنید',
				'head_auditor.required' => 'مفتیش را مشخص کنید',
				];
				$this->validate($request,$ruls,$customMessages);

			$data = $request->all();

			if( $request->hasFile('file'))
			{ 
					$img = $request->file('file'); 

					$extension = $img->getClientOriginalExtension();
					$doc = date('ymdHis').rand(1,99999).'.'.$extension; 
					$request->file->storeAs('public/documents',$doc); 
				} 
				else if(!empty($data['prevFile']))
					{
						$doc = $data['prevFile'];
					}
				else {
					$doc = "";
			}	
			$result = SectorSalahiatMaktob::where('id',$id)->update([
					'dept' => Auth::user()->department_id,
					'maktob_no' => $data['maktob_no'],
					'hukm_no' => $data['hukm_no'],
					'hukm_date' => $data['hukm_date'],
					'audit_dept' => $data['audit_dept'],
					'audit_year' => $data['audit_year'],
					'audited_year' => $data['audited_year'],
					'quarter' => $data['quarter'],
					'head_auditor' => $data['head_auditor'],
					'auditor1' => $data['auditor1'],
					'auditor2' => $data['auditor2'],
					'auditor3' => $data['auditor3'],
					'auditor4' => $data['auditor4'],
					'auditor5' => $data['auditor5'],
					'auditor6' => $data['auditor6'],
					'start_date' => $data['start_date'],
					'end_date' => $data['end_date'],
					'doc_no' => $data['doc_no'],
					'shelf_no' => $data['shelf_no'],
					'shelf_row' => $data['shelf_row'],
					'year' => $data['year'],
					'remarks' => $data['remarks'],
					'file' => $doc,
					]);
				return redirect('dashboard/maktob-salahiat-show')->with('success_message','معلومات موفقانه تغیر داده شد');
			}

			$data = SectorSalahiatMaktob::findOrFail($id)->toArray();
			$maktob_numbers = SectorMaktob::select(['maktob_no'])->orderBy('created_at','DESC')->get();
			$auditors = Auditor::select(['id','name'])->get();

			return view('sectors.maktob_salahiat_edit')->with(compact('data','maktob_numbers','auditors'));
		}
		
	}
	public function addPlanMaktob(Request $request)
	{
		if (Auth::user()->hasRole('sector')) 
	    {	
			if($request->isMethod('post'))
			{
				$ruls = [
					'maktob_no'=>'required',
					'plan_no'=>'required',
					'plan_date'=>'required',
					'file' => 'mimes:jpeg,png,jpg,pdf,rar,zip|max:2048'
				];

			$customMessages = [
				'maktob_no.required' => 'نمبر صلاحیت نامه ضروری است',
				'plan_no.required' => 'نمبر مکتوب پلان ضروری است',
				'plan_date.required' => 'تاریخ مکتوب پلان ضروری است',
				];
				$this->validate($request,$ruls,$customMessages);

				$data = $request->all();	
				if( $request->hasFile('file'))
				{ 
					$img = $request->file('file'); 

					$extension = $img->getClientOriginalExtension();
					$doc = date('ymdHis').rand(1,99999).'.'.$extension; 
					$request->file->storeAs('public/documents',$doc); 
				} 
				else {
					$doc = "";
				}

				$info = new SectorPlanMaktob;
				
				$info->dept = Auth::user()->department_id;
				$info->maktob_no = $data['maktob_no'];
				$info->plan_no = $data['plan_no'];
				$info->plan_date = $data['plan_date'];
				$info->plan_status = $data['plan_status'];
				$info->quality = $data['quality'];
				$info->verify_date = $data['verify_date'];
				$info->rmaktob_no = $data['rmaktob_no'];
				$info->rmaktob_date = $data['rmaktob_date'];
				$info->rmaktob_subject = $data['rmaktob_subject'];
				$info->doc_no = $data['doc_no'];
				$info->shelf_no = $data['shelf_no'];
				$info->shelf_row = $data['shelf_row'];
				$info->year = $data['year'];
				$info->remarks = $data['remarks'];
				$info->file = $doc;
				$info->save();	
				return redirect('dashboard/maktob-plan-show')->with('success_message','معلومات موفقانه ذخیره گردید');
			}
			$arr['maktob_numbers'] = SectorMaktob::select(['maktob_no'])->where('dept',Auth::user()->department_id)->orderBy('created_at','DESC')->get();
			
			return view('sectors.maktob_plan_add')->with($arr);
		}		
	}
	public function showPlanMaktob()
	{
		if (Auth::user()->hasRole('sector')) 
		{
			$arr['info'] = SectorPlanMaktob::where(['dept'=>Auth::user()->department_id])->orderBy('created_at','DESC')->get();
			return view('sectors.maktob_plan_show')->with($arr);
		}
	}
	public function planFileDownload($file)
	{
		$path = public_path().'/storage/documents/'.$file;
		return response()->download($path);
	}
	public function deletePlanMaktob($id)
    { 
		if (Auth::user()->hasRole('sector')) 
		{
			$data = SectorPlanMaktob::findOrFail($id);
			$data->delete();
			return redirect('dashboard/maktob-plan-show')->with('success_message','صلاحیت نامه مربوطه از سیستم حذف گردید');
		}	
	}
	public function editPlanMaktob(Request $request,$id)
	{
		if (Auth::user()->hasRole('sector')) 
	    {
			if($request->isMethod('post'))
			{
				$ruls = [
					'maktob_no'=>'required',
					'plan_no'=>'required',
					'plan_date'=>'required',
					'file' => 'mimes:jpeg,png,jpg,pdf,rar,zip|max:2048'
				];

			$customMessages = [
				'maktob_no.required' => 'نمبر صلاحیت نامه ضروری است',
				'plan_no.required' => 'نمبر مکتوب پلان ضروری است',
				'plan_date.required' => 'تاریخ مکتوب پلان ضروری است',
				];
				$this->validate($request,$ruls,$customMessages);

			$data = $request->all();

			if( $request->hasFile('file'))
			{ 
					$img = $request->file('file'); 

					$extension = $img->getClientOriginalExtension();
					$doc = date('ymdHis').rand(1,99999).'.'.$extension; 
					$request->file->storeAs('public/documents',$doc); 
				} 
				else if(!empty($data['prevFile']))
					{
						$doc = $data['prevFile'];
					}
				else {
					$doc = "";
			}	
			$result = SectorPlanMaktob::where('id',$id)->update([
				'dept'=>Auth::user()->department_id,
				'maktob_no' => $data['maktob_no'],
				'plan_no' => $data['plan_no'],
				'plan_date' => $data['plan_date'],
				'plan_status' => $data['plan_status'],
				'rmaktob_no' => $data['rmaktob_no'],
				'rmaktob_date' => $data['rmaktob_date'],
				'rmaktob_subject' => $data['rmaktob_subject'],
				'doc_no' => $data['doc_no'],
				'shelf_no' => $data['shelf_no'],
				'shelf_row' => $data['shelf_row'],
				'year' => $data['year'],
				'remarks' => $data['remarks'],
				'file' => $doc,
				]);
				return redirect('dashboard/maktob-plan-show')->with('success_message','معلومات موفقانه تغیر داده شد');
			}

			$data = SectorPlanMaktob::findOrFail($id)->toArray();
			$salahiat_numbers = SectorMaktob::select(['maktob_no'])->where('dept',Auth::user()->department_id)->orderBy('created_at','DESC')->get();

			return view('sectors.maktob_plan_edit')->with(compact('data','salahiat_numbers'));
		}
		
	}
	public function addAuditorReport(Request $request)
	{
		if (Auth::user()->hasRole('sector')) 
	    {
			if($request->isMethod('post'))
			{
				$ruls = [
					'maktob_no'=>'required',
					'report_no'=>'required',
					'report_date'=>'required',
					'report_subject'=>'required',
					'file' => 'mimes:jpeg,png,jpg,pdf,rar,zip|max:2048'
				];

			$customMessages = [
				'maktob_no.required' => 'نمبر صلاحیت نامه ضروری است',
				'report_no.required' => 'نمبر مکتوب گزارش ضروری است',
				'report_date.required' => 'تاریخ مکتوب گزارش ضروری است',
				'report_subject.required' => 'موضوع مکتوب ضروری است',
				];
				$this->validate($request,$ruls,$customMessages);
				$data = $request->all();	
				// echo "<pre>";print_r($data);die;
				if( $request->hasFile('file'))
				{ 
					$img = $request->file('file'); 

					$extension = $img->getClientOriginalExtension();
					$doc = date('ymdHis').rand(1,99999).'.'.$extension; 
					$request->file->storeAs('public/documents',$doc); 
				} 
				else {
					$doc = "";
				}

				$info = new SectorAuditorReport;
				$info->dept = Auth::user()->department_id;
				$info->maktob_no = $data['maktob_no'];
				$info->report_no = $data['report_no'];
				$info->report_date = $data['report_date'];
				$info->report_subject = $data['report_subject'];
				$info->report_quality = $data['report_quality'];
				$info->doc_no = $data['doc_no'];
				$info->shelf_no = $data['shelf_no'];
				$info->shelf_row = $data['shelf_row'];
				$info->year = $data['year'];
				$info->remarks = $data['remarks'];
				$info->file = $doc;
				$info->save();	
				return redirect(route('sector.report_auditor_show'))->with('success_message','معلومات موفقانه ذخیره گردید');
			}
			$arr['maktob_numbers'] = SectorMaktob::select(['maktob_no'])->where('dept',Auth::user()->department_id)->orderBy('created_at','DESC')->get();
			return view('sectors.report_auditor_add')->with($arr);
		}		
	}
	public function showAuditorReport()
	{
		if (Auth::user()->hasRole('sector')) 
		{
			$arr['info'] = SectorAuditorReport::where(['dept'=>Auth::user()->department_id])->orderBy('created_at','DESC')->get();
			return view('sectors.report_auditor_show')->with($arr);
		}
	}
	public function reportAuditorFileDownload($file)
	{
		$path = public_path().'/storage/documents/'.$file;
		return response()->download($path);
	}
	public function deleteAuditorReport($id)
    { 
		if (Auth::user()->hasRole('sector')) 
		{
			$data = SectorAuditorReport::findOrFail($id);
			$data->delete();
			return redirect('dashboard/report-auditor-show')->with('success_message','صلاحیت نامه مربوطه از سیستم حذف گردید');
		}	
	}
	public function editAuditorReport(Request $request,$id)
	{
		if (Auth::user()->hasRole('sector')) 
	    {
			if($request->isMethod('post'))
			{
				$ruls = [
					'maktob_no'=>'required',
					'report_no'=>'required',
					'report_date'=>'required',
					'report_subject'=>'required',
					'file' => 'mimes:jpeg,png,jpg,pdf|max:2048'
				];

			$customMessages = [
				'maktob_no.required' => 'نمبر صلاحیت نامه ضروری است',
				'report_no.required' => 'نمبر مکتوب گزارش ضروری است',
				'report_date.required' => 'تاریخ مکتوب گزارش ضروری است',
				'report_subject.required' => 'موضوع مکتوب ضروری است',
				];
				$this->validate($request,$ruls,$customMessages);

			$data = $request->all();

			if( $request->hasFile('file'))
			{ 
					$img = $request->file('file'); 

					$extension = $img->getClientOriginalExtension();
					$doc = date('ymdHis').rand(1,99999).'.'.$extension; 
						// dd($file); 
						$request->file->storeAs('public/documents',$doc); 
				} 
				else if(!empty($data['prevFile']))
					{
						$doc = $data['prevFile'];
					}
				else {
					$doc = "";
			}	
			$result = SectorAuditorReport::where('id',$id)->update([
				'maktob_no' => $data['maktob_no'],
				'report_no' => $data['report_no'],
				'report_date' => $data['report_date'],
				'report_subject' => $data['report_subject'],
				'doc_no' => $data['doc_no'],
				'shelf_no' => $data['shelf_no'],
				'shelf_row' => $data['shelf_row'],
				'year' => $data['year'],
				'remarks' => $data['remarks'],
				'file' => $doc,
				]);
				return redirect('dashboard/report-auditor-show')->with('success_message','معلومات موفقانه تغیر داده شد');
			}

			$data = SectorAuditorReport::findOrFail($id)->toArray();
			$salahiat_numbers = SectorMaktob::select(['maktob_no'])->get();
			return view('sectors.report_auditor_edit')->with(compact('data','salahiat_numbers'));
		}
		
	}
	public function addAnalyseReport(Request $request)
	{
		if (Auth::user()->hasRole('sector')) 
	    {
			if($request->isMethod('post'))
			{
				$ruls = [
					'maktob_no'=>'required',
					'send_report_no'=>'required',
					'send_report_date'=>'required',
					'send_report_subject'=>'required',
					'file' => 'mimes:jpeg,png,jpg,pdf,rar,zip|max:2048'
				];

			$customMessages = [
				'maktob_no.required' => 'نمبر صلاحیت نامه ضروری است',
				'send_report_no.required' => 'نمبر مکتوب ارسال ضروری است',
				'send_report_date.required' => 'تاریخ مکتوب ارسال ضروری است',
				'send_report_subject.required' => 'موضوع مکتوب ارسال است',
				];
				$this->validate($request,$ruls,$customMessages);
				$data = $request->all();	
				// echo "<pre>";print_r($data);die;
				if( $request->hasFile('file'))
				{ 
					$img = $request->file('file'); 

					$extension = $img->getClientOriginalExtension();
					$doc = date('ymdHis').rand(1,99999).'.'.$extension; 
					$request->file->storeAs('public/documents',$doc); 
				} 
				else {
					$doc = "";
				}

				$info = new SectorAnalyseReport;
				
				$info->dept = Auth::user()->department_id;
				$info->maktob_no = $data['maktob_no'];
				$info->send_report_no = $data['send_report_no'];
				$info->send_report_date = $data['send_report_date'];
				$info->send_report_subject = $data['send_report_subject'];
				$info->receive_report_no = $data['receive_report_no'];
				$info->receive_report_date = $data['receive_report_date'];
				$info->receive_report_subject = $data['receive_report_subject'];
				$info->status = $data['status'];
				$info->send_verify_date = $data['send_verify_date'];
				$info->receive_verify_date = $data['receive_verify_date'];
				$info->export_date = $data['export_date'];
				$info->doc_no = $data['doc_no'];
				$info->shelf_no = $data['shelf_no'];
				$info->shelf_row = $data['shelf_row'];
				$info->year = $data['year'];
				$info->remarks = $data['remarks'];
				$info->file = $doc;
				$info->save();	
				return redirect('dashboard/report-analyse-show')->with('success_message','معلومات موفقانه ذخیره گردید');
			}
			$arr['maktob_numbers'] = SectorMaktob::select(['maktob_no'])->where('dept',Auth::user()->department_id)->orderBy('created_at','DESC')->get();
			return view('sectors.report_analyse_add')->with($arr);
		}		
	}
	public function showAnalyseReport()
	{
		if (Auth::user()->hasRole('sector')) 
		{
			$arr['info'] = SectorAnalyseReport::where(['dept'=>Auth::user()->department_id])->orderBy('created_at','DESC')->get();
			// $data=json_decode(json_encode($arr['info']),true);
		    // echo "<pre>";print_r($data);die;
			return view('sectors.report_analyse_show')->with($arr);
		}
	}
	public function reportAnalyseFileDownload($file)
	{
		$path = public_path().'/storage/documents/'.$file;
		return response()->download($path);
	}
	public function deleteAnalyseReport($id)
    { 
		if (Auth::user()->hasRole('sector')) 
		{
			$data = SectorAnalyseReport::findOrFail($id);
			$data->delete();
			return redirect('dashboard/report-analyse-show')->with('success_message','گزارش مربوطه از سیستم حذف گردید');
		}	
	}
	public function editAnalyseReport(Request $request,$id)
	{
		if (Auth::user()->hasRole('sector')) 
	    {
			if($request->isMethod('post'))
			{
				$ruls = [
					'maktob_no'=>'required',
					'send_report_no'=>'required',
					'send_report_date'=>'required',
					'send_report_subject'=>'required',
					'file' => 'mimes:jpeg,png,jpg,pdf,rar,zip|max:2048'
				];

			$customMessages = [
				'maktob_no.required' => 'نمبر صلاحیت نامه ضروری است',
				'send_report_no.required' => 'نمبر مکتوب ارسال ضروری است',
				'send_report_date.required' => 'تاریخ مکتوب ارسال ضروری است',
				'send_report_subject.required' => 'موضوع مکتوب ارسال ضروری است',
				];
				$this->validate($request,$ruls,$customMessages);

			$data = $request->all();

			if( $request->hasFile('file'))
			{ 
					$img = $request->file('file'); 

					$extension = $img->getClientOriginalExtension();
					$doc = date('ymdHis').rand(1,99999).'.'.$extension; 
					$request->file->storeAs('public/documents',$doc); 
				} 
				else if(!empty($data['prevFile']))
					{
						$doc = $data['prevFile'];
					}
				else {
					$doc = "";
			}	
			$result = SectorAnalyseReport::where('id',$id)->update([
				'dept' => Auth::user()->department_id,
				'maktob_no' => $data['maktob_no'],
				'send_report_no' => $data['send_report_no'],
				'send_report_date' => $data['send_report_date'],
				'send_report_subject' => $data['send_report_subject'],
				'receive_report_no' => $data['receive_report_no'],
				'receive_report_date' => $data['receive_report_date'],
				'receive_report_subject' => $data['receive_report_subject'],
				'status' => $data['status'],
				'send_verify_date' => $data['send_verify_date'],
				'receive_verify_date' => $data['receive_verify_date'],
				'export_date' => $data['export_date'],
				'doc_no' => $data['doc_no'],
				'shelf_no' => $data['shelf_no'],
				'shelf_row' => $data['shelf_row'],
				'year' => $data['year'],
				'remarks' => $data['remarks'],
				'file' => $doc
				]);
				return redirect(route('sector.report_analyse_show'))->with('success_message','معلومات موفقانه تغیر داده شد');
			}

			$data = SectorAnalyseReport::findOrFail($id)->toArray();
			$salahiat_numbers = SectorMaktob::select(['maktob_no'])->where('dept',Auth::user()->department_id)->orderBy('created_at','DESC')->get();
			return view('sectors.report_analyse_edit')->with(compact('data','salahiat_numbers'));
		}
		
	}
	public function addSourceReport(Request $request)
	{
		if (Auth::user()->hasRole('sector')) 
	    {
			if($request->isMethod('post'))
			{
				$ruls = [
					'maktob_no'=>'required',
					'report_no'=>'required',
					'report_date'=>'required',
					'report_subject'=>'required',
					'city'=>'required',
					'source'=>'required',
					'file' => 'mimes:jpeg,png,jpg,pdf,rar,zip|max:2048'
				];

			$customMessages = [
				'maktob_no.required' => 'نمبر صلاحیت نامه ضروری است',
				'report_no.required' => 'نمبر مکتوب ضروری است',
				'report_date.required' => 'تاریخ مکتوب  ضروری است',
				'report_subject.required' => 'موضوع مکتوب است',
				'city.required' => 'ولایت را انتخاب کنید',
				'source.required' => 'مرجع را مشخص کنید',
				];
				$this->validate($request,$ruls,$customMessages);
				$data = $request->all();	
				// echo "<pre>";print_r($data);die;
				if( $request->hasFile('file'))
				{ 
					$img = $request->file('file'); 

					$extension = $img->getClientOriginalExtension();
					$doc = date('ymdHis').rand(1,99999).'.'.$extension; 
					$request->file->storeAs('public/documents',$doc); 
				} 
				else {
					$doc = "";
				}

				$info = new SectorSourceReport;
				$info->dept = Auth::user()->department_id;
				$info->maktob_no = $data['maktob_no'];
				$info->report_no = $data['report_no'];
				$info->report_date = $data['report_date'];
				$info->report_subject = $data['report_subject'];
				$info->city = $data['city'];
				$info->source = $data['source'];
				$info->doc_no = $data['doc_no'];
				$info->shelf_no = $data['shelf_no'];
				$info->shelf_row = $data['shelf_row'];
				$info->year = $data['year'];
				$info->remarks = $data['remarks'];
				$info->file = $doc;
				$info->save();	
				return redirect(route('sector.report_source_show'))->with('success_message','معلومات موفقانه ذخیره گردید');
			}
			$arr['salahiat_numbers'] = SectorMaktob::select(['maktob_no'])->where('dept',Auth::user()->department_id)->orderBy('created_at','DESC')->get();
			$arr['cities'] = City::all();
			return view('sectors.report_source_add')->with($arr);
		}		
	}
	public function showSourceReport()
	{
		if (Auth::user()->hasRole('sector')) 
		{
			$arr['info'] = SectorSourceReport::where(['dept'=>Auth::user()->department_id])->orderBy('created_at','DESC')->get();
			return view('sectors.report_source_show')->with($arr);
		}
	}
	public function reportSourceFileDownload($file)
	{
		$path = public_path().'/storage/documents/'.$file;
		return response()->download($path);
	}
	public function deleteSourceReport($id)
    { 
		if (Auth::user()->hasRole('sector')) 
		{
			$data = SectorSourceReport::findOrFail($id);
			$data->delete();
			return redirect('dashboard/report-source-show')->with('success_message','گزارش مربوطه از سیستم حذف گردید');
		}	
	}
	public function editSourceReport(Request $request,$id)
	{
		if (Auth::user()->hasRole('sector')) 
	    {
			if($request->isMethod('post'))
			{
				$ruls = [
					'maktob_no'=>'required',
					'report_no'=>'required',
					'report_date'=>'required',
					'report_subject'=>'required',
					'city'=>'required',
					'source'=>'required',
					'file' => 'mimes:jpeg,png,jpg,pdf,rar,zip|max:2048'
				];

			$customMessages = [
				'maktob_no.required' => 'نمبر صلاحیت نامه ضروری است',
				'report_no.required' => 'نمبر مکتوب ضروری است',
				'report_date.required' => 'تاریخ مکتوب ضروری است',
				'report_subject.required' => 'موضوع مکتوب ضروری است',
				'city.required' => 'ولایت را مشخص کنید',
				'source.required' => 'مرجع ضروری است',
				];
				$this->validate($request,$ruls,$customMessages);

			$data = $request->all();

			if( $request->hasFile('file'))
			{ 
					$img = $request->file('file'); 

					$extension = $img->getClientOriginalExtension();
					$doc = date('ymdHis').rand(1,99999).'.'.$extension; 
						// dd($file); 
						$request->file->storeAs('public/documents',$doc); 
				} 
				else if(!empty($data['prevFile']))
					{
						$doc = $data['prevFile'];
					}
				else {
					$doc = "";
			}	
			$result = SectorSourceReport::where('id',$id)->update([
				'dept' =>Auth::user()->department_id,
				'maktob_no' => $data['maktob_no'],
				'report_no' => $data['report_no'],
				'report_date' => $data['report_date'],
				'report_subject' => $data['report_subject'],
				'city' => $data['city'],
				'source' => $data['source'],
				'doc_no' => $data['doc_no'],
				'shelf_no' => $data['shelf_no'],
				'shelf_row' => $data['shelf_row'],
				'year' => $data['year'],
				'remarks' => $data['remarks'],
				'file' => $doc,
				]);
				return redirect(route('sector.report_source_show'))->with('success_message','معلومات موفقانه تغیر داده شد');
			}

			$data = SectorSourceReport::findOrFail($id)->toArray();
			$cities = City::all();
			$salahiat_numbers = SectorMaktob::select(['maktob_no'])->where('dept',Auth::user()->department_id)->orderBy('created_at','DESC')->get();
			return view('sectors.report_source_edit')->with(compact('data','salahiat_numbers','cities'));
		}
		
	}
	public function addAuditor(Request $request)
	{
		if (Auth::user()->hasRole('sector')) 
	    {
			if($request->isMethod('post'))
			{
				$ruls = [
					'name'=>'required',
					'job'=>'required',
					'rank'=>'required',
				  //  'email'=>'email:rfc,dns',
					'phone'=>'required|min:10|max:12',
				];

			$customMessages = [
				'name.required' => 'اسم لازمی است',
				'job.required' => 'عنوان بست لازمی است',
				'rank.required' => 'درجه بست لازمی است',
				'phone.required' => 'نمبر تماس لازمی است',
				];
				$this->validate($request,$ruls,$customMessages);
				$data = $request->all();	
				// echo "<pre>";print_r($data);die;

				$info = new Auditor;
				
				$info->name = $data['name'];
				$info->fname = $data['fname'];
				$info->job = $data['job'];
				$info->rank = $data['rank'];
				$info->email = $data['email'];
				$info->phone = $data['phone'];
				$info->whatsapp = $data['whatsapp'];
				$info->dept = Auth::user()->department_id;
				$info->remarks = $data['remarks'];
				$info->save();	
				return redirect('dashboard/auditor-show')->with('success_message','معلومات موفقانه ذخیره گردید');
			}

			return view('sectors.auditor_add');
		}		
	}
	public function showAuditor()
	{
		if (Auth::user()->hasRole('sector')) 
		{
		    $arr['info'] = Auditor::where(['dept'=>Auth::user()->department_id])->orderBy('created_at','DESC')->get();
		    // $data=json_decode(json_encode($arr['info']),true);
		    // echo "<pre>";print_r($data);die;
			return view('sectors.auditor_show')->with($arr);
		}
	}
	public function editAuditor(Request $request,$id)
	{
		if (Auth::user()->hasRole('sector')) 
	    {
			if($request->isMethod('post'))
			{
				$ruls = [
					'name'=>'required',
					'job'=>'required',
					'rank'=>'required',
					// 'email'=>'required|email:rfc,dns',
					'phone'=>'required|min:10|max:12',
				];

				$customMessages = [
					'name.required' => 'اسم لازمی است',
					'job.required' => 'عنوان بست لازمی است',
					'rank.required' => 'درجه بست لازمی است',
					'email.required' => 'ایمیل لازمی است',
					// 'email.email' => 'ایمل درست را وارید کنید',
					'phone.required' => 'نمبر تماس لازمی است',
				];
				$this->validate($request,$ruls,$customMessages);
			$data = $request->all();

			$result = Auditor::where('id',$id)->update([
				'name' => $data['name'],
				'fname' => $data['fname'],
				'job' => $data['job'],
				'rank' => $data['rank'],
				'email' => $data['email'],
				'phone' => $data['phone'],
				'whatsapp' => $data['whatsapp'],
				'dept' => Auth::user()->department_id,
				'remarks' => $data['remarks'],
				]);
				return redirect('dashboard/auditor-show')->with('success_message','معلومات موفقانه تغیر داده شد');
			}
			$data = Auditor::findOrFail($id)->toArray();
			return view('sectors.auditor_edit')->with(compact('data'));
		}
		
	}
	public function deleteAuditor($id)
    { 
		if (Auth::user()->hasRole('sector')) 
		{
			$data = Auditor::findOrFail($id);
			$data->delete();
			return redirect('dashboard/auditor-show')->with('success_message','مفتیش مربوطه از سیستم حذف گردید');
		}	
	}
	public function addSuggestion(Request $request)
	{
		if (Auth::user()->hasRole('sector')) 
	    {
			if($request->isMethod('post'))
			{
				$ruls = [
					'sug_no'=>'required',
					'sug_subject'=>'required',
					'sug_date'=>'required',
					//'file' => 'mimes:jpeg,png,jpg,pdf,rar,zip|max:2048',
				];

			$customMessages = [
				'sug_no.required' => 'نمبر پیشنهاد ضروری است',
				'sug_date.required' => 'تاریخ پیشنهاد ضروری است',
				'sug_date.required' => 'موضوع پیشنهاد ضروری است',
				];
				$this->validate($request,$ruls,$customMessages);
				$data = $request->all();	
				// echo "<pre>";print_r($data);die;
				if( $request->hasFile('file'))
				{ 
					$img = $request->file('file'); 

					$extension = $img->getClientOriginalExtension();
					$doc = date('ymdHis').rand(1,99999).'.'.$extension; 
					$request->file->storeAs('public/documents',$doc); 
				} 
				else {
					$doc = "";
				}

				$info = new Suggestion;
				
				$info->dept = Auth::user()->department_id;
				$info->sug_no = $data['sug_no'];
				$info->sug_date = $data['sug_date'];
				$info->sug_subject = $data['sug_subject'];
				$info->sug_verify_date = $data['sug_verify_date'];
				$info->sug_status = $data['sug_status'];
				$info->sug_remarks = $data['sug_remarks'];
				$info->file = $doc;
				$info->save();	
				return redirect('dashboard/suggestion-show')->with('success_message','معلومات موفقانه ذخیره گردید');
			}

			return view('sectors.suggestion_add');
		}		
	}
	public function showSuggestion()
	{
		if (Auth::user()->hasRole('sector')) 
		{
		    $arr['info'] = Suggestion::where(['dept'=>Auth::user()->department_id])->orderBy('created_at','DESC')->get();
		    // $data=json_decode(json_encode($arr['info']),true);
		    // echo "<pre>";print_r($data);die;
			return view('sectors.suggestion_show')->with($arr);
		}
	}
	public function editSuggestion(Request $request,$id)
	{
		if (Auth::user()->hasRole('sector')) 
	    {
			if($request->isMethod('post'))
			{
				$ruls = [
					'sug_no'=>'required',
					'sug_subject'=>'required',
					'sug_date'=>'required',
					'file' => 'mimes:jpeg,png,jpg,pdf,rar,zip|max:2048'
				];

			$customMessages = [
				'sug_no.required' => 'نمبر پیشنهاد ضروری است',
				'sug_date.required' => 'تاریخ پیشنهاد ضروری است',
				'sug_date.required' => 'موضوع پیشنهاد ضروری است',
				];
				$this->validate($request,$ruls,$customMessages);

			$data = $request->all();

			if( $request->hasFile('file'))
			{ 
					$img = $request->file('file'); 

					$extension = $img->getClientOriginalExtension();
					$doc = date('ymdHis').rand(1,99999).'.'.$extension; 
						// dd($file); 
					$request->file->storeAs('public/documents',$doc); 
				} 
				else if(!empty($data['prevFile']))
					{
						$doc = $data['prevFile'];
					}
				else {
					$doc = "";
			}	
			$result = Suggestion::where('id',$id)->update([
				'dept' => Auth::user()->department_id,
				'sug_no' => $data['sug_no'],
				'sug_date' => $data['sug_date'],
				'sug_subject' => $data['sug_subject'],
				'sug_verify_date' => $data['sug_verify_date'],
				'sug_status' => $data['sug_status'],
				'sug_remarks' => $data['sug_remarks'],
				'file' => $doc,
				]);
				return redirect('dashboard/suggestion-show')->with('success_message','معلومات موفقانه تغیر داده شد');
			}
			$arr['data'] = Suggestion::findOrFail($id)->toArray();

			return view('sectors.suggestion_edit')->with($arr);
		}
		
	}
	public function downloadSuggestion($file)
	{
		$path = public_path().'/storage/documents/'.$file;
		return response()->download($path);
	}
	public function deleteSuggestion($id)
    { 
		if (Auth::user()->hasRole('sector')) 
		{
			$data = Suggestion::findOrFail($id);
			$data->delete();
			return redirect('dashboard/suggestion-show')->with('success_message','پشنهاد مربوطه از سیستم حذف گردید');
		}	
	}
	public function addClaim(Request $request)
	{
		if (Auth::user()->hasRole('sector')) 
	    {
			if($request->isMethod('post'))
			{
				$ruls = [
					'maktob_no'=>'required',
					'subject'=>'required',
					'status'=>'required',
					'source'=>'required',
					'file' => 'mimes:jpeg,png,jpg,pdf,rar|max:2048'
				];

			$customMessages = [
				'maktob_no.required' => 'نمبر صلاحیت نامه ضروری است',
				'subject.required' => 'موضوع اعتراضیه ضروری است',
				'status.required' => 'حالت اعتراض را مشخص کنید',
				'source.required' => 'مرجع ضروری است'
				];
				$this->validate($request,$ruls,$customMessages);

				$data = $request->all();	
			//	 echo "<pre>";print_r($data);die;
				if( $request->hasFile('file'))
				{ 
					$img = $request->file('file'); 

					$extension = $img->getClientOriginalExtension();
					$doc = date('ymdHis').rand(1,99999).'.'.$extension; 
						 dd($file); 
						$request->file->storeAs('public/documents',$doc); 
				} 
				else {
					$doc = "";
				}

				$info = new Claim;
				
				$info->dept = Auth::user()->department_id;
				$info->maktob_no = $data['maktob_no'];
				$info->subject = $data['subject'];
				$info->status = $data['status'];
				$info->source = $data['source'];
				$info->reject_no = $data['reject_no'];
				$info->reject_date = $data['reject_date'];
				$info->reject_subject = $data['reject_subject'];
				$info->analyzed_no = $data['analyzed_no'];
				$info->claim_no = $data['claim_no'];
				$info->claim_date = $data['claim_date'];
				$info->claim_files = $data['claim_files'];
				$info->auditors = $data['auditors'];
				$info->group_no = $data['group_no'];
				$info->group_date = $data['group_date'];
				$info->group_recived_date= $data['group_recived_date'];
				$info->authority_date = $data['authority_date'];
				$info->hukm_no = $data['hukm_no'];
				$info->hukm_date = $data['hukm_date'];
				$info->hukm = $data['hukm'];
				$info->board_no = $data['board_no'];
				$info->board_date = $data['board_date'];
				$info->board_files = $data['board_files'];
				$info->result_no = $data['result_no'];
				$info->result_date = $data['result_date'];
				$info->result = $data['result'];
				$info->send_date = $data['send_date'];
				$info->send_no = $data['send_no'];
				$info->remarks = $data['remarks'];
				$info->file = $doc;
				$info->save();	
				return redirect('dashboard/claim-show')->with('success_message','معلومات موفقانه ذخیره گردید');
			}
			$arr['maktob_nos'] = SectorMaktob::where(['dept'=>auth()->user()->department_id])->get();
;
			return view('sectors.claim_add')->with($arr);
		}		
	}
	public function showClaim()
	{
		if (Auth::user()->hasRole('sector')) 
		{
		    $arr['info'] = Claim::where(['dept'=>Auth::user()->department_id])->orderBy('created_at','DESC')->get();
		    // $data=json_decode(json_encode($arr['info']),true);
		    // echo "<pre>";print_r($data);die;
			return view('sectors.claim_show')->with($arr);
		}
	}
	public function downloadClaim($file)
	{
		$path = public_path().'/storage/documents/'.$file;
		return response()->download($path);
	}
	public function deleteClaim($id)
    { 
		if (Auth::user()->hasRole('sector')) 
		{
			$data = Claim::findOrFail($id);
			$data->delete();
			return redirect('dashboard/claim-show')->with('success_message','اعتراضیه مربوطه از سیستم حذف گردید');
		}	
	}
	public function editCliam(Request $request,$id)
	{
		if (Auth::user()->hasRole('sector')) 
	    {
			if($request->isMethod('post'))
			{
				$ruls = [
					'maktob_no'=>'required',
					'subject'=>'required',
					'status'=>'required',
					'source'=>'required',
					'file' => 'mimes:jpeg,png,jpg,pdf,rar|max:2048'
				];

			$customMessages = [
				'maktob_no.required' => 'نمبر صلاحیت نامه ضروری است',
				'subject.required' => 'موضوع اعتراضیه ضروری است',
				'status.required' => 'حالت اعتراض را مشخص کنید',
				'source.required' => 'مرجع ضروری است'
				];
				$this->validate($request,$ruls,$customMessages);

			$data = $request->all();

			if( $request->hasFile('file'))
			{ 
					$img = $request->file('file'); 

					$extension = $img->getClientOriginalExtension();
					$doc = date('ymdHis').rand(1,99999).'.'.$extension; 
						// dd($file); 
						$request->file->storeAs('public/documents',$doc); 
				} 
				else if(!empty($data['prevFile']))
					{
						$doc = $data['prevFile'];
					}
				else {
					$doc = "";
			}	
			$result = Claim::where('id',$id)->update([
				'dept' => Auth::user()->department_id,
				'maktob_no' => $data['maktob_no'],
				'subject' => $data['subject'],
				'status' => $data['status'],
				'source' => $data['source'],
				'reject_no' => $data['reject_no'],
				'reject_date' => $data['reject_date'],
				'reject_subject' => $data['reject_subject'],
				'analyzed_no' => $data['analyzed_no'],
				'claim_no' => $data['claim_no'],
				'claim_date' => $data['claim_date'],
				'claim_files' => $data['claim_files'],
				'auditors' => $data['auditors'],
				'group_no' => $data['group_no'],
				'group_date' => $data['group_date'],
				'group_recived_date'=> $data['group_recived_date'],
				'authority_date' => $data['authority_date'],
				'hukm_no' => $data['hukm_no'],
				'hukm_date' => $data['hukm_date'],
				'hukm' => $data['hukm'],
				'board_no' => $data['board_no'],
				'board_date' => $data['board_date'],
				'board_files' => $data['board_files'],
				'result_no' => $data['result_no'],
				'result_date' => $data['result_date'],
				'result' => $data['result'],
				'send_date' => $data['send_date'],
				'send_no' => $data['send_no'],
				'remarks' => $data['remarks'],
				'file' => $doc,
				]);
				return redirect('dashboard/claim-show')->with('success_message','معلومات موفقانه تغیر داده شد');
			}

			$arr['data'] = Claim::where(['dept'=>auth()->user()->department_id])->findOrFail($id)->toArray();
			$arr['maktob_nos'] = SectorMaktob::where(['dept'=>auth()->user()->department_id])->get();
			return view('sectors.claim_edit')->with($arr);
		}
		
	}
	public function addJustice(Request $request)
	{
		if (Auth::user()->hasRole('sector')) 
	    {
			if($request->isMethod('post'))
			{
				$ruls = [
					'maktob_no'=>'required',
					'file' => 'mimes:jpeg,png,jpg,pdf|max:2048'
				];

			$customMessages = [
				'maktob_no.required' => 'نمبر صلاحیت نامه ضروری است'
				];
				$this->validate($request,$ruls,$customMessages);

				$data = $request->all();	
			//	 echo "<pre>";print_r($data);die;
				if( $request->hasFile('file'))
				{ 
					$img = $request->file('file'); 
					$extension = $img->getClientOriginalExtension();
					$doc = date('ymdHis').rand(1,99999).'.'.$extension; 
					$request->file->storeAs('public/documents',$doc); 
				} 
				else {
					$doc = "";
				}

				$info = new Justice;
				
				$info->dept = Auth::user()->department_id;
				$info->maktob_no = $data['maktob_no'];
				$info->source = $data['source'];
				$info->auditors = $data['auditors'];
				$info->subject = $data['subject'];
				$info->sug_no = $data['sug_no'];
				$info->sug_date = $data['sug_date'];
				$info->board_no = $data['board_no'];
				$info->board_date = $data['board_date'];
				$info->result = $data['result'];
				$info->result_no = $data['result_no'];
				$info->result_date= $data['result_date'];
				$info->judge_no = $data['judge_no'];
				$info->judge_date = $data['judge_date'];
				$info->remarks = $data['remarks'];
				$info->file = $doc;
				$info->save();	
				return redirect('dashboard/justice-show')->with('success_message','معلومات موفقانه ذخیره گردید');
			}

			$arr['maktob_no'] = SectorMaktob::where(['dept'=>auth()->user()->department_id])->get();
			return view('sectors.justice_add')->with($arr);
		}		
	}
	public function showJustice()
	{
		if (Auth::user()->hasRole('sector')) 
		{
		    $arr['info'] = Justice::where(['dept'=>Auth::user()->department_id])->orderBy('created_at','DESC')->get();
		    // $data=json_decode(json_encode($arr['info']),true);
		    // echo "<pre>";print_r($data);die;
			return view('sectors.justice_show')->with($arr);
		}
	}
	public function downloadJustice($file)
	{
		$path = public_path().'/storage/documents/'.$file;
		return response()->download($path);
	}
	public function deleteJustice($id)
    { 
		if (Auth::user()->hasRole('sector')) 
		{
			$data = Justice::findOrFail($id);
			$data->delete();
			return redirect('dashboard/justice-show')->with('success_message','ریکارد مربوطه از سیستم حذف گردید');
		}	
	}
	public function editJustice(Request $request,$id)
	{
		if (Auth::user()->hasRole('sector')) 
	    {
			if($request->isMethod('post'))
			{
				$ruls = [
					'maktob_no'=>'required',
					'file' => 'mimes:jpeg,png,jpg,pdf|max:2048'
				];

			$customMessages = [
				'maktob_no.required' => 'نمبر صلاحیت نامه ضروری است'
				];
				$this->validate($request,$ruls,$customMessages);

			$data = $request->all();

			if( $request->hasFile('file'))
			{ 
					$img = $request->file('file'); 

					$extension = $img->getClientOriginalExtension();
					$doc = date('ymdHis').rand(1,99999).'.'.$extension; 
					$request->file->storeAs('public/documents',$doc); 
				} 
				else if(!empty($data['prevFile']))
					{
						$doc = $data['prevFile'];
					}
				else {
					$doc = "";
			}	
			$result = Justice::where('id',$id)->update([
				'dept' => Auth::user()->department_id,
				'maktob_no' => $data['maktob_no'],
				'source' => $data['source'],
				'auditors' => $data['auditors'],
				'subject' => $data['subject'],
				'sug_no' => $data['sug_no'],
				'sug_date' => $data['sug_date'],
				'board_no' => $data['board_no'],
				'board_date' => $data['board_date'],
				'result' => $data['result'],
				'result_no' => $data['result_no'],
				'result_date'=> $data['result_date'],
				'judge_no' => $data['judge_no'],
				'judge_date' => $data['judge_date'],
				'remarks' => $data['remarks'],
				'file' => $doc,
				]);
				return redirect('dashboard/justice-show')->with('success_message','معلومات موفقانه تغیر داده شد');
			}
			$arr['data'] = Justice::findOrFail($id)->toArray();
			$arr['maktob_no'] = SectorMaktob::where(['dept'=>auth()->user()->department_id])->get();

			return view('sectors.justice_edit')->with($arr);
		}
		
	}
	public function addControl(Request $request)
	{
		if (Auth::user()->hasRole('sector')) 
	    {
			if($request->isMethod('post'))
			{
				$ruls = [
					'source' => 'required',
					'file' => 'mimes:jpeg,png,jpg,pdf|max:2048'
				];

			$customMessages = [
				];
				$this->validate($request,$ruls,$customMessages);

				$data = $request->all();	
			//	 echo "<pre>";print_r($data);die;
				if( $request->hasFile('file'))
				{ 
					$img = $request->file('file'); 
					$extension = $img->getClientOriginalExtension();
					$doc = date('ymdHis').rand(1,99999).'.'.$extension; 
					$request->file->storeAs('public/documents',$doc); 
				} 
				else {
					$doc = "";
				}

				$info = new Control;
				
				$info->dept = Auth::user()->department_id;
				$info->source = $data['source'];
				$info->auditors = $data['auditors'];
				$info->date = $data['date'];
				$info->controller = $data['controller'];
				$info->type = $data['type'];
				$info->step = $data['step'];
				$info->progress = $data['progress'];
				$info->result = $data['result'];
				$info->decision = $data['decision'];
				$info->remarks = $data['remarks'];
				$info->file = $doc;
				$info->save();	
				return redirect('dashboard/control-show')->with('success_message','معلومات موفقانه ذخیره گردید');
			}
		
			return view('sectors.control_add');
		}		
	}
	public function showControl()
	{
		if (Auth::user()->hasRole('sector')) 
		{
		    $arr['info'] = Control::where(['dept'=>Auth::user()->department_id])->orderBy('created_at','DESC')->get();
		    // $data=json_decode(json_encode($arr['info']),true);
		    // echo "<pre>";print_r($data);die;
			return view('sectors.control_show')->with($arr);
		}
	}
	public function deleteControl($id)
    { 
		if (Auth::user()->hasRole('sector')) 
		{
			$data = Control::findOrFail($id);
			$data->delete();
			return redirect('dashboard/control-show')->with('success_message','ریکارد مربوطه از سیستم حذف گردید');
		}	
	}
	public function editControl(Request $request,$id)
	{
		if (Auth::user()->hasRole('sector')) 
	    {
			if($request->isMethod('post'))
			{
				$ruls = [
					'file' => 'mimes:jpeg,png,jpg,pdf|max:2048',
					'source' => 'required',
				];

			$customMessages = [
				];
				$this->validate($request,$ruls,$customMessages);

			$data = $request->all();
			if( $request->hasFile('file'))
			{ 
					$img = $request->file('file'); 

					$extension = $img->getClientOriginalExtension();
					$doc = date('ymdHis').rand(1,99999).'.'.$extension; 
					$request->file->storeAs('public/documents',$doc); 
				} 
				else if(!empty($data['prevFile']))
					{
						$doc = $data['prevFile'];
					}
				else {
					$doc = "";
			}

			$result = Control::where('id',$id)->update([
				'dept' => Auth::user()->department_id,
				'source' => $data['source'],
				'auditors' => $data['auditors'],
				'date' => $data['date'],
				'controller' => $data['controller'],
				'type' => $data['type'],
				'step' => $data['step'],
				'progress' => $data['progress'],
				'result' => $data['result'],
				'decision' => $data['decision'],
				'remarks' => $data['remarks'],
				'file' => $doc,
				]);
				return redirect('dashboard/control-show')->with('success_message','معلومات موفقانه تغیر داده شد');
			}
			$arr['data'] = Control::findOrFail($id)->toArray();
			return view('sectors.control_edit')->with($arr);
		}
		
	}
	public function downloadControl($file)
	{
		$path = public_path().'/storage/documents/'.$file;
		return response()->download($path);
	}

	// Excel Exports
	public function ControlExcel()
	{
		if (Auth::user()->hasRole('sector')) 
		{
			$file_name = 'نظارت_'.date('Y_m_d_H_i_s').'.xlsx';
			return Excel::download(new ControlExport, $file_name);
		}
	}
	public function JusticeExcel()
	{
		if (Auth::user()->hasRole('sector')) 
		{
			$file_name = 'تعقیب عدلی_'.date('Y_m_d_H_i_s').'.xlsx';
			return Excel::download(new JusticeExport, $file_name);
		}
	}
	public function CliamExcel()
	{
		if (Auth::user()->hasRole('sector')) 
		{
			$file_name = 'اعتراضیه-'.date('Y_m_d_H_i_s').'.xlsx';
			return Excel::download(new CliamExport, $file_name);
		}
	}
	public function SuggestionExcel()
	{
		if (Auth::user()->hasRole('sector')) 
		{
			$file_name = 'پیشنهاد-'.date('Y_m_d_H_i_s').'.xlsx';
			return Excel::download(new SuggestionExport, $file_name);
		}
	}
	public function AuditorExcel()
	{
		if (Auth::user()->hasRole('sector')) 
		{
			$file_name = 'مفتیشین-'.date('Y_m_d_H_i_s').'.xlsx';
			return Excel::download(new AuditorExport, $file_name);
		}
	}
	public function MaktobSavedExcel()
	{
		if (Auth::user()->hasRole('sector')) 
		{
			$file_name = 'مکاتیب حفظیه-'.date('Y_m_d_H_i_s').'.xlsx';
			return Excel::download(new MaktobSavedExcel, $file_name);
		}
	}
	public function MaktobResponseExcel()
	{
		if (Auth::user()->hasRole('sector')) 
		{
			$file_name = 'مکتوب جواب-'.date('Y_m_d_H_i_s').'.xlsx';
			return Excel::download(new MaktobResponseExport, $file_name);
		}
	}
	public function MaktobSalahiatExcel()
	{
		if (Auth::user()->hasRole('sector')) 
		{
			$file_name = 'صلاحیت نامه-'.date('Y_m_d_H_i_s').'.xlsx';
			return Excel::download(new MaktobSalahiatExport, $file_name);
		}
	}
	public function MaktobPlanExcel()
	{
		if (Auth::user()->hasRole('sector')) 
		{
			$file_name = 'مکاتیب پلان-'.date('Y_m_d_H_i_s').'.xlsx';
			return Excel::download(new MaktobPlanExport, $file_name);
		}
	}
	public function ReportAuditorExcel()
	{
		if (Auth::user()->hasRole('sector')) 
		{
			$file_name = 'گزارشات مفتیشین-'.date('Y_m_d_H_i_s').'.xlsx';
			return Excel::download(new ReportAuditorExport, $file_name);
		}
	}
	public function ReportAnalyseExcel()
	{
		if (Auth::user()->hasRole('sector')) 
		{
			$file_name = 'گزارشات ریاست تحلیل'.date('Y_m_d_H_i_s').'.xlsx';
			return Excel::download(new ReportAnalyseExport, $file_name);
		}
	}
	public function ReportSourceExcel()
	{
		if (Auth::user()->hasRole('sector')) 
		{
			$file_name = 'گزارشات مراجع'.date('Y_m_d_H_i_s').'.xlsx';
			return Excel::download(new ReportSourceExport, $file_name);
		}
	}

	// OLD 
   	   public function index()
	    {
	    	if (Auth::user()->hasRole('sector')) 
   		    {
				$maktobs =SectorMaktob::where(['dept'=>Auth::user()->department_id])->count();	 
				$salahiat_nos =SectorSalahiatMaktob::join('sector_maktobs','sector_maktobs.maktob_no', '=', 'sector_salahiat_maktobs.maktob_no')
				->where(['sector_maktobs.dept'=>Auth::user()->department_id])->count();
				$saved_maktobs =SectorSavedMaktob::join('sector_maktobs','sector_maktobs.maktob_no', '=', 'sector_saved_maktobs.maktob_no')
				->where(['sector_maktobs.dept'=>Auth::user()->department_id])->count();
				$response_maktobs =SectorResponseMaktob::join('sector_maktobs','sector_maktobs.maktob_no', '=', 'sector_response_maktobs.maktob_no')
				->where(['sector_maktobs.dept'=>Auth::user()->department_id])->count();
				$plan_maktobs =SectorPlanMaktob::join('sector_maktobs','sector_maktobs.maktob_no', '=', 'sector_plan_maktobs.maktob_no')
				->where(['sector_maktobs.dept'=>Auth::user()->department_id])->count();
				$auditor_reports =SectorAuditorReport::join('sector_maktobs','sector_maktobs.maktob_no', '=', 'sector_auditor_reports.maktob_no')
				->where(['sector_maktobs.dept'=>Auth::user()->department_id])->count();
				$analyse_reports =SectorAnalyseReport::join('sector_maktobs','sector_maktobs.maktob_no', '=', 'sector_analyse_reports.maktob_no')
				->where(['sector_maktobs.dept'=>Auth::user()->department_id])->count();
				$source_reports =SectorSourceReport::join('sector_maktobs','sector_maktobs.maktob_no', '=', 'sector_source_reports.maktob_no')
				->where(['sector_maktobs.dept'=>Auth::user()->department_id])->count();
				$sug = Suggestion::where(['dept'=>Auth::user()->department_id])->count();
				$cliam = Claim::where(['dept'=>Auth::user()->department_id])->count();
				$justice = Justice::where(['dept'=>Auth::user()->department_id])->count();
				$control = Control::where(['dept'=>Auth::user()->department_id])->count();

	    		return view('sectors.index')->with(compact(
					'maktobs','salahiat_nos','saved_maktobs','response_maktobs',
					'plan_maktobs','auditor_reports','analyse_reports','source_reports',
					'sug','cliam','justice','control'
				));
	    	}
	    		
	    }
	    public function about()
	    {
	    	if (Auth::user()->hasRole('sector')) 
   		    {
	    		return view('sectors.about');
	    	}
	    	else if (Auth::user()->hasRole('department')) 
   		    {
	    		return view('department.about');
	    	}	
	    }

	    public function profile(Request $request,$id=null)
	    {
	    	if (Auth::user()->hasRole('sector')) 
   		    {
   		    	if($request->isMethod('post'))
		        {
		            $data = $request->all();
		            if(Hash::check($data['current_pwd'],Auth::user()->password))
		            {
		                if($data['new_pwd']==$data['confirm_pwd'])
		                {
		                    User::where('id',Auth::user()->id)->update(['password'=>bcrypt($data['new_pwd'])]);
		                    Session::flash('success_message','Password has been changed successfuly');
		                    return redirect()->back();
		                }
		                else
		                {
		                    Session::flash('error_message','New password & Confirm password did not match');
		                    return redirect()->back();
		                }
		            }
		            else
		            {
		                Session::flash('error_message','Your current password is incorrect');
		                return redirect()->back();
		            }
		        }
		        return view('sectors.profile');
   		    }
	}
    
}

