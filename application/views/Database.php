<script type="text/javascript">
var form = new FormData();
form.append("email", "lisa@onecustom.co.za");
form.append("password", "1On3Custom!");
form.append("user_key", "97bec7bcd47cb353c3b56c5c30d3fe3d");

var settings = {
	"url": "https://pi.pardot.com/api/login?format=json",
	"method": "POST",
	"timeout": 0,
	"processData": false,
	"mimeType": "multipart/form-data",
	"contentType": false,
	"data": form
};

$.ajax(settings).done(function (response) {
	console.log(response);
});



// function fire_webhook(){
//     var feedback = $.ajax({
//         type: "POST",
//         url: "feedback.php",
//         async: false
//     }).success(function(){
//         setTimeout(function(){fire_webhook();}, 10000);
//     }).responseText;
//
//     $('div.feedback-box').html(feedback);
// }
</script>
