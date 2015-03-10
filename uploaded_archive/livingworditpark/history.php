<?php
$menu_id = "about";
$page_title = "Church History";
include_once('header_page.php');
?>
<script>
	var $jq = jQuery.noConflict();
	$jq(function(){
		$jq().timelinr({
			arrowKeys: 'true'
		})
	}); 
</script>
<div class="page_wrapper">
	<h1 style="text-align: center; font-size: 3em; padding-top: 20px; color: #232e3c;">LIVINGWORD THROUGH THE YEARS</h1>
<div style="background: #8F9AAA; width: 800px; margin: 0px auto;">
<div id="timeline">
		<ul id="dates">
			<li><a href="#2007">2007</a></li>
			<li><a href="#2008">2008</a></li>
			<li><a href="#2009">2009</a></li>
			<li><a href="#2010">2010</a></li>
			<li><a href="#2011">2011</a></li>
			<li><a href="#2013">2013</a></li>
		</ul>
		<ul id="issues">
			<li id="2007">
				<img src="images/timeline/1.png" width="256" height="256" />
				<h1>2007</h1>
				<div style="width: 460px;" class="scroll">
				<p>In mid-2007, there was a bible study group that started every Thursday in the upper room of Pastor Mel's house in Mango Ave., with then bible teacher, Bro. Nick Sy. Meanwhile, there was another group (which is now the Tsinoy group) having bible studies which was handled by Pastor Joel Degoma.</p>
				<p>Thus began constant prayer and preparation of this plan and on December 6, 2008, we had our very first Saturday afternoon service at a function room of Cebu Parklane Hotel with 65 attendees. Pastor Mel, Pastor Joel, Dr. Ang, and Bro. Nick took turns preaching the Word with Bro. Nick even playing the guitar. The Lord eventually called Bro. Nick Sy to pastor the newly found church.</p>
				</div>
			</li>
			<li id="2008">
				<img src="images/timeline/2.png" width="256" height="256" />
				<h1>2008</h1>
				<p>On September 2008, the two groups met together in a ministry fair in Livingword Banawa. Pastor Mel and Dr. Anthony Ang discussed the possibility of starting a Saturday service outside Livingword Banawa</p>
			</li>
			<li id="2009">
				<img src="images/timeline/3.png" width="256" height="256" />
				<h1>2009</h1>
				<p>The church was steadily growing and we had to have a place of worship of our own. As a mighty answer to prayer, the Lord touched the hearts of the owners of Skyrise Realty and Development Corp. and construction of a new worship center in IT Park began. On October 3, 2009, we had our very first Saturday worship service in Skyrise 1, IT Park.</p>
				
			</li>
			<li id="2010">
				<img src="images/timeline/4.png" width="256" height="256" />
				<h1>2010</h1>
				<p>The year 2010 marked the year of God's goodness and faithfulness. It was a year full of firsts for our church--the first Children's VBS, first baptism, and first Praise Night Celebration.</p>
			</li>
			<li id="2011">
				<img src="images/timeline/5.png" width="256" height="256" />
				<h1>2011</h1>
				<p>Indeed, God was blessing us but He will not stop there as long as we pursue the right path. Year 2011 saw the expansion of other ministries, the launching of Tough Avenue, and eventually the church as a whole.</p>
				<p>Due to God's continuous outpouring of grace and blessings, the space in Skyrise 1 was no longer sufficient. We had to look for a bigger space. Again, due to God's faithfulness and a lot of people who are willing to sacrifice for the Lord, on December 9, 2012, we were able to have our very first Sunday service in Skyrise 4.</p>
			</li>
			<li id="2013">
				<img src="images/timeline/6.png" width="256" height="256" />
				<h1>2013</h1>
				<p>In the year 2013, we expected nothing but more and more was what we got. Beginning of 2013 was highlighted by a praise night with Carlos Choi Band shortly followed the most successful Children's VBS to date and the Youth Camp. Not long ago, we just had an uplifting evangelistic dinner talk with Cesar Guy and we are now formalizing our small groups which have tremendous potention for church growth.</p>
			</li>
		</ul>
		<!--
		<div id="grad_left"></div>
		<div id="grad_right"></div>
		<a href="#" id="next">+</a>
		<a href="#" id="prev">-</a>-->
	</div>
</div>
</div>
<?php
include_once('footer_page.php');
?>