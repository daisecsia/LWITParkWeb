<?php
$menu_id = "admin";
$page_title = "Listen to Audio Sermons";
include_once('header_page.php');
include_once('util/form_util_inc.php');

//$upload_dir = "uploads/sermon/images/";
//$sermon_dir = "uploads/sermon/audio/2015/2015.01.11-more-than-words.mp3";
//$note_dir = "uploads/sermon/notes/";
//$leaderguide_dir = "uploads/sermon/leaderguide/";
$page_no = get('page',10);
$sermon_id = get('sermon',11);
?>
<style>
	.series_title ul{
		font-weight: bold;
		color: gray;
		word-wrap: break-word;
	}
	.sermon_title ul{
		size: 1em;
		color: blue;
		padding: 0px 15px;
		word-wrap: break-word;
	}
</style>
<div style="background: url('images/page_banner/BannerPodcast.jpg') no-repeat; background-size: 100%; height: 200px; opacity: 1"></div>
<div class="page_wrapper">
	<div style="color: #31424d; margin: 0px; auto;">
		<div style="border-bottom: 1px solid #e2bbb7; padding: 10px 5px;">
			<?php
				$result = dbc_query_all("SELECT title, speaker,  DATE_FORMAT(date, '%M %d, %Y') AS date, scripture, picture, sermon FROM sermon WHERE sermon_id = {$sermon_id}");
				foreach($result as $sermon)
			?>
		<h3 style="font-size: 2.5em;">
			<?php
				echo $sermon['title'];
			?>
		</h3>
		</div>
		<div style="border-bottom: 1px solid #e2bbb7; padding: 10px 5px; overflow: hidden; color: #c43d23; font-size: 12px;">
			<div style="float: left; display: inline">
				<p><?php echo $sermon['date']; ?></p>
			</div>
			<div style="float: right; display: inline">
				<p><?php echo $sermon['speaker']; ?></p>
			</div>
		</div>
		<div style="padding: 7px; width: 500px;">
			<img src=<?php echo $sermon['picture']; ?> width="300px" height="300px">
			<audio controls>
				<source src="<?php echo $sermon['sermon'] ?>" type="audio/ogg" />
				<source src="<?php echo $sermon['sermon']; ?>" type="audio/mpeg">
				Your browser does not support this audio.
			</audio>
			<a href=<?php echo $sermon['sermon'] ?> download><img src="images/resources/download.png" width="30px" height="30px" /></a>
		</div>
		<div>
			<a href='download_sermon.php?page=<?php echo $page_no; ?>'><div class='prev_sermon' style="background-size: 30px 30px;"><h3 style="padding: 5px 35px; color: #31424d">BACK</h3></div></a>
		</div>
	</div>
</div>
<?php
include_once('footer_page.php');
?>