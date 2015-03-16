<?php
$menu_id = "involve";
$page_title = "Serve Opportunities";
include_once('header_page.php');
?>

<div style="background: url('images/page_banner/BannerGetPluggedIn.png') no-repeat; background-size: 100%; height: 200px; opacity: 1"></div>
<div class="page_wrapper">
	<div class="tabs">
	    <ul class="tab-links">
	        <li class="active"><a href="#ushering">Ushering</a></li>
	        <li><a href="#worship">Worship</a></li>
	        <li><a href="#children">Kid's School</a></li>
	        <li><a href="#creative">Creative</a></li>
	        <li><a href="#youth">Youth</a></li>
	        <li><a href="#youngpro">Young Professionals</a></li>
	        <li><a href="#media">Digital Media</a></li>
	    </ul>
	 
	    <div class="tab-content">
	        <div id="ushering" class="tab active ushering">
	        	<img src="images/page_banner/BannerUshering.jpg" width="1280" />
				<p style="font-size: 15px;">The ushers, with their warm smiles, affectionate greetings, and friendly handshakes, are the people who welcome you to church, guide you where to sit, give handouts, assist new comers, and take care of after-service inquiries creating an atmosphere of warmth and acceptance. They also do the physical arrangement of the chairs and other fixtures, monitoring the air conditioning, and manning the information booth.</p><br />
				<div style="width: 500px; margin: 0px auto; height: 320px; background: url('images/ministry/ushers.png') no-repeat;">
				</div>
				<h2 style="color: #fff;">Where You Can Serve</h2>
				<div class="usher_service">
					<div class="food_service"></div>
					<h2 style="margin-top: 10px; color: #3e4a12; font-size: 13px; font-weight: bolder; text-decoration: underline;">FOOD SERVERS</h2>
					<div>
					<p>Food has always been part of our gathering, whether it is just a usual get-together with friends. The ushering team sees food as a means to gather people together and engage in fellowship before and after the service. They offer healthy and delicious refreshments for everyone to have while getting to know how another brother is doing. They will surely need more hands for this. Maybe you can consider this as a good opportunity for you to give your warmest greeting to our brothers and sisters, along with a cup of coffee.
					</p>
					</div>
				</div>
				<div class="usher_service">
					<div class="greeters"></div>
					<h2 style="margin-top: 10px; color: #3e4a12; font-size: 13px; font-weight: bolder; text-decoration: underline;">GREETERS</h2>
					<p>Say "hello", shake hands, distribute sermon notes for the week, and usher guests to their seats. These are only few of the things we love with the ushering team. If you love giving people your sweetest smile, or if you just can't wait to start a conversation with someone, this might be a place of ministry for you!
					</p>
				</div>
				<div class="usher_service">
					<div class="physical_arrange"></div>
					<h2 style="margin-top: 10px; color: #3e4a12; font-size: 13px; font-weight: bolder; text-decoration: underline;">PHYSICAL ARRANGEMENT</h2>
					<p>They come early to church, makes sure the seats are clean and arranged properly, and the needed tables are put up. I'm sure they will love it if you can give them a hand.
					</p>
				</div>
        	</div>
	 
	        <div id="worship" class="tab">
	            <h1>Worship Ministry</h1>
				<p>The Worship Team exists for the purpose of the worship of God. The ministry goals are to lead God’s people into true worship, teach what true worship is, disciple future leaders and ministers, impart a life of worship to the church, show the church the importance of praising and worshiping God every day with every opportunity given and provide the best atmosphere and opportunity for the congregation to worship the Lord in Spirit and in truth.</p>
			</div>
	 
	        <div id="children" class="tab">
	            <img src="images/ministry/bible_explorers.png" />
	            <p>The Children’s Ministry is actively motivating and molding the next generation by sharing to them the gospel and leading them to a saving faith in Christ. Energetic teachers impart Biblical truths to impressionable young hearts, using fun and exciting ways through songs, stories and crafts.</p>
	        </div>
	 
	        <div id="creative" class="tab">
	            <p>Creative Team</p>
	            <p>The physical and creative ministry is the “behind the scenes” team that makes sure everything flows smoothly during services to create an atmosphere of praise and worship. Although not physically noticeable during worship service, their works are. They are responsible for the design on the lobby, stage and around the church premises. They offer their artistic skills in service to God so that biblical truth are communicated more clearly, creatively, concretely.</p>
	        </div>
	        
	        <div id="youth" class="tab">
	        	<p>Tough Avenue</p>
	        	<p>We’ve all had to make hard choices one time or another. We’ve all had times when we had to make a tough call. You wish you didn’t have to but time was pressing hard against your back to choose from among your options. Welcome to the youth years. Suddenly you’re asked questions about where to go, who to be, which school to be in, which career path to take, who to be with and even who to follow. Your gut tells you to do this but your heart, your friends, your family are also demanding from you many other different things. You now find yourself with a mixture of thoughts and a long list of options in order to make one decision. You’re at the crossroads.</p>
				<br />
				<p>The world further offers options. It may seem that you have the freedom to do whatever you like. But to the believer, God bids you in Matthew 7:13-14 to enter the narrow gate.</p>
				<br />
				<p>Tough Avenue Youth Ministry is anchored on the Word of God as its main source of instruction in life and relationship as you journey the crossroad of the adolescence.</p>
	        </div>
	        <div id="youngpro" class="tab">
	        	<p>Young Professionals</p>
	        	<p></p>
	        </div>
	        <div id="media" class="tab">
	        	<p>Digital Media</p>
	        	<p>The Digital Media Ministry or sometimes called DM<sup>2</sup> have a broad scope of responsibilities – from the interior design and visual presentations on display, to the audio system, and the lighting effects.</p>
	        </div>
	    </div>
	</div>
	<div id="subscription" style="width: 100px;float: right;">
		<form  name="ministry_form" method="get" action="signup.php" style="border: none; outline: none; box-shadow: none;">
			<input id="hidden_field" name="selected_ministry" type="hidden" value="ushering" />
			<input id="hidden_field" name="signup_id" type="hidden" value="1" />
			<input id="subscribe" name="join_ministry" type="submit" value="JOIN" style="color: #fff; text-align: center; letter-spacing: 1px; width: 80px;" />
		</form>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
	    $('.tabs .tab-links a').click(function(e)  {
	        //var currentAttrValue = $(this).attr('href');
	 		var currentAttrValue = this.getAttribute('href');
	        // Show/Hide Tabs
	        $("div"+currentAttrValue).slideDown(400).siblings().slideUp(400);
	        // Change/remove current tab to active
	        $(this).parent('li').addClass('active').siblings().removeClass('active');
	 
	        e.preventDefault();
	        
			document.getElementById("hidden_field").value = currentAttrValue;
	    });
	});
</script>
<?php
include_once('footer_page.php');
?>