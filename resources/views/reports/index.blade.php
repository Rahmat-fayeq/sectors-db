@extends('layouts.sector_layouts.sector_layout')
@section('content')
 
<div class="container" style="margin-top:30px">            
	<div class="container" style="padding:10px;">
	<form role="form" method="post" action="{{ route('search') }}" >
		@csrf
		<div class="row">
			<div class="col-md-3">
				<p style="font-size:18px;color:#0078d4;margin-top:30px">گزارش به اساس تاریخ مشخص:</p>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="type" class="control-label"><span style="color:red">*</span>نوعیت سند:</label>
					<select class="form-control"  id="type" name="type">
						<option> </option>
						<option value="saved"> مکاتیب حفظیه</option>
						<option value="response">مکاتیب جواب</option>
						<option value="salahiat">صلاحیت نامه</option>
						<option value="plan">مکاتیب پلان</option>
						<option value="auditors">گزارشات مفتیشین</option>
						<option value="analyse">گزارشات ریاست تحلیل</option>
						<option value="source">گزارشات مراجع</option>
						<option value="suggestion">پیشنهادات</option>
						<option value="cliam">اعتراضیه</option>
						<option value="justice">تعقیب عدلی</option>
						<option value="control">نظارت</option>
					</select>
					@error('type') <p class="text-danger"> {{$message}} </p> @enderror
				</div>
			</div>		
			<div class="col-md-2">
				<div class="form-group">
					<label for="start_date" class="control-label"><span style="color:red;">*</span>تاریخ آغاز:</label>
					<input type="text" id="start_date" name="start_date" data-targetselector="#start_date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" autocomplete="off">
					@error('start_date') <p class="text-danger"> {{$message}} </p> @enderror
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="end_date" class="control-label"><span style="color:red;">*</span>تاریخ ختم:</label>
					<input type="text" id="end_date" name="end_date" data-targetselector="#end_date" class="form-control textFieldWidth" data-mddatetimepicker="true" data-placement="bottom"  placeholder="Y/M/D" autocomplete="off">
					@error('end_date') <p class="text-danger"> {{$message}} </p> @enderror
				</div>
			</div>
		
			<div class="col-md-1" style="margin-top:30px">
				<button type="submit" class="btn btn-success  waves-effect waves-light">دانلود</button>
			</div>
		</form>
		</div> 
	</div>
	<hr style="border:1px solid #0078d4" />
	<div class="container" style=" padding:10px;margin-top: 10px;">
	<form role="form" method="post" action="{{ route('export') }}" >
		@csrf
		<div class="row">
			<div class="col-md-3">
				<p style="font-size:18px;color:#0078d4;margin-top:30px">گزارشات کلی:</p>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="rtype" class="control-label"><span style="color:red">*</span>نوعیت سند:</label>
					<select class="form-control"  id="rtype" name="rtype">
						<option> </option>
						<option value="saved"> مکاتیب حفظیه</option>
						<option value="response">مکاتیب جواب</option>
						<option value="salahiat">صلاحیت نامه</option>
						<option value="plan">مکاتیب پلان</option>
						<option value="auditors">گزارشات مفتیشین</option>
						<option value="analyse">گزارشات ریاست تحلیل</option>
						<option value="source">گزارشات مراجع</option>
						<option value="suggestion">پیشنهادات</option>
						<option value="cliam">اعتراضیه</option>
						<option value="justice">تعقیب عدلی</option>
						<option value="control">نظارت</option>
						<option value="auditor">مفتیشین</option>
					</select>
					@error('rtype') <p class="text-danger"> {{$message}} </p> @enderror
				</div>
			</div>		
		
			<div class="col-md-3" style="margin-top:30px">
				<button type="submit" class="btn btn-success  waves-effect waves-light">دانلود</button>
			</div>
		</form>
		</div> 
	</div>
       
@endsection        
