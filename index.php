<?php
include('common/global_func.php');
getRequestVars('get','s',false);
$req_vars['s'] = secureString($req_vars['s']);
$avail_subpages = array('welcome','projects','blog');
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
    <script src="assets/script.js"></script>
    <script>
    var $_GET = getPageParameters();
    </script>
  </head>
  <body>
    <div id="page">
      <!--<div class="dark-shadow"></div>
      <div class="dot-overlay"></div>-->
      <!--<div class="back-to-home" data-goto-subpage="welcome">
        <img src="assets/back-arrow.svg"/>
        <span>BACK</span>
      </div>-->
      <div id="subpage-contain">
      </div>
    </div>
  </body>
</html>
