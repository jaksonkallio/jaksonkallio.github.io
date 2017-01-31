<?
include('common/global_func.php');
?>
<!DOCTYPE html>
<html>
	<head>
		<!--META-->
		<title>Jakson Kallio</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
		<!--STYLE SHEETS-->
		<link href="assets/regular.css" rel="stylesheet" type="text/css" media="screen" />
		<!--SCRIPTS-->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<!--<script src="assets/script.js"></script>-->
	</head>
	<body>
		<div id="page">
			<div id="nametag">Jakson Kallio</div>
			<div id="location-pin">
				<img src="assets/structure/icons/location.svg" />
				<span>Duluth, Minnesota, USA<br><a href="https://twitter.com/jaksonkallio">twitter</a>&bull;<a href="https://github.com/jaksonkallio">github</a>&bull;<a href="https://reddit.com/u/jaksonk">reddit</a></span>
			</div>
			<div id="content">
				<div class="row">
					<div class="row-title">projects</div>
					<div class="taglist inline"><?
						$project_list = doQuery("SELECT id, techname, alias, type, url, hits, locally_hosted, whencreated FROM projects ORDER BY hits DESC LIMIT 100");
						while($project = mysqli_fetch_array($project_list, MYSQLI_ASSOC)){
							$project_link = $project['url'];
							?><a href="<? echo($project_link); ?>" target="_BLANK"><div class="tag"><? echo($project['alias']); ?></div></a><?
						}
					?></div>
				</div>
				<div class="row">
					<div class="row-title">interests</div>
					<div class="taglist inline">
						<div class="tag">arch linux</div><div class="tag">bitcoin</div><div class="tag">c++</div><div class="tag">html5</div><div class="tag">css3</div><div class="tag">python</div>
					</div>
				</div>
				<!--<div class="row">
					<div class="sector">
						<div class="title-list">
							<a href="#">
								<div class="title">Article #1 Title</div>
								<div class="subtitle">2,231 hits</div>
							</a>
							<a href="#">
								<div class="title">Article #2 Title</div>
								<div class="subtitle">183 hits</div>
							</a>
						</div>
					</div>
				</div>-->
			</div>
		</div>
	</body>
</html>
