<?php
$menu_id = "admin";
$page_title = "Listen to Audio Sermons";
include_once('header_page.php');
include_once('util/form_util_inc.php');
include_once('messagebox_inc.php');

$field = new Field();
$field->define_field('title');
$field->define_field('series');
$field->define_field('speaker');
$field->define_field('s_text');
$field->define_field('sermon_date');
$field->define_field('cover-photo');
$field->define_field('sermon');

$error = 0;

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$field->error_empty('title', 'Please input sermon title.', $error);
	$field->error_empty('series', 'Please input sermon series.', $error);
	$field->error_empty('speaker', 'Please input sermon series.', $error);
	$field->error_empty('s_text', 'Please input bible passage where sermon is based from.', $error);
	if(empty($_FILES['cover-photo']['name']))
	{
		$field->field['cover-photo']['error_msg'] = "Please select cover photo to upload";
		$error = 1;
	}
	else
	{
		if ($_FILES['cover-photo']['size'] > 12000 )
		{
			$field->field['cover-photo']['error_msg'] = "File too large.";
			$error = 1;
		}
		else if(!$img_handle = fopen($_FILES['cover-photo']['name'], "r"))
		{
			$field->field['cover-photo']['error_msg'] = "Error opening file.";
			$error = 1;
		}
		else if(!$sermon_img = fread($img_handle, filesize($_FILES['userFile']['name'])))
		{
			$field->field['cover-photo']['error_msg'] = "Error reading file.";
			$error = 1;
		}	
	}
	if(!file_exists($_FILES['sermon-audio']['name']) || !is_uploaded_file($_FILES['sermon-audio']['name']))
	{
		$field->field['sermon-audio']['error_msg'] = "Please select audio sermon to upload";
		$error = 1;
	}
	else
	{
		if ($_FILES['sermon-audio']['size'] > 4000 )
		{
			$field->field['sermon-audio']['error_msg'] = "File too large.";
			$error = 1;
		}
		else if(!$audio_handle = fopen ($_FILES['sermon-audio']['name'], "r"))
		{
			$field->field['sermon-audio']['error_msg'] = "Error opening file.";
			$error = 1;
		}
		else if(!$sermon_audio = fread ($audio_handle, filesize($_FILES['userFile']['name'])))
		{
			$field->field['sermon-audio']['error_msg'] = "Error reading file.";
			$error = 1;
		}	
	}
	$field->error_empty('sermon', 'Please select audio sermon to upload.', $error);
	if(!$field->error_empty('sermon_date', 'Please select date.', $error))
		$field->error_date('sermon_date', 'Sorry, wrong date format', $error);
	if(!is_null($field->value('sermon_date')))
		$field->error_condition('sermon_date', date('Y-m-d', strtotime($field->field['sermon_date']['value'])) > date('Y-m-d', strtotime("now")), "Sermon date cannot be after current date.", $error);
	
	if(!$error)
	{
		fclose ($img_handle);
		fclose($audio_handle);
		// Commit image to the database
		$sermon_img = mysql_real_escape_string($sermon_img);
		$sermon_audio = mysql_real_escape_string($sermon_audio);
		$query = "INSERT INTO sermon (title, series, speaker, date, scripture, picture, sermon)
							VALUES ($field->value('title'), $field->value('series'), $field->value('speaker'), $field->value('date'), $field->value('scripture'),$sermon_img, $sermon_audio)";
		echo $query;exit;
	}
}

$result = dbc_query_all("SELECT DISTINCT series FROM sermon");
$series_list = array();
$series = '["';
foreach($result as $value)
{
	$series_list[] = $value['series'];
}
$series .= implode('","', $series_list) .'"]';
?>
<style>
	.upload_form label{
		width: 100px;
	}
	dl{
		margin:0px auto;
	}
	dt{
	    float: left;
	    clear: left;
	    width: 120px;
	    height: 50px;
	    text-align: right;
	    font-weight: bold;
	}
	dd{
	    margin: 3px 0 3px 50px;
	}
