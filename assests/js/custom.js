jQuery(document).ready(function($) {
    $('#tblUser').DataTable();
    $("#form-body").hide();

    $("#insert-btn").on('click',function(){
        $("#form-body").toggle(500);
    });

    $("#submit").on('click',function(e){
        e.preventDefault();
        var type = $('#type').val();
        var book = $('#b_type').val();
        var url = $('#url').val();

		$(document).ajaxComplete(function(){
  		 alert('Data Inserted Successfully');
		location.reload(true);
	});
		
        var origin   = wnm_custom.base_url;

        var settings = {
            "url": origin+"/wp-json/area/v1/area",
            "method": "POST",
            "timeout": 0,
            "headers": {
              "Content-Type": "application/json"
            },
            "data": JSON.stringify({
              "type": type,
              "url": url,
              "book": book
            }),
          }; 
          
          $.ajax(settings).done(function (response) {
//             alert('Data Inserted Successfully');
// 			location.reload(true);
            console.log(response);
          });
    });

    $('#upload-btn').click(function(e) {
      e.preventDefault();
      var image = wp.media({ 
          title: 'Upload Image',
          multiple: false
      }).open()
      .on('select', function(e){
          var uploaded_image = image.state().get('selection').first();
          var image_url = uploaded_image.toJSON().url;
          $('#url').val(image_url);
          $('#uurl').val(image_url);
      });
  });


  $('#upload-btn1').click(function(e) {
    e.preventDefault();
    var image = wp.media({ 
        title: 'Upload Image',
        multiple: false
    }).open()
    .on('select', function(e){
        var uploaded_image = image.state().get('selection').first();
        var image_url = uploaded_image.toJSON().url;
        $('#uurl').val(image_url);
    });
});

  // edit

  $(".sedit").on('click',function(e){
    e.preventDefault();
    $("#myModal").modal("show");
    var currentRow=$(this).closest("tr");
    var col1=currentRow.find("td:eq(1)").html();
    var col2=currentRow.find("td:eq(2)").html();
    // alert(col2);
    var h1=$('input[type=hidden]',currentRow.find("td:eq(0)")).val();
    var h=$('input[type=hidden]',currentRow.find("td:eq(3)")).val();

    $('#id').val(h1);
    $('#utype').val(col1);
    $('#uurl').val(h);
    $('#btype').val(col2);

  });

  $(".close").on('click',function(e){
    $("#myModal").modal("hide");
  });

  // update

  $(".supdate").on('click',function(e){

    e.preventDefault();
    // alert('hi');
    var id = $('#id').val();
    var type = $('#utype').val();
    var uurl = $('#uurl').val();
    var btype = $('#btype').val();

    var origin   = wnm_custom.base_url;

	  $(document).ajaxComplete(function(){
  		 alert('Data Updated Successfully');
			location.reload(true);
	});

    var settings = {
      "url": origin+"/wp-json/area/v1/update_data",
      "method": "POST",
      "timeout": 0,
      "headers": {
        "Content-Type": "application/json"
      },
      "data": JSON.stringify({
        "id": id,
        "type": type,
        "url": uurl,
        "book": btype
      }),
    };
    
    $.ajax(settings).done(function (response) {
//       alert('Data Updated Successfully');
// 	  location.reload(true);
    }); 
  });

  // delete

  $(".delete").on('click',function(e){

    e.preventDefault();

	  $(document).ajaxComplete(function(){
  		 alert('Data Deleted Successfully');			
		 location.reload(true);
	});
    var id= this.id;
    // alert(id);

    var origin   = wnm_custom.base_url;

    var settings = {
      "url": origin+"/wp-json/area/v1/delete_data",
      "method": "POST",
      "timeout": 0,
      "headers": {
        "Content-Type": "application/json"
      },
      "data": JSON.stringify({
        "id": id
      }),
    };
    
    $.ajax(settings).done(function (response) {
//       alert('Data Deleted Successfully');
// 			  location.reload(true);
    });

  });
  // 
  


  // 

});