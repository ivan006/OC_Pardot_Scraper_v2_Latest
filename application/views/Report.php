




<!-- <a class="btn btn-primary" href="#" role="button">Get session key</a> -->
<textarea name="name" rows="8" cols="80" id="crawl_needles"></textarea>
<a class="btn btn-primary" href="#" role="button" id="crawl_run">Start crawling</a>



<script type="text/javascript">

// var state = [];

// var settings = {
//   "url": "/api_c/session_key",
//   "method": "GET",
//   "timeout": 0,
//   "headers": {
//   },
// };
//
// $.ajax(settings).done(function (response) {
//   state.session_key = response.api_key;
//   console.log(state);
// });

// fire_webhook


function initiate_crawl(){
 $.ajax({
  url: '/api_c/session_key',
  type: 'GET',
  success: function(data){
   // setTimeout(continue_crawl,5000);
  },
  complete:function(data){
    alert(data);
  }
 });
}

function continue_crawl(){
 $.ajax({
  url: '/api_c/visits_query',
  type: 'GET',
  success: function(data){
   // Perform operation on return value
   alert(data);
  },
  complete:function(data){
   setTimeout(continue_crawl,5000);
  }
 });
}

// $(document).ready(function(){
//  setTimeout(fetchdata,5000);
// });



$( "#crawl_run" ).click(function() {
  initiate_crawl();
});
</script>
