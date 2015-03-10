<script type="text/javascript" src="script/index_slider.js"></script>
<div id="slider">
	<div id="mover">
		<div id="slide-1" class="slide">
			<h1>COME</h1>
			<p>See our schedule page to know more about our worship services and upcoming events.</p>
			<a href="#"><img src="images/slider_img/come.png" alt="view worship schedules and calendar" /></a>
		</div>
		<div class="slide">
			<h1>SERVE</h1>
			<p>Find a place to volunteer. Check our ministry list and be part of the church working group.</p>
			<a href="ministry.php"><img src="images/slider_img/serve.png" alt="view ministry involvement opportunities" /></a>
		</div>
		<div class="slide">
			<h1>GROW</h1>
			<p>Learn more about God through His Word. Connect to a small group now.</p>
			<a href="small_group.php"><img src="images/slider_img/grow.png" alt="view small group schedules" /></a>
		</div>
		<div class="slide"> 
			<h1>LISTEN</h1>
			<p>Out of town and missed on a Sunday service? Listen to our uploaded audio sermon or download it to listen again when offline.</p>
			<a href="#"><img src="images/slider_img/listen.png" alt="listen to previous sermons" /></a>
		</div>
		<div class="slide">
			<h1>GO</h1>
			<p>Find out how you can minister outside the four walls of the church.</p>
			<a href="#"><img src="images/slider_img/go.png" alt="learn more how you can help" /></a>
		</div>
		<div class="slide">
			<h1>REGISTER</h1>
			<p>Check other resources available only to registered users. Sign up now.</p>
			<a href="signup.php"><img src="images/slider_img/register.png" alt="register to receive updates" /></a>
		</div>
	</div>
</div>
<div class="index_content_wrapper">
	<div class="welcome">
		<font face="Monotype Corsiva" size="20" color: "orange" style="italic">Welcome!</font>
		<p> We are delighted that you are visiting us!</p>
		<p><font style="font-weight: bold; font-size: 18px; color: #FF7D4C;">Word IT Park</font> is a church for God and for Cebu and its people. Since we are centered in the city's business metropolis, outside the walls of the church is a development in Cebu's economy that has never been witnessed before.</p>
		<p>To most people, a church building is a solemn place with a cross on top and a grand piano playing inside. Although there is nothing wrong with this picture, here at Living Word IT Park, we have a contemporary ambiance with our theater-type sanctuary, multimedia function rooms and electronic musical instruments. We believe that God is the God of the ages. Living Word IT Park represents a church of and for this generation of believer, a generation familiar with communications, media and digital technology, yet stays true to the timeless message and principles of the Bible.</p>
		<p>As you explore our website, you will discover more of who we are and what we do. More importantly, we hope that you will find the empowering and life-changing power of God through the death and resurrection of our Lord Jesus Christ, as the Holy Spirit uses this media to lead you to a new, if not deeper, life of fellowship with Him.</p>
		
		<br /><p>Grace and peace,</p>
		<p>Livingword IT</p>
	</div>
	<div class="featured_wrapper">
		<h2>FEATURED STORY</h2>
		<?php
		$result = dbc_query_all("SELECT * FROM article ORDER BY date DESC LIMIT 2");
		foreach($result as $article_result)
		{
			$article_content = file_get_contents('D:/PHPDev/livingworditpark/articles/'.str_replace("?", '', $article_result['title']).'.txt');
			echo "<div class='feature_article'>
			<div class='feature_title'>
				<h1>{$article_result['title']}</h1>
			</div>
			<div class='feature_content'>
				<img class='feature_img' src='articles/image/{$article_result['article_id']}.jpg' align='right' alt='{$article_result['title']}' height='130px' width='130px' hspace='3px' vspace='3px' />
				<br /><p>"
						//.$article = 'The Tboli are one of the indigenous peoples of South Cotabato in Southern Mindanao. From the body of 									ethnographic and linguistic literature on Mindanao they are variously known as Tboli, T'boli, Tböli, Tiboli, 									Tibole, Tagabili, Tagabeli, and Tagabulu. They term themselves Tboli or T'boli.Their whereabouts and identity 									are somewhat imprecise in the literature; some publications present the Tboli and the Tagabili as distinct 									peoples; some locate the Tbolis to the vicinity of the Lake Buluan in the Cotabato Basin or in Agusan del Norte. 									The Tbolis, then, reside on the mountain slopes on either side of the upper Alah Valley and the coastal area of 									Maitum, Maasim and Kiamba. In former times, the Tbolis also inhabited the upper Alah Valley floor. After World 									War Two, i.e., since the arrival of settlers originating from other parts of the Philippines, they have been 									gradually pushed onto the mountain slopes. As of now, they are almost expelled from the fertile valley floor.";
						.substr($article_content, 0,270).'... '
						."<br /><a href='article.php?id={$article_result['article_id']}'>Read More</a>"
						."</p>
			</div>
		</div>";
		}
		?>
		<div class="feature_content" style="text-align: right; padding: 0px 15px 15px 0px;"><a href="article.php">View All</a></div>
	</div>
	<div class="divider"></div>
	<div id="events">
		<h1>EVENTS</h1>
		<div id="calendar">
		<?php
			include_once('calendar.php'); 
			$calendar = new Calendar();
			echo $calendar->show();
		?>
		</div>
		<div id="event_detail_wrapper">
		<?php
			echo $calendar->showEvent();
		?>
		</div>
	</div>
</div>