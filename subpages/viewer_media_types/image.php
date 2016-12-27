<div class="image-preview" style="background-image:url('projects/images/<?php echo($project_info['tech_name']);?>.png');">
</div>
<div class="description">
  <div class="meta">
    <a class="raw-link" href="projects/images/<?php echo($project_info['tech_name']);?>.png">Direct File Link</a>
    <div class="hits"><?php echo($project_info['hits']);?> hits</div>
  </div>
  <?php
  echo(stripslashes($project_info['description']));
  ?>
</div>
<?php
include("common/attribution/standard-light.php");
?>
