<?php
$page_title = "Login";
include_once('header_page.php');
include_once('util/base_inc.php');
?>
<style>
	dt{
	display: inline-block;
	
}
dd{
	display: inline-block;
}
</style>
<script type="text/javascript">
$(document).ready(function(){
  $("#small_group_no").click(function(){
    $("#sg_label").hide();
    $("#sg_list").hide();
    $("#age_label").show();
    $("#age").show();
  });
  $("#small_group_yes").click(function(){
    $("#sg_label").show();
    $("#sg_list").show();
    $("#age_label").hide();
    $("#age").hide();
  });
  
});
</script>
<?php
include_once('util/form_util_inc.php');
include_once('util/page_util_inc.php');

$id = get('id',1);
$ministry = get('selected_ministry',10);

$fields = array('username', 'u_email', 'password', 'lname', 'fname', 'u_contact', 'gender', 'small_group', 'sg_list', 'age');

$field = new Field();
$field->define_field('username','');
$field->define_field('u_email','');
$field->define_field('password','');
$field->define_field('lname');
$field->define_field('fname');
$field->define_field('u_contact');
$field->define_field('gender');
$field->define_field('small_group');
$field->define_field('sg_list');
$field->define_field('age');

if($_SERVER['REQUEST_METHOD']=='POST')
{
	if(isset($_POST['signup']))
	{
		$error = false;
		//username
		if(!$field->error_empty('username', '<br /> empty username<br />', $error))
		{
			$field->is_exist('username', 'user', 'username', 'username already exists', $error); 
		}
		
		//email-ad
		if(!$field->error_empty('u_email', '<br /> empty email add<br />', $error))
		{
			if(!$field->is_exist('u_email', 'user', 'username', 'email already exists', $error))
				if($field->error_email('u_email','<br /> invalid email add<br />', $error));
		}
		
		//password
		if(!$field->error_empty('password', '<br /> empty password<br />', $error))
			$field->error_password('password', '<br /> password must comply following rules: <br />
														- must contain digit from 1-9 <br />
														- must contain one lowercase <br />
														- must contain one uppercase <br />
														- must contain one special symbol in the list @#$%_! <br />
														- length must be 6-8 <br />'
									, $error
									);
		//name
		$field->error_empty('lname', '<br /> please supply last name<br />', $error);
		$field->error_empty('fname', '<br /> please supply first name<br />', $error);
		
		//contact info
		if(!$field->error_empty('u_contact', '<br /> please provide us with your contact number<br />', $error))
			$field->error_phone('u_contact', '<br /> sorry, i don\'t recognize that phone format. <br />', $error);
		
		//gender
		$field->error_empty('gender', '<br /> please select gender<br />', $error);
		
		//small group
		$field->error_checkbox('small_group', '<br /> please let us know if you already have small group or not<br />', $error);
		
		//small group listbox
		if($field->value('small_group')=='true')
		{
			if(!$field->error_empty('sg_list', '<br /> please select small group<br />', $error))
				$field->error_condition('sg_list',$field->value('sg_list')=='X', '<br /> please select small group<br />', $error);
		}
		
		if($field->value('small_group')=='false')
		{
			if(!$field->error_empty('age', '<br /> age empty<br />', $error))
				$field->error_int('age', '<br /> invalid number format<br />', $error);
		}
		
		if(!$error)
		{
			$field->post_value();
			$user_save = 0;
			$query .= sprintf("INSERT INTO user (username, password, lastname, firstname, mobile, email_ad, sg_status, sg_id, ministry_status, ministry_id, age, access_right, lastlogin)
								VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', %d, '%s', '%s')"
								, $field->value('username')
								, crypt($field->value('password'), '$2a$15$Ku2hb./9aA71tPo/E015h.$')
								, $field->value('lname')
								, $field->value('fname')
								, $field->value('u_contact')
								, $field->value('u_email')
								, $field->value('small_group')=='true' ? '1' : '0'
								, $field->value('small_group')=='true' ? $field->value('sg_list') : 'X'
								, '0'
								, NULL
								, $field->value('small_group')=='false' ? $field->value('age') : 0
								, 1
								, date("Y-m-d h:i:s",strtotime(now('Asia/Manila')))
								);

			if(dbc_query($query))
					$user_save=1;
			//$subscribe_result = dbc_query("INSERT INTO subscription (email, subscribed_date) VALUES ('".$field->value('u_email')."','".date("Y-m-d")."')");
			echo $user_save;
			if($user_save)// && $subscribe_result)
			{
				$result_msg = "your account has been created. Start now";
				echo "<script>
							popup('$result_msg');
					  </script>";
					  
				foreach ($fields as $_fields)
				{
					$field->initialize_field($_fields);
				}
				
				include_once('util/mail_util_inc.php');
				$body = form_content();
				send_mail($field->value('u_email'), $field->value('fname')." ".$field->value('lname'), $body);
			}
		}
	}	
}
elseif ($_SERVER['REQUEST_METHOD']=='GET')
{
	if (isset($_GET['selected_ministry']))
	{
		$ministry = str_replace('#', '', strtoupper($_GET['selected_ministry']));
		if ($ministry == 'YOUNGPRO')
		{
			$new_page = 'small_group.php#yp';
			header('Location: ' .$new_page);
		}
	}
	if (isset($_GET['signup_id']))
		$id = $_GET['signup_id'];
	if (isset($_GET['selected_sg']))
		$category = $_GET['selected_sg'];
}

