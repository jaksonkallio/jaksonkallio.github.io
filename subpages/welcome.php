<?php
include("../common/global_func.php");
?>
<div id="welcome-slide" class="no-select">
	<div class="bracket-box-contain" id="main-site-title">
		<div class="bracket-box">
	    <div class="title">
	      JAKSON KALLIO
	    </div>
			<div class="description">
				Student at U of M Duluth, freelance developer, cryptocurrency enthusiast, vector artist. My dream is to someday work for an innovative technology company.
			</div>
			<div class="nav">
				<a href="?s=resume" target="_BLANK">Resume/Portfolio</a>
				<a href="http://twitter.com/JaksonKallio" target="_BLANK">Twitter</a>
				<a href="https://github.com/JaksonKallio" target="_BLANK">GitHub</a>
			</div>
		</div>
	</div>
	<div id="welcome-content-shortcuts">
		<div class="projects">
			<div class="item-grid" data-fixedmode>
				<?php
				$result_getApps = doQuery('SELECT id,alias,tech_name,hits,icon,description,tags,thumbnail,media_type FROM project_info WHERE completion_status>"3" AND media_type="code" ORDER BY when_created DESC LIMIT 20');

				$constr['preview'] = "";

				while($row_getApps = mysqli_fetch_array($result_getApps, MYSQL_BOTH)){
					if($row_getApps["thumbnail"] == 0){
						if($row_getApps["media_type"] == 'image'){
							$constr['preview'] = "projects/images/".$row_getApps["tech_name"].".png";
						}
					}else{
						$constr['preview'] = "assets/structure/project-thumbnails/".$row_getApps["tech_name"].".png";
					}

					echo('
					<a class="goto-app" href="view.php?p='.$row_getApps['id'].'" target="_BLANK">
						<div class="item">
							<div class="thumbnail" style="background-image:url(\''.$constr['preview'].'\');">
								<div class="fader"></div>
								<div class="mini-title">'.$row_getApps['alias'].'</div>
							</div>
							<!--<div class="meta-box">
								<div class="close-box">close</div>
								<div class="title">'.$row_getApps['alias'].'</div>
								<div class="tags">'.$row_getApps['tags'].'</div>
								<div class="description">
									'.stripslashes($row_getApps['description']).'
								</div>
								<a class="goto-app" href="view.php?p='.$row_getApps['id'].'" target="_BLANK">View Project</a>
							</div>-->
						</div>
					</a>
					');
				}
				?>
			</div>
			<div class="smallnote">
				This list is not nearly exhaustive of all the projects I've worked on. Many are either incomplete or unlisted upon client request.
			</div>
		</div>
  </div>
  <!--<div class="nav">
    <a data-goto-subpage="about"><span>Information</span></a>
    <a data-goto-subpage="projects"><span>Projects</span></a>
  </div>-->
</div>
