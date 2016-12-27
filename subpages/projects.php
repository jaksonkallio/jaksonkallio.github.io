<?php
include("../common/global_func.php");
?>
<div class="item-grid" data-fixedmode>
  <?php
  $result_getApps = doQuery('SELECT id,alias,tech_name,hits,icon,description,tags,thumbnail,media_type FROM project_info WHERE completion_status>"3" ORDER BY when_created DESC LIMIT 20');

  $constr['preview'] = "";

  while($row_getApps = mysqli_fetch_array($result_getApps, MYSQL_BOTH)){
    if($row_getApps["thumbnail"] == 0){
      if($row_getApps["media_type"] == 'image'){
        $constr['preview'] = "projects/images/".$row_getApps["tech_name"].".png";
      }
    }else{
      $constr['preview'] = "assets/structure/project-thumbnails/".$row_getApps["tech_name"].".png";
    }

    /*echo('
    <div class="item">
      <div class="thumbnail" style="background-image:url(\''.$constr['preview'].'\');"></div>
      <div class="mini-title">'.$row_getApps['alias'].'</div>
      <div class="meta-box">
        <div class="close-box">close</div>
        <div class="title">'.$row_getApps['alias'].'</div>
        <div class="tags">'.$row_getApps['tags'].'</div>
        <div class="description">
          '.stripslashes($row_getApps['description']).'
        </div>
        <a class="goto-app" href="view.php?p='.$row_getApps['id'].'" target="_BLANK">View Project</a>
      </div>
    </div>
    ');*/
  }
  ?>
</div>
<div class="smallnote">
  This website is brand new! The project list will be sparse while I build my coding portfolio.
</div>
