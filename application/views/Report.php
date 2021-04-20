




<!-- <a class="btn btn-primary" href="#" role="button">Get session key</a> -->
<textarea name="name" rows="8" cols="80" id="crawl_needles"></textarea>
<br>
<a class="btn btn-primary" href="#" role="button" id="crawl_run">Start crawling</a>



<script type="text/javascript">

var state = [];

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
  dataType: "text",
  success: function(data){
    state["page"]=1;
    setTimeout(continue_crawl,5000);
    // alert("suc");
    state["crawl_needles"] = $('#crawl_needles').val();
  },
  complete:function(data){
    // alert("com");
  }
 });
}

function continue_crawl(){
 $.ajax({
  url: '/api_c/visits_query?crawl_needles='+state["crawl_needles"]+'&page='+state["page"],
  type: 'GET',
  dataType: "text",
  success: function(data){
   // Perform operation on return value
   // alert("suc");
  },
  complete:function(data){
    // alert("com");
    // alert(data);
    // alert(JSON.stringify(data, null, 2));
    data = $.parseJSON(data.responseText);
    if (data.result.visit === undefined) {

    } else {
      state["page"] = state["page"]+1;
      setTimeout(continue_crawl,5000);

    }
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
