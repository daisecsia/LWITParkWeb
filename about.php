<?php
$menu_id = "about";
$page_title = "About Us";
include_once('header_page.php');
?>
<script type="text/javascript">
$(document).ready(function(){
  $("#core1").mouseover(function(){
    $("#core1_desc").show();
  });
  $("#core1").mouseout(function(){
    $("#core1_desc").hide();
  });
  $("#core2").mouseover(function(){
    $("#core2_desc").show();
  });
  
  $("#core3").mouseover(function(){
    $("#core3_desc").show();
  });
  
  $("#core4").mouseover(function(){
    $("#core4_desc").show();
  });
  
  $("#core5").mouseover(function(){
    $("#core5_desc").show();
  });
});
</script>
<div style="background: url('images/page_banner/about_banner.png') no-repeat; background-size: 100%; height: 200px; opacity: 1"></div>
<div class="page_wrapper">
	<div id="about">
		<div class="welcome vmg">
			<div class="vmg_content">
				<div style="padding-top: 10px;">
					<img src="images/_mission.png" />
					<img src="images/about_lwit/mission_statement.jpeg" align="center"  width="250px" height="400px" />
					<!-- <p>LWCCCII seeks to bring GLORY to God, by enhancing the individual and corporate spiritual lives (passion and devotion in the disciplines of worship, prayer, study, meditation and application of God's word) of its people through the faithful preaching and teaching of God's word. It seeks to uphold the supremacy of Christ in the individual and corporate life of the church, thereby bringing about spiritual maturity and holiness for both. It likewise seeks to build the local church through discipleship to bring about ministry to the church based on loving relationships, having understood the concept of being part of Christ's body and God's household. As part of its commitment to discipleship, it seeks to safeguard the church from false doctrines, churches and teachers. Lastly, it seeks to fulfill the Great Commission in the establishment of churches here and abroad, by the preaching of the Gospel in the power of the Holy Spirit. All of these pursuits are to be sought in dependence and guidance on the power and wisdom of the Holy Spirit.</p> -->
				</div>
			</div>
		</div>
		<div class="welcome about_intro">
			
			<h1>IN HIS SERVICE</h1>
			<p>Living Word IT Park is a church for God and for Cebu and its people. Outside the walls of the church is a development in Cebu’s economy that has never been witnessed before. We are at a point where there is rapid change in our economy, culture, politics and also in moral and spiritual matters.</p>
			<p>To most people, a church building is a solemn place with a cross on top and a grand piano playing inside. Although there is nothing wrong with this picture, here at Living Word IT Park, we have a contemporary ambiance with our coffee-bookshop, theater-type sanctuary, multimedia function rooms and electronic musical instruments. We believe that God is the God of the ages. Living Word IT Park represents a church of and for this generation of believers, a generation familiar with communications, media and digital technology, yet stays true to the timeless message and principles of the Bible.</p>
			<p>We operate under the power of the Holy Spirit, the same power and anointing that was endowed to the early disciples that started the change in the world centuries ago. Like the early disciples, we stand firm in our belief to be relevant in society and culture.</p>
			
			<div class="core_values">
				<img src="images/about_lwit/core_values.png"/><br />
				<div>
				<div id='core1' class='core_img core1'></div>
				<div id='core2'  class='core_img core2'></div>
				<div id='core3'  class='core_img core3'></div>
				<div id='core4'  class='core_img core4'></div>
				<div id='core5'  class='core_img core5'></div>
				</div>
			</div>
			<div id="core1_desc" class="coredesc">
				<div class="prayer"></div>
			</div>
			<div id="core2_desc">
				<div></div>
				<div></div>
			</div>
			<div id="core3_desc">
				<div></div>
				<div></div>
			</div>
			<div id="core4_desc">
				<div></div>
				<div></div>
			</div>
			<div id="core5_desc">
				<div></div>
				<div></div>
			</div>
			<div class="core_values" style="float: left; margin: 6px;">
				<img src="images/about_lwit/pastoralteam.png" height=""/><br />
				<div>
					<div class="pastoral_container"><div class='core_img aang'></div><div class="pastoral_name">Anthony Ang</div><div class="assignment">overseer</div></div>
					<div class="pastoral_container"><div class='core_img nshan'></div><div class="pastoral_name">Nick Shan</div><div class="assignment">elder</div></div>
					<div class="pastoral_container"><div class='core_img nsy'></div><div class="pastoral_name">Nic Sy</div><div class="assignment">senior pastor</div></div>
					<div class="pastoral_container"><div class='core_img jchua'></div><div class="pastoral_name">Jojo Chua</div><div class="assignment">young pro pastor</div></div>
					<div class="pastoral_container"><div class='core_img jaguhob'></div><div class="pastoral_name">Jasper Aguhob</div><div class="assignment">youth pastor</div></div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include_once('footer_page.php');
?>