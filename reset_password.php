<?php
$page_title = "Login";
include_once('header_page.php');
include_once('util/form_util_inc.php');
include_once('util/page_util_inc.php');

$field = new Field();
$field->define_field('email','');

if($_SERVER['REQUEST_METHOD']=='POST')
{
	$error=0;
	if(!$field->error_empty('email', 'Please provide email address.'))
	{
		$result = dbc_query_all("SELECT email_ad FROM user WHERE email_ad='{$field->value('email')}' AND access_right != 0");
		if(!$result)
		{
			$field->error_condition('email',true, 'Invalid email.');
		}
	}
	if(!$error)
	{
		$field->post_value();
		$username = dbc_query_one("SELECT username FROM username WHERE email_ad='{$field->value('email')}' AND access_right != 0");
		$gen_password = generate_random_string();
		$password = crypt($gen_password, '$2a$15$Ku2hb./9aA71tPo/E015h.$');
		$query .= sprintf("UPDATE user SET password=%s WHERE email_ad=%s",$password, $field->value('email'));
		if(dbc_query($query))
			$user_save=1;
		if($user_save)
		{
			$result_msg = "your password has been reset. Check your email for your new password.";
			echo "<script>
						popup('$result_msg');
				  </script>";
			
			include_once('util/mail_util_inc.php');
			$body = form_content($field->value('email'), $username, $gen_password);
			send_mail($field->value('u_email'), $field->value('fname')." ".$field->value('lname'), $body);
		}
		redirect('index.php');
	}
}

?>
<style>
	.signup_box{
		width: 500px;
		margin: 5px auto;
		padding-bottom: 3px;
	}
	p.log_text{
		margin: 10px 12px; 
		font-size: 12px; 
		color: white;
	}
	dl, dt, dd{
		float: left;
	}
</style>
<div class="page_wrapper">
	<div class="form_wrapper">
		<div class="signup_box">
			<legend style="padding: 3px 15px; text-decoration: underline;">RESET PASSWORD</legend>
			<p class="log_text">Please supply the email you provided when you registered. Your new password will be sent to your email address.</p>	
				<form class="signup_form" name="reset_form" method="post">
					<dl style="margin-top: 20px;">
						<dt>
							<label for='email'>Email Add:</label>
						</dt>
						<dd>
							<input type='text' id= 'email' name='email' placeholder='Email Address' maxlength='15' value="<?php echo $field->value('email');?>"/>
						</dd><span id='error-msg'><?php echo $field->error_msg('email');?></span>
					</dl>
					<dl>
						<dd>
							<div style="float: left;"><input name='reset' type="submit" value=" Reset "/></div></div>
						</dd>
						
					</dl>
				</form>
			</div>
		</div>
	</div>
</div>
<?php
function generate_random_string($length = 5) {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}

function form_content($email, $username, $password)
{
	$content = "<div style='background: #c1ddf1;
		padding: 5px;
		overflow: hidden;
		margin: 10px auto;'>
	<img src=\"cid:lit_logo\" />
	<br />
	<p style = 'font-family: Tahoma, Calibri;
		font-size: 12px;
		color: #333333;'>Hi $username!</p>
	<h3 style='font-family: Tahoma, Calibri;
		font-size: 15px;
		color: #333333;'>Password Reset Successful!</h3>
	<p style = 'font-family: Georgia;
				font-size: 11px;
				color: #333333;
				text-decoration: italic;
				text-align: center;
				padding: 0px 20px;'>Your new password is: $password.</p>
	<p style = 'font-family: Tahoma, Calibri;
		font-size: 12px;
		color: #333333;'>To change your password, click <a href='www.livingworditpark.com/change_password.php'>here.</a><br />
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