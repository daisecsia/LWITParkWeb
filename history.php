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
<div style="background: url('images/page_banner/history_banner.jpg') no-repeat;  background-size: 100%; height: 200px; opacity: 1"></div>
<div class="page_wrapper">
<div style="background: #8F9AAA; margin: 0px auto;"><!-- 8F9AAA -->
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
				<img src="images/timeline/1.png" width="300" height="300" style="padding-top:10px;" />
				<h1>2007</h1>
				<div style="width: 400px;" class="scroll">
					<p>The church traces its beginnings to two Chinese Bible studies some time in mid-2007. The first group was composed of regular attendees from Living Word (Main-Banawa) and was led by Bro. Nic Sy. Shortly after, a second group was formed with Ptr. Joel Degoma of Living Word South (Talisay) teaching the Bible Study.</p>
				</div>
			</li>
			<li id="2008">
				<img src="images/timeline/2.png" width="256" height="256" />
				<h1>2008</h1>
				<div style="width: 400px;" class="scroll">
					<p>On September 2008, the two Chinese bible study groups met together in a ministry fair in Livingword Banawa. Pastor Mel, Dr. Anthony Ang and the leaders of the two groups discussed the possibility of starting a Saturday service outside Livingword Banawa.</p>
					<p>Thus began constant prayer and preparation of this plan and on December 6, 2008, we had our very first Saturday afternoon service at a function room of Cebu Parklane Hotel with 65 attendees. The fellowship averaged 40 to 50 people in the succeeding months. Pastor Mel, Pastor Joel, Dr. Ang, and Bro. Nick took turns preaching the Word with Bro. Nick even playing the guitar. The Lord eventually called Bro. Nick Sy to pastor the newly found church.</p>
				</div>
			</li>
			<li id="2009">
				<img src="images/timeline/3.png" width="256" height="256" />
				<h1>2009</h1>
				<div style="width: 400px;" class="scroll">
					<p>Seeing the church growing steadily both in quality and quantity, the Lord led the group to pray for another venue in order to be able to serve with excellence. As a mighty answer to prayer, the Lord touched the hearts of the owners of Skyrise Realty and Development Corp., Bro. Harry Villoria and Sis Jennifer Villoria to make way for an available space, and construction of a new worship center in IT Park began on August 2009 with the first Saturday worship service officially transferred in Skyrise 1, IT Park on October 3, 2009.</p>
					<p>On December 2, 2009, the place was officially dedicated to the Lord. The church grew in number so a Sunday 10am service was opened on December 6 of the same year.</p>
				</div>
			</li>
			<li id="2010">
				<img src="images/timeline/4.png" width="256" height="256" />
				<h1>2010</h1>
				<div style="width: 400px;" class="scroll">
					<p>The church continued to expand over the succeeding months. New ministries were formed (Children's Ministry led by Sis. Anne Sy, Ushering Team led by Bro. Nic Shan, Physical and Creative Team led by Bro. Bill Ong and a prayer group led by Sis. Telly Lee). The Worship Team continued to expand with more musicians and singers committing to serve.</p>
					<p>Membership class was offered in March and major events such as the first kid's Vacation Bible School (VBS), Creative Ministry Fellowship Night, and water baptism were held.</p>
					<p>As the year ended, with God's outpouring of blessing, the congregation started to show signs of having outgrown the sanctuary. Work for expansion began as the anniversary was approaching. A bit of optimization in the arrangements of the coffee shop and function rooms gave more space for the sanctuary.</p>
					<p>For its 2nd year anniversary, the church kicked off the celebration with a Night of Praise on December 10, 2010 in place of the regular Saturday worship service. It was an hour of pure praise and worship, lifting of thankful hearts to the Amazing God. On Sunday, the worship service was made special with a memorable art presentation, preaching of the Word of God by Dr. Anthony Ang and lunch fellowship.</p>
				</div>
			</li>
			<li id="2011">
				<img src="images/timeline/5.png" width="256" height="256" />
				<h1>2011</h1>
				<div style="width: 400px;" class="scroll">
					<p>Indeed, God was blessing us but He will not stop there as long as we pursue the right path. Year 2011 saw the expansion of other ministries, the launching of the youth ministry (Tough Avenue), and eventually the church as a whole.</p>
					<p>Due to God's continuous outpouring of grace and blessings, the space in Skyrise 1 was no longer sufficient. We had to look for a bigger space. Again, due to God's faithfulness and a lot of people who are willing to sacrifice for the Lord, on December 9, 2012, we were able to have our very first Sunday service in Skyrise 4.</p>
				</div>
			</li>
			<li id="2013">
				<img src="images/timeline/6.png" width="256" height="256" />
				<h1>2013</h1>
				<div style="width: 400px;" class="scroll">
					<p>In the year 2013, we expected nothing but more and more was what we got. Beginning of 2013 was highlighted by a praise night with Carlos Choi Band shortly followed the most successful Children's VBS to date and the Youth Camp. Not long ago, we just had an uplifting evangelistic dinner talk with Cesar Guy and we are now formalizing our small groups which have tremendous potention for church growth.</p>
				</div>
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