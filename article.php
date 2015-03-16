<?php
$menu_id = "resources";
$page_title = "Feature Article";
include_once('header_page.php');
$article_id = get('id',1);
if (!$article_id)
	$article_id = '0';
else
{
	$result = dbc_query_all("SELECT * FROM article WHERE article_id = $article_id");
	foreach($result as $article_result){}
	try
	{
		$article_content = file_get_contents('D:/PHPDev/livingworditpark/articles/'.str_replace("?", '', $article_result['title']).'.txt');
	}
	catch (Exception $e)
	{
	 	$article_content = '';
	}
}

function get_article()
{
	$result = dbc_query_all("SELECT * FROM article ORDER BY date DESC");
	foreach($result as $article_result){
		$article_list .= "<li class='list_text'><a href='article.php?id={$article_result['article_id']}'><span class='list_icon'></span>{$article_result['title']}</a></li>";
	}
	return $article_list;
}
?>
<div class="page_wrapper">
	<div style="overflow: hidden;">
		<div style="float: left; width: 320px; margin: 0px auto;overflow: hidden;">
			<?php

			if($article_id =='0' || $article_content == '')
				$side_bar = "<img src='images/article_2.png' height='100px' style='width: 320px; margin: 0px auto;' />
							<p style='font-family: Tahoma; letter-spacing: 0.25px; font-stretch: semi-expanded; font-size: 12px; font-style: italic; padding: 20px 5px; text-align: center; color: #FFFFFF; background: #31424d'>
								You therefore, beloved, since you know this beforehand, beware lest you also fall from your own steadfastness, being led away with the error of the wicked; but grow in the grace and knowledge of our Lord and Savior Jesus Christ. To Him be the glory both now and forever. Amen. <br />2 Peter 3:17-18
							</p>";
			else
				$side_bar ="<img class='feature_img' src='articles/image/{$article_result['article_id']}.jpg' align='right' alt='{$article_result['title']}' hspace='3px' vspace='3px' style='width: 320px; margin: 0px auto;' />";
			
			echo $side_bar
				."<div class='scroll' style='margin-top: 10px;'>
					<ul>"
    					.get_article()
    				."</ul>
				</div>";
			?>
		
		</div>
		<div style="float: left; width: 630px; color: #31424d; margin-left: 10px;">
			<div style="border-bottom: 1px solid #e2ddda; padding: 10px 5px;">
			<h3 style="font-size: 2.5em;">
				<?php echo $article_id !='0' ? ($article_content != '' ? $article_result['title'] : 'Article Missing' )  : 'Put Articles Here';?>
			</h3>
			</div>
			<div style="<?php echo $article_id !='0' && $article_content != '' ? 'border-bottom: 1px solid #e2ddda;' :''; ?> padding: 10px 5px; overflow: hidden; color: #dda685; font-size: 12px;">
				<div style="float: left; display: <?php echo $article_id =='0'? 'none' : 'inline' ?> ">
					<p><?php echo date("F d, Y", strtotime($article_result['date'])); ?></p>
				</div>
				<div style="float: right; display: <?php echo $article_id =='0'? 'none' : 'inline' ?>">
					<p>by: <?php echo $article_result['author'];?></p>
				</div>
			</div>
			<p style="padding: 10px 5px;">
				<?php
					if($article_id !='0')
					{
						$article = array();
						$a = explode('<br />', $article_content, -1);
						foreach($a as $article)
							echo "<p style='padding-top: 15px;'>". htmlentities($article, ENT_NOQUOTES, 'UTF-8')."</p>";
					}
					else
					{
						echo "<p>Article content here</p>";
					}
				?>
			</p>
		</div>
	</div>
</div>
<?php
include_once('footer_page.php');
?>