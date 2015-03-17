<?php
$page_title = "Login";
include_once('header_page.php');
include_once('util/form_util_inc.php');
include_once('util/page_util_inc.php');

$loginfield = new Field();
$loginfield->define_field('username','');
$loginfield->define_field('password','');

if($_SERVER['REQUEST_METHOD']=='POST')
{
	$error=0;
	if(!$loginfield->error_empty('username', 'Please provide username.'))
	{
		$result = dbc_query_all("SELECT username FROM user WHERE username='{$loginfield->value('username')}' AND access_right != 0");
		if(!$result)
		{
			$loginfield->error_condition('username',true, 'Invalid username.');
		}
	}
	if(!$loginfield->error_empty('password', 'Please provide password.'))
	{
		$result = dbc_query_all("SELECT username, password FROM user WHERE username = '{$loginfield->value('username')}' AND access_right != 0");
		$match = 0;
		
		foreach($result as $user)
		{
			$currentPassword = $user['password'];
			if(crypt($loginfield->value('password'), '$2a$15$Ku2hb./9aA71tPo/E015h.$') === $currentPassword)
			{
				$match = 1;
				break;
			}
		}
		$loginfield->error_condition('password',!$match, 'Incorrect password.', $error);
	}
	if(!$error)
	{
		$password = crypt($loginfield->value('password'), '$2a$15$Ku2hb./9aA71tPo/E015h.$');
		session_start();
		$user_info = dbc_query_all("SELECT * FROM user WHERE username = '{$loginfield->value('username')}' and password = '{$password}'");
		$_SESSION['login'] = 1;
		$_SESSION['login_user'] = $user_info[0]['username'];
		$_SESSION['access_right'] = $user_info[0]['access_right'];
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
			<legend style="padding: 3px 15px; text-decoration: underline;">LOGIN</legend>
			<p class="log_text">all information provided will be treated with utmost confidentiality and will only be used for church purposes</p>	
				<form class="signup_form" name="login_form" method="post">
					<dl style="margin-top: 20px;">
						<dt>
							<label for='username'>Username:</label>
						</dt>
						<dd>
							<input type='text' id= 'username' name='username' placeholder='Username' maxlength='15' value="<?php echo $loginfield->value('username');?>"/>
						</dd><span id='error-msg'><?php echo $loginfield->error_msg('username');?></span>
					</dl>
					<dl>
						<dt>
							<label for='password'>Password:</label>
						</dt>
						<dd>
							<input type='password' id= 'password' name='password' placeholder='Password' maxlength='10' value="<?php echo  $loginfield->value('password');?>"/>
						</dd><span id='error-msg'><?php echo $loginfield->error_msg('password');?></span>
					</dl>
					<dl>
						<dd>
							<div>
								<div style="float: left;"><input name='signup' type="submit" value=" Submit "/></div>
								<div style="float: left;"><a href="" ><p class="log_text" style="margin-left: 3px; font-size: 14px;">Reset Password</p></a></div>
							</div>
						</dd>
						
					</dl>
				</form>
			</div>
		</div>
	</div>
</div>