function form_content()
{
	$content = "<div style='background: #c1ddf1;
		padding: 5px;
		overflow: hidden;
		margin: 10px auto;'>
	<img src=\"cid:lit_logo\" />
	<br />
	<p style = 'font-family: Tahoma, Calibri;
		font-size: 12px;
		color: #333333;'>Hi user!</p>
	<h3 style='font-family: Tahoma, Calibri;
		font-size: 15px;
		color: #333333;'>Thank you for signing up!</h3>
	<p style = 'font-family: Georgia;
				font-size: 11px;
				color: #333333;
				text-decoration: italic;
				text-align: center;
				padding: 0px 20px;'>&ldquo;The gifts of the Master are these: freedom, life, hope, new direction, transformation, and intimacy with God. If the cross was the end of the story, we would have no hope. But the cross isn&lsquo;t the end. Jesus didn&lsquo;t escape from death; he conquered it and opened the way to heaven for all who will dare to believe. The truth of this moment, if we let it sweep over us, is stunning. It means Jesus really is who he claimed to be, we are really as lost as he said we are, and he really is the only way for us to intimately and spiritually connect with God again.&ldquo; 
<br />― Steven James, Story</p>
	<p style = 'font-family: Tahoma, Calibri;
		font-size: 12px;
		color: #333333;'>It is our prayer that you will grow in the Lord as you get involved with the different ministries of the church. We hope you will consider joining one today, if you don&lsquo;t have one yet.<br />
	<br /><br />
	Sincerely yours,<br /><br />
	Livingword IT Park<br /><br /></p>
	<p style = 'font-family: Tahoma, Calibri;
		font-size: 12px;
		color: #FFFFFF;
		background: #09385a;
		width: 500px;'>Skyrise 1 Bldg., AsiaTown IT Park, Lahug Cebu City, Philippines   | (032) 415 – 6148 </p>
</div>";
	return $content;
}
?>
<div class="page_wrapper">
	<div class="form_wrapper">
		<?php
			if($id == 0)
				echo "<h1>CREATE LIVINGWORD ACCOUNT</h1>";
			elseif ($id == 1) 
				echo "<h1>COUNT ME IN!</h1>";
			elseif ($id == 2) 
				echo "<h1>JOIN OUR SMALL GROUP</h1>";
		?>
		<div class="horizontal_separator"></div>
		<div>
			<div class="signup_text">
				<!--<div>
					<h2>Signing up to Livingword gives you the following priviledges:</h2>
				</div>-->
				<!--<div class="horizontal_separator"></div>-->
				<?php
					if ($id == 0)
					{
						$content ="<div>
										<h2>Church updates and news</h2>
										<p>Receive updates through the contact details you provide.</p>
										<!--If you sign up using your social media account, you automatically <img src='images/signup_img/facebook-like-icon.png' hspace='2px'> or <img src='images/signup_img/follow.png' hspace='2px' /> our socia media pages; thus, allowing our updates to appear in your news feed.</p> -->
									</div>
									<!--<div class='horizontal_separator'></div>-->
									<div>
										<h2>Comments and suggestions</h2>
										<p>Read and post comments and suggestions that will help improve the church or the site. Your posts will be sent to our official email inbox and will appear on our page (unless tagged as confidential).</p><br />
										<p><font color='red'>Note:</font> Administrator has the right to unpost comments that are vulgar or might trigger debates. This site is not for that purpose.</p>
									</div>
									<!--<div class='horizontal_separator'></div>-->
									<div>
										<h2>Access administrative pages</h2>
										<p>Access report and admin pages, depending on the access rights given to you by the system administrator. <i>If you are a small group leader or you're asking for administrative access rights, please sign up by filling up the complete form which will give us more references on the access rights to be granted to your account.</i></p>
									</div>
									<div>
										<br /><br />
										<p>If you already have an account, you can now <a style='color: white;' href='login.php'>login</a>.</p>
									</div>";
					}
					elseif ($id == 1)
					{
						$content = "<div>";
							if ($ministry == 'USHERING')
							{
								$content .= "<div class='ministry_signup_heading usher'></div>";
							}
							else if ($ministry == 'CHILDREN')
							{
								$content .= "<div class='ministry_signup_heading kid_signup'></div>
											 <div class='kid_signup_quote'></div>";
							}
							else if ($ministry == 'WORSHIP')
							{
								$content .= "<div class='ministry_signup_heading worship_signup'></div>";
							}
							else if ($ministry == 'CREATIVE')
							{
								$content .= "<div class='ministry_signup_heading creative_signup'></div>";
							}
							else if ($ministry == 'YOUTH')
							{
								$content .= "<div class='ministry_signup_heading youth_signup'></div>";
							}
							else if ($ministry == 'MEDIA')
							{
								$content .= "<div class='ministry_signup_heading dm2_signup'></div>";
							}
							else
							{
								$content .= "<div class='ministry_signup_heading register'>
													<div class='board_text'>
														$ministry
													</div>
											 </div>";
							}
						$content .= "</div>";
					}
					echo $content;
				?>
				
			</div>
			<?php
			/*
				$app_id = "290082734498698";
				$app_secret = "6aa36350b9dd20f0c6f1afd8ad0812e2";
				$my_url = "http://livingworditpark.com/signup.php";
				$token_url = "https://graph.facebook.com/oauth/access_token?"
				. "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
				. "&client_secret=" . $app_secret . "&code=" . $code . "&scope=publish_stream,email";
				$response = @file_get_contents($token_url);
				$params = null;
				parse_str($response, $params);
				$graph_url = "https://graph.facebook.com/me?access_token="
				. $params['access_token'];
				$user = json_decode(file_get_contents($graph_url));
				$username = $user->username;
				$email = $user->email;
				$facebook_id = $user->id;
			 */
			?>
			<div class="form_box">
				<div class="social_media_signup" style="display: none;">
					<a href="https://www.facebook.com/dialog/oauth?client_id=&redirect_uri=http://livingworditpark.com/signup.php&scope=publish_actions,email" title="Signup with facebook"><img src="images/signup_img/signin_fb.png" height="30px"/></a>
					<a><img src="images/signup_img/signin_twitter.png" height="30px" /></a>
					<a><img src="images/signup_img/signin_google.png" height="30px" /></a>
				</div>
				<div style="display: none;">
					<table><tr>
							<td width="170px" style="margin: 0px auto;"></td>
							<td>OR</td>
							<td width="170px" style="margin: 0px auto;"></td>
							</tr>
					</table>
				</div>
				<div class="signup_box">
					<legend style="padding: 3px 15px; text-decoration: underline;">SIGN UP</legend>
					<p style="margin: 3px 12px; font-size: 12px; color: white;">all information provided will be treated with utmost confidentiality and will only be used for church purposes</p>
					<form class="signup_form" name="signup_form" method="post">
						<dl>
							<dt>
								<label for='username'>Username:</label>
							</dt>
							<dd>
								<input type='text' id= 'username' name='username' placeholder='Username' maxlength='15' value="<?php echo $field->value('username');?>"/>
							</dd><span id='error-msg'><?php echo $field->error_msg('username');?></span>
						</dl>
						<dl>
							<dt>
								<label for='u_email'>Email Ad:</label>
							</dt>
							<dd><input type='text' id= 'u_email' name='u_email' placeholder='Email Ad' maxlength='35' value="<?php echo  $field->value('u_email');?>"/>
							</dd><span id='error-msg'><?php echo $field->error_msg('u_email');?></span>
						</dl>
						<dl>
							<dt>
								<label for='password'>Password:</label>
							</dt>
							<dd>
								<input type='password' id= 'password' name='password' placeholder='Password' maxlength='30' value="<?php echo  $field->value('password');?>"/>
							</dd><span id='error-msg'><?php echo $field->error_msg('password');?></span>
						</dl>
						<dl>
							<dt>
								<label for='fname'>First Name:</label>
							</dt>
							<dd>
								<input type='text' id= 'fname' name='fname' placeholder='First Name' maxlength='30' value="<?php echo  $field->value('fname');?>"/>
							</dd><span id='error-msg'><?php echo $field->error_msg('fname');?></span>
						</dl>
						<dl>
							<dt>
								<label for='lname'>Last Name:</label>
							</dt>
							<dd>
								<input type='text' id= 'lname' name='lname' placeholder='Last Name' maxlength='30' value="<?php echo  $field->value('lname');?>"/>
							</dd><span id='error-msg'><?php echo $field->error_msg('lname');?></span>
						</dl>
						<dl>
							<dt>
								<label for='u_contact'>Contact:</label>
							</dt>
							<dd>
								<input type='text' id= 'u_contact' name='u_contact' placeholder='Contact No' maxlength='15' value="<?php echo  $field->value('u_contact');?>"/>
							</dd><span id='error-msg'><?php echo $field->error_msg('u_contact');?></span>
						</dl>
						<dl>
							<dt>
								<label>Gender:</label>
							</dt>
							<dd>
								<select class='dropdownlist' name='gender'>
									<option value=''>---Select gender---</option>
									<option value='male' <?php echo ($field->value('gender')=="male" ? 'selected' : ''); ?>>Male</option>
									<option value='female' <?php echo ($field->value('gender')=="female" ? 'selected' : ''); ?>>Female</option>
								</select>
							</dd><span id='error-msg'><?php echo $field->error_msg('gender');?></span>
						</dl>
						<?php
							if($id != 2)
							{
								echo "<dl>
										<dt>
											<label style='width: 270px;'>Are you part of a small group?</label>
										</dt>
										<dd>
											<input type='radio' id='small_group_yes' name='small_group' value='true'". (($field->value('small_group')=='true') ? 'checked' : '') ."/> Yes 
											<input type='radio' id='small_group_no' name='small_group' value='false'". (($field->value('small_group')=='false') ? 'checked' : '')."/> Not yet <br />
										</dd><span id='error-msg'>". $field->error_msg('small_group') ."</span>
									</dl>
									<dl>
										<dt>
											<label id = 'age_label' for='age' ". (($field->value('small_group')=='false') ? "style='display: in-line block'" : "style='display: none;'") .">Age:</label>
										</dt>
										<dd>
											<input ". (($field->value('small_group')=='false') ? "style='display: in-line block'" : "style='display: none;'") ." type='text' id= 'age' name='age' placeholder='Age' value='".$field->value('age')
											."'/>
			 							</dd><span id='error-msg'>".$field->error_msg('age')."</span>
									</dl>";
							}
						?>
						<dl>
							<dt>
								<label id="sg_label" style="width: 270px; <?php echo ($field->value('small_group')=='true' || $id == 2 ? "display: in-line block" : "display: none;"); ?>" >Select Small Group:</label>
							</dt>
							<dd>
								<select class="dropdownlist" id="sg_list" name="sg_list" <?php echo ($field->value('small_group')=='true' || $id == 2 ? "style='display: in-line block'" : "style='display: none;'"); ?>>
									<option value="">---Select small group schedule---</option>
									<?php
										if ($id == 2)
											if ($category != "YP")
												$add_filter = " AND small_group_id != 'X' AND category = '$category' ";
											else
												$add_filter = " AND small_group_id != 'X' AND category like '$category%'";
												
										else $add_filter = "";
										
										$result = dbc_query_all("SELECT small_group_id, name,
																	case when schedule_day = 0 then 'SUN'
																	else case when schedule_day = 1 then 'MON'
																	else case when schedule_day = 2 then 'TUE'
																	else case when schedule_day = 3 then 'WED'
																	else case when schedule_day = 4 then 'THU'
																	else case when schedule_day = 5 then 'FRI'
																	else case when schedule_day = 6 then 'SAT'
																	else 'N/A'
																	end end end end end end end  AS sg_day
																	,time_start,time_end
																	FROM small_group
																	WHERE status = 'A'"
																	.$add_filter
																	."ORDER BY category, schedule_day ASC");
										foreach ($result as $option)
										{
											$content = $option['name']." (".$option['sg_day']." ".date("h:ia",strtotime($option['time_start']))."-".date("h:ia",strtotime($option['time_end'])).")";
											echo "<option value={$option['small_group_id']} ".($field->value('sg_list')==$option['small_group_id'] ? 'selected' : '') .">$content</option>";
										}
									?>
								</select>
							</dd><span id="error-msg"><?php echo $field->error_msg('sg_list');?></span>
						</dl>
						<dl>
							<dd>
								<input id="signup" name='signup' type="submit" value=" Submit "/>
							</dd>
						</dl>
					</form>
				</div>
				<div>
					<a href='<?php echo $_SERVER['HTTP_REFERER']; ?>'><div class='prev_sermon' style='background-size: 30px 30px; float: right; padding-right: 25px;'><h3 style='padding: 5px 35px; color: #31424d'>BACK</h3></div></a>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include_once('footer_page.php');
?>