</style>

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.1/jquery-ui.js"></script>
<script>
	var $jq = jQuery.noConflict();
	
	//display datepicker
	$jq(function(){
    	$jq( "#datepicker" ).datepicker();
  	});
  	
	//autocomplete textbox
  	$jq(function() {
	    var availableTags = <?php echo $series; ?> ;
	    $jq( "#series" ).autocomplete({
	      source: availableTags
	    });
  	});
	
  	function check_file(f_type){
  		var err = 0;
  		if(f_type == 'image')
  		{
	        str=document.getElementById('coverfileToUpload').value;
        	if(str.toLowerCase().indexOf(".jpg", str.length - 4) == -1 && str.toLowerCase().indexOf(".jpeg", str.length - 5) == -1 &&
        		str.toLowerCase().indexOf(".png", str.length - 4) == -1 && str.toLowerCase().indexOf(".gif", str.length - 4) == -1)
        			err = 1;
	   }
	   else if(f_type == 'sermon')
	   {
	   		str=document.getElementById('sermonfileToUpload').value;
        	if(str.toLowerCase().indexOf(".mp3", str.length - 4) == -1 && str.toLowerCase().indexOf(".wav", str.length - 4) == -1 &&
        		str.toLowerCase().indexOf(".vlc", str.length - 4) == -1 && str.toLowerCase().indexOf(".wma", str.length - 4) == -1)
        			err = 1;
	   }
        if(err)
        {
	        if(f_type == 'image')
	        {
	        	msg = "File type not allowed.\nAllowed file: *.jpg, *.jpeg, *.png, *.gif";
		       	popup(msg);
	            document.getElementById('coverfileToUpload').value='';
           	}
           	else
           	{
           		msg = "File type not allowed.\nAllowed file: *.mp3, *.wav, *.vlc, *.wma";
		       	popup(msg);
	            document.getElementById('sermonfileToUpload').value='';
           	}
        }
    }
</script>
<div style="background: url('images/BannerPodcast.jpg') no-repeat; height: 150px; opacity: 1"></div>
<div class="page_wrapper">
	<div class="upload_box">
		<h1>Upload Sermon</h1>
		<br />
		<form id = "upload_form" class="upload_form" name="upload_form" method="post" action="sermon.php" enctype="multipart/form-data">
			<dl>
				<dt>
					<label for='series'>Series:</label>
				</dt>
				<dd>
					<input type="checkbox" id="new_series" name="new_series" value="1" /> <font size="2px">New Series?</font>
					<br />
					<input id="series" name='series' class="ui-autocomplete-input" autocomplete="off" placeholder='AutoSeries'"  value="<?php echo $field->value('series');?>"/>
				</dd><span id='error-msg'><?php echo $field->error_msg('series');?></span>
			</dl>
			<dl>
				<dt>
					<label for='title'>Title:</label>
				</dt>
				<dd>
					<input type='text' id= 'title' name='title' placeholder='Sermon Title' maxlength='45' value="<?php echo $field->value('title');?>"/>
				</dd><span id='error-msg'><?php echo $field->error_msg('title');?></span>
			</dl>
			<dl>
				<dt>
					<label for='speaker'>Speaker:</label>
				</dt>
				<dd>
					<input type='text' id= 'speaker' name='speaker' placeholder='Speaker' maxlength='45' value="<?php echo $field->value('speaker');?>"/>
				</dd><span id='error-msg'><?php echo $field->error_msg('speaker');?></span>
			</dl>
			<dl>
				<dt>
					<label for='s_text'>Text:</label>
				</dt>
				<dd>
					<input type='text' id= 's_text' name='s_text' placeholder='Bible Verse' maxlength='45' value="<?php echo $field->value('s_text');?>"/>
				</dd><span id='error-msg'><?php echo $field->error_msg('s_text');?></span>
			</dl>
			<dl>
				<dt>
					<label for='date'>Date:</label>
				</dt>
				<dd>
					<input type='text' id='datepicker' name='sermon_date' placeholder='Date' maxlength='45' value="<?php echo $field->value('speaker');?>"/>
				</dd><span id='error-msg'><?php echo $field->error_msg('sermon_date');?></span>
			</dl>
			<dl>
				<dt>
					<label for='c_photo'>Cover Photo:</label>
				</dt>
				<dd>
					<input type="hidden" name="max_size" value="5000" />
					<input type="file" id="coverfileToUpload" name="cover-photo" size="50" accept="image/*" onchange="check_file('image');" /><br />
					<font size="1px" color="#FF7D4C">Supported file types: jpg, jpeg, gif, png (max 3mb)</font>
				</dd><span id='error-msg'><?php echo $field->error_msg('cover-photo');?></span>
			</dl>
			
			<dl>
				<dt>
					<label for='title'>Audio Sermon:</label>
				</dt>
				<dd>
					<input type="hidden" name="max_size" value="5000" />
					<input type="file" id="sermonfileToUpload" name="sermon-audio" size="50" accept="audio/*" onchange="check_file('sermon');" /><br />
					<font size="1px" color="#FF7D4C">Supported file types: mp3, wav, vlc, wma (max 5mb)</font>
				</dd><span id='error-msg'><?php echo $field->error_msg('sermon-audio');?></span>
			</dl>
			<dl>
				<dd>
					<input id="button" name='upload' type="submit" value=" UPLOAD "/>
				</dd>
			</dl>
		</form>
	</div>
</div>

<?php
include_once('footer_page.php');
?>