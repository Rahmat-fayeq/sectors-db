$(document).ready(function(){
    $(".alert").slideUp(5000);
    $("a.delete").click(function(){
      var sure = window.confirm("آیا مطمئین هستید که حذف شود؟");
      if(!sure){
        event.preventDefault();
      }
    });
});
<!--total salary-->

$("#salary").blur(function(){
  var salary = parseFloat($("#salary").val());
  var overtime = parseFloat($("#overtime").val());
  var total = salary + overtime;
  $("#total").val(total);
});
$("#overtime").blur(function(){
  var salary = parseFloat($("#salary").val());
  var overtime = parseFloat($("#overtime").val());
  var total = salary + overtime;
  $("#total").val(total);
});


<!--total period-->

function hideImage() {
  $("img#pic").hide();
}
function showImage() {
  $("img#pic").show();
}

   