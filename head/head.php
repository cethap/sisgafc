<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sisgafc</title>
<link rel="stylesheet" href="assets/stylesheets/html.css" />
<link rel="stylesheet" href="assets/stylesheets/desktop.css" />
<link rel="stylesheet" type="text/css" href="assets/stylesheets/main.css" />
<link rel="stylesheet" type="text/css" href="assets/stylesheets/superfish.css" />
<link rel="stylesheet" type="text/css" href="assets/stylesheets/superfish-vertical.css" />
<?php 
include_once('lib/YepSua/Labs/RIA/jQuery4PHP/YsJQueryAutoloader.php');
YsJQueryAutoloader::register();
echo YsConfigAssets::includeAssets('jquery-ui');
echo YsConfigAssets::includeAssets('jqgrid');
echo YsConfigAssets::includeAssets('blockUI');
//echo YsConfigAssets::includeAssets('jqForm');

//
//// all js and styles for jQuery4PHP ?>


<script src="assets/javascripts/jquery.desktop.js"></script>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript" src="assets/javascripts/jquery.fn.gmap.js"></script>
<script type="text/javascript" src="assets/javascripts/jquery.ui.map.services.js"></script>
<script type="text/javascript" src="assets/javascripts/hoverIntent.js"></script>
<script type="text/javascript" src="assets/javascripts/superfish.js"></script>

</head>
<body>
    <script>
        $(document).ready(function() {
			jQuery('ul.sf-menu').superfish({animation: {height:'show'}, delay: 1200 });
                        $("#lime:eq(0)").remove();
		});
                
                
    </script>
    