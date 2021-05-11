
<!-- <a class="btn btn-primary" href="#" role="button">Get session key</a> -->
<textarea name="name" rows="8" cols="80" id="crawl_needles"><?php echo json_encode($data["crawl_needles"]) ?></textarea>
<br>
<a class="btn btn-primary" href="#" role="button" id="crawl_run">Start crawling</a>



<script type="text/javascript">

<?php
$js_code = "[]";
if (isset($data["crawl_needles"])) {
  if (!empty($data["crawl_needles"])) {

    $js_code = $data["crawl_needles"];
  }
}
?>
var state = [];

state["chapter"] = 0;
state["page"]= 1;
state["crawl_needles"] = [];

<?php
// foreach ($data["crawl_needles"] as $key => $value) {
//   echo "state['crawl_needles'][$key] = ".json_encode($value, JSON_PRETTY_PRINT).";";
//
// }

// code...


?>



// function chunk (arr, len) {
//
//   var chunks = [],
//       i = 0,
//       n = arr.length;
//
//   while (i < n) {
//     chunks.push(arr.slice(i, i += len));
//   }
//
//   return chunks;
// }


function initiate_crawl(){
  var input_val = $('#crawl_needles').val()
  var input_parsed = $.parseJSON(input_val);

  // state["crawl_needles"] = chunk(input_parsed, 200);
  state["crawl_needles"] = input_parsed;
  // alert()
  // alert(JSON.stringify(state["crawl_needles"]));
  // alert(state["crawl_needles"].length);
  get_session_key();
}

function get_session_key(){
 $.ajax({
  url: '/api_c/session_key',
  type: 'GET',
  success: function(data){
    // state["page"] = state["page"]-1;


    console.log("get_session_key");
    continue_crawl()

    // setTimeout(continue_crawl,5000);
    // alert("suc");
  },
  complete:function(data){
    // alert("com");
  }
 });
}


function continue_crawl(){
  // alert(state["crawl_needles"][state["chapter"]]);
  $.ajax({
    url: '/api_c/visits_query'+'?page='+state["page"]+'&crawl_needles='+state["crawl_needles"][state["chapter"]],
    type: 'GET',
    async: false, // <- this turns it into synchronous
    success: function(data){
      // Perform operation on return value
      // alert("suc");
    },
    complete:function(data){
      // alert("com");
      // alert(data);
      // alert(JSON.stringify(data, null, 2));

      state["page"] = state["page"]+1;

      data = $.parseJSON(data.responseText);
      if (data.err !== undefined) {

        initiate_crawl();

      } else {
        if (data.result.visit === undefined) {
          // console.log("next one");
          // alert(state["crawl_needles"][state["chapter"]]);
          // alert(state["crawl_needles"][0]);
          state["chapter"] = state["chapter"]+1;

          state["page"] = 1;

        }
        // alert(state["chapter"]);
        if (state["crawl_needles"][state["chapter"]] !== undefined) {
          continue_crawl()
          // setTimeout(continue_crawl,5000);
        } else {

          console.log("finished");


        }
      }

    }
  });

}




$( "#crawl_run" ).click(function() {
  initiate_crawl();
});
// $(document).ready(function(){
//
// });
</script>



<?php
if (1==2) {
  // code...
  foreach ($data["crawl_needles"] as $key => $value) {
    ?>
    <h1><?php echo $key ?></h1>
    <textarea name="name" rows="8" cols="80" id=""><?php echo implode(",",$value) ?></textarea>
    <?php
  }
}
?>
