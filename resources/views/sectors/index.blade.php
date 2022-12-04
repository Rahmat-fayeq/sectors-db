@extends('layouts.sector_layouts.sector_layout')
 @section('content')

 <div class="container" style="padding:8px;background-color:white;">
 <div class="row">
 <div class="col-md-12">
 </div>
  <div class="col-md-12">

		<div id="piechart" style="width:90%;  height:400px;"></div>

	</div>
</div>	
</div>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Maktobs'],
          ['وارده و صادره',     {{$maktobs}}],      
          ['مکاتیب حفظیه',    {{$saved_maktobs}}],
		      ['مکاتیب جواب',    {{$response_maktobs}}],
		      ['صلاحیت نامه',    {{$salahiat_nos}}],
		      ['پلان',    {{$plan_maktobs}}],
		      ['گزارشات مفتیشین',    {{$auditor_reports}}],
		      ['گزارشات ریاست تحلیل',    {{$analyse_reports}}],
		      ['گزارشات مراجع',    {{$source_reports}}],
		      ['پیشنهادات',    {{$sug}}],
		      ['اعتراضیه',    {{$cliam}}],
		      ['تعقیب عدلی',    {{$justice}}],
		      ['نظارت',    {{$control}}],
        ]);

        var options = {
           title: "چارت کلی گزارشات",
          //  pieHole: 0.4,
          //  is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <div class="class="container">
 
</div>
</html>



<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}
    x[myIndex-1].style.display = "block";
    setTimeout(carousel, 6000); // Change image every 3 seconds
}
</script>


@endsection

