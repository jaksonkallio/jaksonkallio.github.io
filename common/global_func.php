<?php
$this_page = array("project_id" => 0, "alias" => "No Alias", "tech_name" => "no_tech_name");
$req_vars = array();

require("db_connect.php");

function secureString($string,$escapehtml=true,$escapeother=true){
	global $con;

	$string=mysqli_real_escape_string($con,$string);
	if($escapehtml==true){
		$string=htmlspecialchars($string);
	}

	return $string;
}

function doQuery($query){
	global $con;

	$result = mysqli_query($con,$query);
	if(!$result){
		die('Error: ' . mysqli_error($con));
	}
	return $result;
}

function currentPageInfo($project_id = 0){
  global $con;
  global $this_page;

  $this_page["project_id"] = $project_id;

  if($project_id !== 0){
    $project_information = mysqli_fetch_array(doQuery('SELECT id,hits,alias,tech_name,btc_donate_addr,description,last_stat_cache FROM project_info WHERE id="'.secureString($project_id).'" LIMIT 1'), MYSQL_BOTH);

    if($project_information['id'] != ""){
      $project_information["hits"]++;

      $this_page["hits"] = $project_information["hits"];
      $this_page["alias"] = $project_information["alias"];
      $this_page["description"] = $project_information["description"];
      $this_page["tech_name"] = $project_information["tech_name"];
      $this_page["btc_donate_addr"] = $project_information["btc_donate_addr"];

      doQuery('UPDATE project_info SET hits="'.secureString($project_information["hits"]).'" WHERE id="'.secureString($project_id).'" LIMIT 1');

      if($project_information["last_stat_cache"] < (time() - 3595)){
        // Ready for new cache
        $get_last_historic = mysqli_fetch_array(doQuery('SELECT hits FROM project_stats_historic WHERE project_id="'.secureString($project_id).'" ORDER BY id DESC LIMIT 1'), MYSQL_BOTH);
        $hit_diff = $project_information["hits"] - $get_last_historic['hits'];

        doQuery('INSERT INTO project_stats_historic (hits,project_id,when_snapshot,delta_hits,when_snapshot_seconds) VALUES ("'.secureString($project_information["hits"]).'","'.secureString($project_id).'",NOW(),"'.secureString($hit_diff).'","'.secureString(time()).'")');
        doQuery('UPDATE project_info SET last_stat_cache="'.secureString(time()).'" WHERE id="'.secureString($project_id).'" LIMIT 1');
      }
    }
  }

  /*echo('
  <script>
  var current_page_info = {"project_id":'.$project_information["id"].',"hits":'.$project_information["hits"].',"alias":"'.$project_information["alias"].'"};

  formatAppInfo();
  </script>
  ');*/
}
function getRequestVars($req_format,$req_var_name,$default=''){
	global $req_vars;
	global $_GET;
	global $_POST;

	if($req_format=='get'){
		if(!(isset($_GET[$req_var_name])&&$_GET[$req_var_name]!=='')){
			$var_content=secureString($default);
		}else{
			$var_content=secureString($_GET[$req_var_name]);
		}
		$req_vars[$req_var_name]=$var_content;
	}else if($req_format=='post'){
		if(!(isset($_POST[$req_var_name])&&$_POST[$req_var_name]!=='')){
			$var_content=secureString($default);
		}else{
			$var_content=secureString($_POST[$req_var_name]);
		}
		$req_vars[$req_var_name]=$var_content;
	}
}
?>
