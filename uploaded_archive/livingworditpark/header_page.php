<?php
session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta name="author" content="twinkle_star" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="keyword" content="Christianity, Worship, Discipleship, Service, Gospel, Christ, Salvation, God, Ministry, Mission, Outreach, Bible" />
	<meta name="description" content="&quot;Livingword IT Park&quot; is a member of LWCCCI or Livingword Christian Churches of Cebu-International and is under the umbrella of CCM (Christian Community Ministries) " />
	<meta name="viewport" content="width=device-width" />
	<meta charset="UTF-8" />
	<title>
		<?php
			error_reporting(E_ERROR | E_PARSE);
			if(isset($page_title))
				echo 'LIT - ' .$page_title;
			else
				echo 'LIT - HOME';
		?>
	</title>
	<link rel="shortcut icon" href="images/lit_icon.ico">
	
	<!--embedded CSS Styles-->
	<link type="text/css" rel="stylesheet" href="css/header_style.css" />
	
		<!--***index***-->
	<link rel="stylesheet" type="text/css" href="css/main_style.css" />
	<link rel="stylesheet" type="text/css" href="css/index_slider_style.css" />
	<link rel="stylesheet" type="text/css" href="css/index_content_style.css"/>
	<link rel="stylesheet" type="text/css" href="css/calendar_style.css"/>
	<link rel="stylesheet" type="text/css" href="css/footer_style.css"/>
		<!--***signup***-->
	<link rel="stylesheet" type="text/css" href="css/signup_style.css" />
	<link rel="stylesheet" type="text/css" href="css/datepicker_ui.css" />
		<!--***article***-->
	<link rel="stylesheet" type="text/css" href="css/article_style.css" />
		<!--***history***-->
	<link rel="stylesheet" type="text/css" href="css/timeline_style.css" media="screen" />
		<!--***about***-->
	<link rel="stylesheet" type="text/css" href="css/about_style.css" />
	<style>
		#map_canvas {
	       width: 500px;
	       height: 400px;
	       background-color: #CCC;
     	}
	</style>
		<!--***schedule***-->
	<link rel="stylesheet" type="text/css" href="css/events_style.css" />
	<link rel="stylesheet" href="css/eventCalendar.css">
	<link rel="stylesheet" href="css/eventCalendar_theme_responsive.css">
		<!--***ministry***-->
	<link rel="stylesheet" type="text/css" href="css/ministry_style.css" />
	
	<!--embedded Javascript-->
	<!--<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js?ver=1.4.2'></script>-->
	<script type='text/javascript' src='https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
	<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false"></script>
	
		<!--***index***-->
	<script type="text/javascript" src="script/jquery-1.2.6.pack.js"></script>
	
		<!--***history***-->
	<!--<script type="text/javascript" src="script/1.7.2.jquery.min.js"></script>-->
	<script type="text/javascript" src="script/jquery.timelinr-0.9.54.js" media="screen"></script>
	
		<!--***schedule***-->
	<script type="text/javascript" src="script/jquery.eventCalendar.js"></script>
	
	<?php
	include_once('util/db_inc.php');
	include_once('header_menu.php');
	?>
</head>
<body>
	<?php
	include_once('util/page_util_inc.php');
	include_once('util/messagebox_inc.php');
	include_once('util/common_logger.php');
	?>