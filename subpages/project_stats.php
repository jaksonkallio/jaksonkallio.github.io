<?php
include("../common/global_func.php");

getRequestVars('get','project',4);

$get_project = mysqli_fetch_array(doQuery('SELECT hits FROM project_info WHERE id="'.secureString($req_vars['project']).'" LIMIT 1'), MYSQL_BOTH);
?>
<script src="assets/plugins/canvasjs.min.js"></script>
<div class="page" data-width="full">
  <div class="page-header">project statistics</div>
  <div id="project-hits-chart">
  </div>
  <div class="current-hits">
    <?php echo(number_format($get_project['hits'])); ?> hits
  </div>
</div>
<script>
var historic_data = [
  <?php
  $first = true;
  $counter = 1;
  $result_getProjectHistory = doQuery('SELECT id,hits,when_snapshot,delta_hits,when_snapshot_seconds FROM project_stats_historic WHERE project_id="'.secureString($req_vars['project']).'" ORDER BY id DESC LIMIT 48');
  while($row_getProjectHistory = mysqli_fetch_array($result_getProjectHistory, MYSQL_BOTH)){
    if(!$first){
      echo(',');
    }else{
      $first = false;
    }
    echo('{x:"'.$counter.'",y:'.$row_getProjectHistory['delta_hits'].'}');
    $counter++;
  }
  ?>
];

function drawChart(){
  var chart = new CanvasJS.Chart("project-hits-chart",{
    data: [
      {
        type: "spline",
        dataPoints: historic_data,
        color: "#4474A1"
      }
    ],
    backgroundColor: "transparent"
  });

  chart.render();
}
$(document).ready(function(){
  drawChart();
});
</script>
