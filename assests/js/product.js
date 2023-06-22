jQuery(document).ready(function($) {
    $('select.change').on('change', function() {
    var subject=$(this).closest('.change').find('option:selected').text();
    // var selectValue = $(this).find("select.change").val();
    alert( subject );
    // var origin = <?php echo BASE_URL ?>
    // alert(origin);
    var settings = {
     "url": "http://localhost/blue/wp-json/area/v1/media_url",
    "method": "POST",
    "timeout": 0,
    "headers": {
     "Content-Type": "application/json"
},
"data": JSON.stringify({
"id": subject
}),
};

$.ajax(settings).done(function (response) {
var r = response;
// console.log(r);
var url = r.data[0]['url']
// console.log(url);
$('.url').val(url);
});
    });
    });