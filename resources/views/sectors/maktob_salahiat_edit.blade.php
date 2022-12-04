@extends('layouts.sector_layouts.sector_layout')
@section('content')

@if(Session::has('error_message'))  
<div class="alert alert-danger" rol="alert" style="margin-top: 10px;color:white;">
	{{ Session::get('error_message') }}
<button type="button" class="close" data-dismiss="alert" aria-lable="Close">
	<span aria-hidden="true">&times;</span>
</button>
</div>
@endif
@if(Session::has('success_message'))  
<div class="alert alert-success" rol="alert" style="margin-top: 10px;color:white;">
	{{ Session::get('success_message') }}
<button type="button" class="close" data-dismiss="alert" aria-lable="Close">
	<span aria-hidden="true">&times;</span>
</button>
</div>
@endif
@if($errors->any())
<div class="alert alert-danger" style="color:white">
<ul>
	@foreach ( $errors->all() as $error )
	<li> {{ $error }} </li>
	@endforeach
</ul>
</div>
@endif
 
<div class="container" style="background-color: white;border-radius: 10px;">        
	<h4  style="text-align:center;">ویرایش صلاحیت نامه</h4>
	<hr/>
	<div class="custom-modal-text text-left">
	<form role="form" method="post" enctype="multipart/form-data" action="{{ route('sector.maktob_salahiat_edit', $data['id']) }}" >
	@csrf
	<div class="row">			
		<div class="col-md-6">
			<div class="form-group">
				<label for="maktob_no" class="control-label"><span style="color:red;">*</span>نمبر صلاحیت نامه</label>
				<select class="form-control"  id="maktob_no" name="maktob_no" >
					<option> </option>
					@foreach($maktob_numbers as $no)
						<option value="{{ $no->maktob_no }}" @if($no['maktob_no']==$data['maktob_no']) selected @endif> {{ $no->maktob_no }} </option>
					@endforeach	
				</select>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="hukm_no" class="control-label"><span style="color:red;">*</span>نمبر حکم:</label>
				<input type="text" id="hukm_no" name="hukm_no" class="form-control" value="{{ $data['hukm_no']}}" autocomplete="off"  />
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="hukm_date" class="control-label"><span style="color:red;">*</span>تاریخ حکم:</label>
				<input type="text" id="hukm_date" name="hukm_date" data-targetselector="#hukm_date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{ $data['hukm_date']}}"  autocomplete="off">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="audit_dept" class="control-label"><span style="color:red;">*</span>مرجع تحت تفتیش:</label>
				<input type="text" id="audit_dept" name="audit_dept" class="form-control" value="{{ $data['audit_dept'] }}" autocomplete="off"  />
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="audited_year" class="control-label"><span style="color:red;">*</span>سال بررسی:</label>
				<input type="text" id="audited_year" name="audited_year" class="form-control" value="{{$data['audited_year']}}" autocomplete="off"  />
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="audit_year" class="control-label"><span style="color:red;">*</span>سال تحت تفتیش:</label>
				<input type="text" id="audit_year" name="audit_year" class="form-control" value="{{$data['audit_year']}}" autocomplete="off"  />
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label">ربع تحت تفتیش:</label>
				<br/>
				@foreach($data['quarter'] as $value)
				<input type="checkbox" name="quarter[]" value="{{$value}}" autocomplete="off" checked disabled/> ربع {{$value}} &nbsp;&nbsp;&nbsp;
				@endforeach
				<hr/>
				<p>انتخاب ربع جدید (<span style="color:red;">*</span>):</p>
				<input type="checkbox" name="quarter[]" value="1" autocomplete="off" /> ربع 1 &nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="quarter[]" value="2" autocomplete="off" /> ربع 2 &nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="quarter[]" value="3" autocomplete="off" /> ربع 3 &nbsp;&nbsp;&nbsp;
				<input type="checkbox" name="quarter[]" value="4" autocomplete="off" /> ربع 4
			</div>
		</div>
		<div class="col-md-6" style="border:1px solid silver;border-radius:10px;">
			<label class="control-label"><span style="color:red;">*</span>اعضای هیئت:</label>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<input type="text" class="form-control" name="head_auditor" placeholder="آمرگروپ" value="{{$data['head_auditor']}}" />
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<input type="text" class="form-control" name="auditor1" placeholder="عضو1" value="{{$data['auditor1']}}" />
						</div>
					</div>
					<div class="col-md-3"
						<div class="form-group">
							<input type="text" class="form-control" name="auditor2" placeholder="عضو2" value="{{$data['auditor2']}}" />
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<input type="text" class="form-control" name="auditor3" placeholder="عضو3" value="{{$data['auditor3']}}" />
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<input type="text" class="form-control" name="auditor4" placeholder="عضو4" value="{{$data['auditor4']}}" />
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<input type="text" class="form-control" name="auditor5" placeholder="عضو5" value="{{$data['auditor5']}}" />
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<input type="text" class="form-control" name="auditor6" placeholder="عضو6" value="{{ $data['auditor6'] }}" />
						</div>
					</div>
				</div>
			</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="start_date" class="control-label"><span style="color:red;">*</span>تاریخ آغاز کار:</label>
				<input type="text" id="start_date" name="start_date" data-targetselector="#start_date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{$data['start_date']}}"  autocomplete="off">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="end_date" class="control-label"><span style="color:red;">*</span>تاریخ ختم کار:</label>
				<input type="text" id="end_date" name="end_date" data-targetselector="#end_date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" value="{{$data['end_date']}}"  autocomplete="off">
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="doc_no" class="control-label">نمبر کارتن:</label>
				<input type="text" id="doc_no" name="doc_no" class="form-control" value="{{ $data['doc_no'] }}" autocomplete="off"  />
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="shelf_no" class="control-label">نمبر الماری:</label>
				<input type="text" id="shelf_no" name="shelf_no" class="form-control" value="{{ $data['shelf_no'] }}" autocomplete="off"  />
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="shelf_row" class="control-label">ردیف الماری:</label>
				<input type="text" id="shelf_row" name="shelf_row" class="form-control" value="{{ $data['shelf_row'] }}" autocomplete="off"  />
			</div>
		</div>	
		<div class="col-md-6">
			<div class="form-group">
				<label for="year" class="control-label">سال:</label>
				<input type="number" id="year" name="year" class="form-control" value="{{ $data['year'] }}" autocomplete="off"  />
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="remarks" class="control-label">ملاحظات:</label>
				<textarea id="remarks" name="remarks" class="form-control">{{ $data['remarks'] }}</textarea>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="file" class="control-label">فایل:</label>
				<input type="file" class="form-control" name="file" id="file" />
			</div>
			@if(!empty($data['file']))
				<p>فایل قبلی موجوداست</p>
				<input type="hidden" value="{{ $data['file'] }}" name="prevFile" />
			@endif
		</div>				
	</div>
	<div class="modal-footer">
		<button type="submit" id="submit"  class="btn btn-warning  waves-effect waves-light">ویرایش معلومات</button>
	</div>
	</form>
	</div>
</div> 
       
@endsection        
