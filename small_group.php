<?php
$menu_id = "involve";
$page_title = "Small Group";
include_once('header_page.php');
?>
<style>
	.sg{
		width: 900px;
		margin: 0px auto;
	}
	.sg_wrapper{
		margin: 15px auto;
	}
	.text{
		height: 150px;
	}
	.men, .women, .yp, .mix{
		padding: 5px;
		float: left;
		margin: 5px 15px;
		text-align: center;
		width: 380px;
		height: 180px;
	}
	
	.men{
		background: url('images/small_group/men_bkgrnd.png') no-repeat;
		color: #fff;
		padding-top: 100px;
	}
	
	.women{
		background: url('images/small_group/women_bkgrnd.png') no-repeat;
		color: #060606;
		padding-top: 130px;
	}
	.yp{
		background: url('images/small_group/yp_bkgrnd.png') no-repeat;
		color: #555555;
		padding-top: 25px;
		height: 285px;	
	}
	.mix{
		background: url('images/small_group/mix_bkgrnd.png') no-repeat;
		color: #565251;
		padding-top: 50px;
		height: 285px;	
	}
	/*
	.men{
		background: -webkit-linear-gradient(left, #7eb2e3 , rgba(255,0,0,0));
		background: -o-linear-gradient(right, #7eb2e3 , rgba(255,0,0,0)); 
		background: -moz-linear-gradient(right, #7eb2e3 , rgba(255,0,0,0));
		background: linear-gradient(to right, #7eb2e3 , rgba(255,0,0,0)); 
	}
	.women{
		background: -webkit-linear-gradient(left, #5185b7 , rgba(255,0,0,0)); 
		background: -o-linear-gradient(right, #5185b7 , rgba(255,0,0,0));
		background: -moz-linear-gradient(right, #5185b7 , rgba(255,0,0,0));
		background: linear-gradient(to right, #5185b7 , rgba(255,0,0,0));
	}
	.yp{
		background: -webkit-linear-gradient(left, #325577 , rgba(255,0,0,0));
		background: -o-linear-gradient(right, #325577 , rgba(255,0,0,0));
		background: -moz-linear-gradient(right, #325577 , rgba(255,0,0,0));
		background: linear-gradient(to right, #325577 , rgba(255,0,0,0)); 
	}
	.mix{
		background: -webkit-linear-gradient(left, #40505f , rgba(255,0,0,0));
		background: -o-linear-gradient(right, #40505f , rgba(255,0,0,0));
		background: -moz-linear-gradient(right, #40505f , rgba(255,0,0,0));
		background: linear-gradient(to right, #40505f , rgba(255,0,0,0));
	}*/
	
</style>

<?php
	$result = dbc_query_all("SELECT small_group_id, name, category,
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
								WHERE small_group_id != 'X'
								AND status = 'A'ORDER BY schedule_day ASC");

function showButton($sg)
{
	$button = "<div id='subscription' style='width: 100px; float: right; padding-right: 60px;'>
								<form  name='ministry_form' method='get' action='signup.php' style='border: none; outline: none; box-shadow: none;'>
									<input id='hidden_field' name='selected_sg' type='hidden' value='$sg' />
									<input id='hidden_field' name='signup_id' type='hidden' value='2' />
									<input id='subscribe' name='join_ministry' type='submit' value='JOIN' style='color: #fff; text-align: center; letter-spacing: 1px; width: 80px;' />
								</form>
							</div>";
	return $button;
}
?>
<div style="background: url('images/page_banner/BannerGetPluggedIn.png') no-repeat; background-size: 100%; height: 200px; opacity: 1"></div>
<div class="page_wrapper">
	<h1>SMALL GROUPS</h1>
	<div class = "sg">
		<div class = "sg_wrapper">
			<div class="men">
				<div class="text">
				<?php
					foreach ($result as $option)
					{
						$content="";
						if ($option['category'] == 'M')
							$content = $option['name']." (".$option['sg_day']." ".date("h:ia",strtotime($option['time_start']))."-".date("h:ia",strtotime($option['time_end'])).")";
						echo "<p>$content</p>";
					}
				?>
				</div>
				<?php
				echo showButton("M");
				?>
			</div>
			<div class="women">
				<div class="text" style="height: 120px;">
				<?php
					foreach ($result as $option)
					{
						$content="";
						if ($option['category'] == 'W')
							$content = $option['name']." (".$option['sg_day']." ".date("h:ia",strtotime($option['time_start']))."-".date("h:ia",strtotime($option['time_end'])).")";
						echo "<p>$content</p>";
					}
				?>
				</div>
				<?php
				echo showButton("W");
				?>
			</div>
		</div>
		<div class="sg_wrapper">
			<div id="yp" class="yp">
				<div class="text" style="height: 220px;">
				<?php
					foreach ($result as $option)
					{
						$content="";
						if (substr($option['category'],0,2) == 'YP')
							$content = $option['name']." (".$option['sg_day']." ".date("h:ia",strtotime($option['time_start']))."-".date("h:ia",strtotime($option['time_end'])).")";
						echo "<p>$content</p>";
					}
				?>
				</div>
				<?php
				echo showButton("YP");
				?>
			</div>
			<div class="mix">
				<div class="text" style="height: 190px;">
				<?php
					foreach ($result as $option)
					{
						$content="";
						if (substr($option['category'],0,2) == 'X')
							$content = $option['name']." (".$option['sg_day']." ".date("h:ia",strtotime($option['time_start']))."-".date("h:ia",strtotime($option['time_end'])).")";
						echo "<p>$content</p>";
					}
				?>
				</div>
				<?php
				echo showButton("X");
				?>
			</div>
		</div>
		
	</div>
</div>
<?php
include_once('footer_page.php');
?>