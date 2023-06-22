jQuery(document).ready(function($) {
	$("#field_XA94").parent().hide();
	
  $("input:radio[name='radio']").on('click',function(e){


      // $('.details').css('background-color', 'white');
      $('.details').removeClass("ripple-btn-primary");
      $(this).closest('.details').addClass("ripple-btn-primary");
      

      // $(this).closest('.details').css('background-color', 'black');

      $(this).closest('.details').find('a').trigger('click');

      
    });

    $("#field_FV97").on('click',function(e){
  	e.preventDefault();
		var subject=$('select[name=field_FV97] option').filter(':selected').text();
		if (subject === 'Subject Matter')
		{
			$("#field_XA94").parent().show();
		}
		else
			{
				$("#field_XA94").parent().hide();
			}
		
		});
       
	$('#field_XA94').keypress(function(e) {
    var tval = $('#field_XA94').val(),
        tlength = tval.length,
        set = 250,
        remain = parseInt(set - tlength);
    $('#field_XA94').text(remain);
    if (remain <= 0 && e.which !== 0 && e.charCode !== 0) {
        $('#field_XA94').val((tval).substring(0, tlength - 1));
        return false;
    }
})
       
// $("a.alt.wc-forward.wp-element-button").on('click',function(e){
//   e.preventDefault();

//   if ($("#eh_crm_ticket_form")[0].checkValidity())
//   {

//     if( $("input:radio[name='radio']").is(":checked"))
//     {
//     var origin=window.location.href;
//     // var origin   = window.location.origin;

//     // alert(origin);
  
//   var email=$('#request_email').val();
// //   var subject=$('#request_title').val();
		

		
//   var subject=$('select[name=field_FV97] option').filter(':selected').text();
	
		
//   var des=$('#request_description').val();
//   var fname=$('#field_WF76').val();
//   var lname=$('#field_KR99').val();
//   var phone=$('#field_CW54').val();
//   var ticket=$('#ticket_id').val();
// 		alert(ticket);
// 		alert(phone);
	
	  
//   url=origin+'checkout?email='+email+'&fname='+fname+'&lname='+lname+'&phone='+phone+'&subject='+subject+'&des='+des+'&id='+ticket;
//   window.location.href = url;
//   }
//   else
//   {
//     alert('Please Select Services');
//   }
// }
//   else
//   {
//   //Validate Form
//   $("#eh_crm_ticket_form")[0].reportValidity();
//   e.preventDefault();
//   }

// });


   });
