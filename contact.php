<?php
$menu_id = "about";
$page_title = "Contact Us";
include_once('header_page.php');
?>
<style>
#map_canvas{
	width: 600px;
	height: 450px;
}
input#subscribe{
	margin-left: 20px;
    font-family: "Calibri", "Lucida Console", "MS Sans Serif";
    color: #F9F9F9;
	width: 70px;
	font-size: 12px;
	height: 25px;
	border-radius: 5px;
	border: 1px solid #CCCCCC;
	background: #293342 no-repeat scroll 0 0;
	text-align: center;
	font-weight: bold;
	cursor: pointer;
}

input#subscribe:hover{
	background: #FF7D4C no-repeat scroll 0 0;
}
</style>
<script>
  	var sky1 = new google.maps.LatLng(10.3314111,123.907332);
	var sky4 = new google.maps.LatLng(10.3292714,123.9063102);
	var marker;
	var map;
	
	function initialize() {
	  var mapOptions = {
	    zoom: 16,
	    center: sky1
	  };
	
	  map = new google.maps.Map(document.getElementById('map_canvas'),
	          mapOptions);
	
	  marker = new google.maps.Marker({
	    map:map,
	    draggable:true,
	    animation: google.maps.Animation.DROP,
	    position: sky1,
	    title: "Skyrise 1 - Main Center"
	  });
	  
	  marker2 = new google.maps.Marker({
	    map:map,
	    draggable:true,
	    animation: google.maps.Animation.DROP,
	    position: sky4,
	    title: "Skyrise 4 - Sunday Service Sanctuary"
	  });
	  google.maps.event.addListener(marker, 'click', toggleBounce);
	   google.maps.event.addListener(marker2, 'click', toggleBounce);
	}
	
	function toggleBounce() {
	
	  if (marker.getAnimation() != null) {
	    marker.setAnimation(null);
	  } else {
	    marker.setAnimation(google.maps.Animation.BOUNCE);
	  }
	}
	
	google.maps.event.addDomListener(window, 'load', initialize);
</script>

<div style="background: url('images/page_banner/BannerContact.png') no-repeat; background-size: 100%; height: 200px; opacity: 1"></div>
<div class="page_wrapper">
	<div class="welcome">
		<h3 style="padding-left: 10px; color: #293342; font-size: 2em;">Living Word I.T. Park</h3>
		<p>Ground Floor Skyrise 1 Building (main center) <br /> 6th Floor Skyrise 4 Building (sunday service sanctuary) <br />AsiaTown IT Park, Lahug, Cebu City <br /> 6000 Philippines</p>
		<p>Office: (032) 415 – 6148 <br />
		E-mail: livingworditpark@gmail.com</p>
		<a href="mailto:livingworditpark@gmail.com" style="color: #293342;"><input id="subscribe" type="button" value="Connect" /></a>
	</div>
	<div id="map_canvas"></div>
</div>
<?php
include_once('footer_page.php');
?>