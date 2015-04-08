<?php
$menu_id = "admin";
$page_title = "Listen to Audio Sermons";
include_once('header_page.php');
include_once('util/form_util_inc.php');

$limit = 12;
$page_no = get('page', 10)=='' ? 0: get('page',10) ;
$order_by = get('sort_by',10)=='' ? 'date' : get('sort_by',10);
$start = $page_no * $limit;

$field = new field;
$field->define_field('sort_by');

if($_SERVER['REQUEST_METHOD']=='POST')
{
	$field->post_value();
}
if($order_by == 'date')
	$order_by_clause = "{$order_by} DESC ";
else
	$order_by_clause = "{$order_by} ASC ";

?>
<div style="background: url('images/page_banner/BannerPodcast.jpg') no-repeat; background-size: 100%; height: 200px; opacity: 1"></div>
<div class="page_wrapper">
	<h3 style="font-size: 1.5em; padding-bottom: 10px;">Latest Sermon</h3>
	<div style="width: 500px; margin: 0px auto;">
		<div style="padding: 7px; width: 500px;">
			<?php
				$result = dbc_query_all("SELECT title, speaker,  DATE_FORMAT(date, '%M %d, %Y') AS date, scripture, picture, sermon FROM sermon ORDER BY date DESC LIMIT 1");
				foreach($result as $sermon)
			?>
			<img src=<?php echo $sermon['picture']; ?> width="300px" height="300px">
			<audio controls>
				<source src="<?php echo $sermon['sermon'] ?>" type="audio/ogg" />
				<source src="<?php echo $sermon['sermon']; ?>" type="audio/mpeg">
				Your browser does not support this audio.
			</audio>
			<a href=<?php echo $sermon['sermon'] ?> download><img src="images/resources/download.png" width="30px" height="30px" /></a>
		</div>
		<div style="overflow: hidden; padding-bottom: 10px;">
			<div style="font-size: 16px;">
				<?php echo $sermon['title']; ?>
			</div>
			<div style="float: left; display: inline; font-size: 12px;">
				<p><?php echo $sermon['scripture'] ." / " .$sermon['speaker']; ?></p>
				<p><?php echo $sermon['date']; ?></p>
			</div>
		</div>
	</div>
	<div style="width: 100%; float: left;">
		<div class='spacer'>
			<div style="float: left;"><h3 style="font-size: 1.25em;">All Sermons</h3></div>
			<div id="subscription" class="list_filter">
				<form href="sermon_download.php" method="post">
					<dl>
						<label for="sort_by">Sort by:</label>
						<select name="sort_by" id="sort_by" size="1">
							<option value="date" <?php echo $field->value('sort_by')=='date' ? 'selected' : ''; ?>>Date</option>
							<option value="speaker" <?php echo $field->value('sort_by')=='speaker' ? 'selected' : ''; ?>>Speaker</option>
							<option value="title" <?php echo $field->value('sort_by')=='title' ? 'selected' : ''; ?>>Sermon Title</option>
						</select>
						<input type="submit" id="subscribe" value="GO" />
					</dl>
				</form>
			</div>
		</div>
		<div style="color: #465e6e; font-size: 10px; margin: 10px; auto;">
			<?php
				$content ='';
				$result = dbc_query_all("SELECT sermon_id, series, title, speaker,  DATE_FORMAT(date, '%M %d, %Y') AS date, scripture, picture FROM sermon ORDER by {$order_by_clause} LIMIT {$start},{$limit}");
				foreach($result as $sermon)
				{
					$content .= "<ul id = 'sermon_container'>
									<li id = 'photo_container'><img id='sermon_photo' src=".$sermon['picture']." /></li>"
									."<br /><a class='sermon_title' href='view_sermon.php?page=$page_no&sermon=".$sermon['sermon_id']."'>{$sermon['title']}</a>"
									."<br />{$sermon['speaker']} / {$sermon['scripture']}"
									."<br />{$sermon['date']}"
								."</ul>";
				}
				echo $content;
			?>
		</div>
	</div>
	<div style="width: 150px; margin: 0px auto;">
		<?php
			if($page_no>0)
			{
				$prev_page = $page_no - 1; 
				echo "<a href='download_sermon.php?page=$prev_page&sort_by=$order_by'><div class='prev_sermon'></div></a>"; 
			}
		?>
		<?php 
			$count = dbc_query_one("SELECT count(*) FROM sermon");
			if($page_no < $count/$limit-1)
			{
				$next_page = ($page_no + 1);
				echo "<a href='download_sermon.php?page=$next_page&sort_by=$order_by'><div class='next_sermon'></div></a>";
			}
		?>
	</div>
</div>
<script>
	$(document).ready(function(){
		var highest = 0;
		//set the same height for all photos
		$("ul[id='sermon_container']").each(function(){
			$this = $(this);
			if($this.outerHeight() > highest)
				highest=$this.outerHeight();
		});
		$("ul[id='sermon_container']").each(function(){
			$this = $(this);
			$this.outerHeight(highest);
		});
	});
</script>
<?php
include_once('footer_page.php');
?>