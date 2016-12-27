<?php
include("../common/global_func.php");
?>
<div class="page item-grid" data-width="minimal"  id="apps">
  <?php
  $result_getApps = doQuery('SELECT id,alias,tech_name,hits,icon,description,tags FROM project_info WHERE app="1" AND completion_status>"3" ORDER BY hits DESC LIMIT 9');

  while($row_getApps = mysqli_fetch_array($result_getApps, MYSQL_BOTH)){
    if($row_getApps["icon"] == 0){
      $constr['icon'] = "assets/structure/icons/blocks.svg";
    }else{
      $constr['icon'] = "assets/structure/project-icons/".$row_getApps["tech_name"].".svg";
    }

    echo('
    <div class="item">
      <img class="icon" src="'.$constr['icon'].'" />
      <div class="mini-title">'.$row_getApps['alias'].'</div>
      <div class="meta-box">
        <div class="close-box">close</div>
        <div class="big-icon">
          <img src="'.$constr['icon'].'" />
        </div>
        <div class="title">'.$row_getApps['alias'].'</div>
        <div class="tags">'.$row_getApps['tags'].'</div>
        <div class="description">
          '.stripslashes($row_getApps['description']).'
        </div>
        <a class="goto-app" href="apps/'.$row_getApps["tech_name"].'/index.php" target="_BLANK">Open App</a>
      </div>
    </div>
    ');
  }
  ?>
  <!--<div class="app">
    <img class="icon" src="assets/structure/project-icons/block-predictor.svg" />
    <div class="mini-title">Block Predictor</div>
    <div class="meta-box">
      <div class="big-icon">
        <img src="assets/structure/project-icons/block-predictor.svg" />
      </div>
      <div class="title">Block Predictor</div>
      <div class="tags">bitcoin, web design</div>
      <div class="description">
        Bitcoin blocks are meant to be found, on average, every ten minutes. The hashpower of the network (and other variables) are constantly changing, meaning that this is often not the case. This app will attempt to predict when the next block will be found based on previous block times, as well as provide some other useful information.
      </div>
      <a class="goto-app" href="apps/block-predictor/index.php" target="_BLANK">Open App</a>
    </div>
  </div>-->
</div>
