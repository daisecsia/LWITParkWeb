<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="script/jquery.plugin.js"></script> 
<script type="text/javascript" src="script/jquery.countdown.js"></script>
<?php
if($_SERVER['REQUEST_METHOD']=='POST')
{
	if(isset($_POST['subscribe'])&&$_POST['subscribe'])
	{
		if(isset($_POST['s_email']) && $_POST['s_email'])
		{
			$email = $_POST['s_email'];
			if(filter_var($email,FILTER_VALIDATE_EMAIL))
			{
				if(!dbc_query_one("SELECT subscription_id FROM subscription WHERE email = '$email'"))
				{
					$result = dbc_query("INSERT INTO subscription (email, subscribed_date) VALUES ('$email','".date("Y-m-d")."')");
					if($result)
						$result_msg = 'Thank you for subscribing to Livingword IT Park. Updates and notifications will be sent to the email you provided.';
					echo "<script>
							popup('$result_msg');
						  </script>";
				}
				else
					$msg="you are already subscribed with entered email";
			}
			else
				$msg="invalid email";
		}
		else
			$msg = "empty email address";
	}
}
?> 
	<div class="upper_footer">
		<?php 
			echo DBC_HOST;
			echo DBC_USER;
			echo DBC_PASSWORD;
			echo DBC_NAME;
		?>
		<!--
		<div class="subscribe_wrapper" style="position: relative;  float: left;">
			<!-- <h3>Spread the word. SHARE TO A FRIEND OR SOMEONE YOU KNOW.</h3>
			<h2>KEEP IN TOUCH AND BE THE FIRST TO KNOW!</h2>
			<h3>subscribe and receive latest news and updates from us.</h3><br />
			<div id="subscription">
				<div style="float: left; padding: 2px;">
					<font color="#ffffff">E-mail ad:</font>
				</div>
				<div style="float: right;">
					<form id="subscription_form" name="subscription_form" action="" method="post">
						<input type="text" placeholder="e-mail ad" name="s_email" value="" autocomplete="off" maxlength="35" />
						<span id="error-msg"><?php echo "$msg"; ?></span>
						<br />
						<input id="subscribe" name='subscribe' type="submit" value=" subscribe "/>
					</form>
				</div>
			</div>
			
		</div>-->
		<?php
		$event = dbc_query_all("select event_name, event_theme, date_start, date_end, venue from events WHERE date_start > NOW() ORDER BY date_start LIMIT 1");
		$year = date("Y", strtotime($event[0]['date_start']));
		$month = date("m", strtotime($event[0]['date_start']));
		$day = date("j", strtotime($event[0]['date_start']));
		$hour = date("G", strtotime($event[0]['date_start']));
		$min = date("i", strtotime($event[0]['date_start']));
		if($page != "schedule")
		{
			$content = "<div class='thumb'>
							<div class='event_countdown'>
								<div class='event_title'>next event: <br />" ."{$event[0]['event_name']} ". ($event[0]['event_theme'] != '' ? ": " .$event[0]['event_theme'] : '')."</div>
								<div id='defaultCountdown'></div>
								<div class='event_details'>".$event[0]['venue'] ." @ " .date("M d, Y h:i A", strtotime($event[0]['date_start'])) ."</div>
							</div>
						</div>";
			echo $content;
		}
		
		?>
		
		<div class="social_media">
			<div class="service_schedule">
				<h3>schedule of services:</h3>
				<p>Saturday 05:30 pm - 07:00 pm Skyrise 1</p>
				<p>Sunday	10:00 am - 12:00 pm Skyrise 4</p>
				<h3>prayer meeting:</h3>
				<p>Friday 06:00 pm - 07:00 pm Skyrise 1</p>
			</div>
			<div class="social_media_icon">
		       	<a href="https://www.facebook.com/lwitpark" target="_blank"><img src="images/social_media/fbplain_icon.png" height="25px" width="25px" /></a>
		       	<a href="www.twitter.com" target="_blank"><img src="images/social_media/twitterplain_icon.png" height="25px" width="25px" /></a>
		       	<a href="https://plus.google.com/" target="_blank"><img src="images/social_media/googleplain_icon.png" height="25px" width="25px" /></span></a>
			</div>
		</div>
	</div>
	<div class="lower_footer">
		<div class="floater_left"> <p>©<?php echo (2014==date("Y",time()))?'2014':'2014-'.date("Y",time()); ?>   |  LIVINGWORD IT PARK <br />all rights reserved.</p></div>
		<div class="floater_right">
			<p>Skyrise 1 Bldg., AsiaTown IT Park, Lahug Cebu City, Philippines
			<br />livingworditpark@gmail.com  |  (0923) 883 - 3600  |  (032) 415 – 6148</p>
		</div>
	</div>
	<div style="background: white;height:10px;">&nbsp;</div>
</div>
<script>
$(function () {
	var austDay = new Date();
	austDay = new Date(<?php echo $year; ?>,<?php echo $month-1; ?>,<?php echo $day; ?>,<?php echo $hour; ?>,<?php echo $min; ?>);
	//austDay = new Date(2015,5,27,9,30);
	//austDay = new Date(austDay.getFullYear() + 1, 1 - 1, 26);
	$('#defaultCountdown').countdown({until: austDay});
	$('#year').text(austDay.getFullYear());
});
</script>
</body>
</html>