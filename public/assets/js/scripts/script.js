$(document).ready(function(){

	// update Attribute status
	$(".updateAttributeStatus").click(function(){
		var status = $(this).text();
		var attribute_id = $(this).attr("attribute_id");
		$.ajax({
			type:'post',
			url:'/admin/update-attribute-status',
			data:{status:status,attribute_id:attribute_id},
			success:function(resp){
				if(resp['status']==0)
				{
					$("#attribute-"+resp['attribute_id']).html(" Inactive");
				}
				else
				{
					$("#attribute-"+resp['attribute_id']).html("Active");
				}

			}, error:function(){
				alert("Error");
			}
		});
	});	


});