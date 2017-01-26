<?
include('passwords.php');
include('constants.php');
include('dbconnect.php');

$req_vars = array();

function secureString($string, $escapehtml=true, $escapeother=true){
	global $con;

	$string=mysqli_real_escape_string($con,$string);
	if($escapehtml==true){
		$string=htmlspecialchars($string);
	}

	return $string;
}

function getRequestVars($req_format, $req_var_name,$default=''){
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

function doQuery($query, $and_fetch_array = false){
	global $con;

	$result = mysqli_query($con,$query);
	if(!$result){
		die('Error: ' . mysqli_error($con));
	}
	if($and_fetch_array){
		return mysqli_fetch_array($result,MYSQL_BOTH);
	}else{
		return $result;
	}
}

function niceTime($timestamp, $include_time_of_day){
  $months = array("Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec");
  $parse_time = date_parse($timestamp);
  $constr = "";

  $constr .= $months[$parse_time['month'] - 1]." ".$parse_time['day'].", ".$parse_time['year'];

  if($include_time_of_day === true){
		$hr12 = "am";
		if($parse_time['hour'] > 12){
			$parse_time['hour'] = $parse_time['hour'] - 12;
			$hr12 = "pm";
		}

		$constr .= " ".$parse_time['hour'].":".$parse_time['minute']." ".$hr12;
	}

	return $constr;
}
?>
