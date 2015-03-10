<?php
$menu_id = "admin";
$page_title = "Upload Audio Sermons and Small Group Materials";
include_once('header_page.php');
include_once('util/form_util_inc.php');

$upload_dir = "uploads/sermon/images/";
$sermon_dir = "uploads/sermon/audio/";
$note_dir = "uploads/sermon/notes/";
$leaderguide_dir = "uploads/sermon/leaderguide/";
		
$field = new Field();
$field->define_field('title');
$field->define_field('series');
$field->define_field('speaker');
$field->define_field('s_text');
$field->define_field('sermon_date');
$field->define_field('cover_photo');
$field->define_field('sermon');
$field->define_field('sermon_note');
$field->define_field('leaders_guide');

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
	dl{
		margin:0px auto;
	}
	dt{
	    float: left;
	    clear: left;
	    width: 120px;
	    height: 35px;
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
	   else if(f_type == 'notes')
	   {
	   		str=document.getElementById('notefileToUpload').value;
        	if(str.toLowerCase().indexOf(".doc", str.length - 4) == -1 && str.toLowerCase().indexOf(".docx", str.length - 4) == -1 &&
        		str.toLowerCase().indexOf(".pdf", str.length - 4) == -1)
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
           	else if(f_type == 'sermon')
           	{
           		msg = "File type not allowed.\nAllowed file: *.mp3, *.wav, *.vlc, *.wma";
		       	popup(msg);
	            document.getElementById('sermonfileToUpload').value='';
           	}
           	else
           	{
           		msg = "File type not allowed.\nAllowed file: *.doc, *.docx, *.pdf";
		       	popup(msg);
	            document.getElementById('notefileToUpload').value='';
           	}
        }
    }
</script>
<?php


if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	$error = 0;
	$count_to_upload = 2;
	$field->error_empty('title', 'Please input sermon title.', $error);
	$field->error_empty('series', 'Please input sermon series.', $error);
	$field->error_empty('speaker', 'Please input sermon series.', $error);
	$field->error_empty('s_text', 'Please input bible passage where sermon is based from.', $error);
	
	//check cover photo file
	if(empty($_FILES['cover_photo']['name']))
	{
		$field->field['cover_photo']['error_msg'] = "Please select cover photo to upload";
		$error = 1;
	}
	else
	{
		if ($_FILES['cover_photo']['size'] > 100000 ) //100KB
		{
			$field->field['cover_photo']['error_msg'] = "File too large.";
			$error = 1;
		}
		$photo_dir = $upload_dir . basename($_FILES["cover_photo"]["name"]);

		//$fileType = pathinfo($photo_dir,PATHINFO_EXTENSION);
		if (file_exists($photo_dir)) {
		    $field->field['cover_photo']['error_msg'] = "File already exists.";
			$error = 1;
		}
	}
	
	//check audio sermon file
	
	if(empty($_FILES['sermon_audio']['name']))
	{
		$field->field['sermon_audio']['error_msg'] = "Please select audio sermon to upload";
		$error = 1;
	}
	else
	{
		if ($_FILES['sermon_audio']['size'] > 5000000 ) //5MB
		{
			$field->field['sermon_audio']['error_msg'] = "File too large.";
			$error = 1;
		}
		$sermon_dir = $upload_dir . basename($_FILES["sermon_audio"]["name"]);

		if (file_exists($sermon_dir)) {
		    $field->field['sermon_audio']['error_msg'] = "File already exists.";
			$error = 1;
		}
	}
	
	//check sermon note file

	if(empty($_FILES['sermon_note']['name']) && !isset($_POST['no_notes']))
	{
		$field->field['sermon_note']['error_msg'] = "Please select sermon note to upload";
		$error = 1;
	}
	else if(!empty($_FILES['sermon_note']['name']))
	{
		if ($_FILES['sermon_note']['size'] > 500000 ) //500KB
		{
			$field->field['sermon_note']['error_msg'] = "File too large.";
			$error = 1;
		}
		$note_dir = $upload_dir . basename($_FILES["sermon_note"]["name"]);
		
		if (file_exists($note_dir)) {
		    $field->field['sermon_note']['error_msg'] = "File already exists.";
			$error = 1;
		}
		$count_to_upload +=1;
	}

	//check leader's guide file
	if(empty($_FILES['leaders_guide']['name']) && !isset($_POST['no_notes']))
	{
		$field->field['leaders_guide']['error_msg'] = "Please select sermon note to upload";
		$error = 1;
	}
	else if(!empty($_FILES['leaders_guide']['name']))
	{
		if ($_FILES['leaders_guide']['size'] > 500000 ) //500KB
		{
			$field->field['leaders_guide']['error_msg'] = "File too large.";
			$error = 1;
		}
		$leaderguide_dir = $upload_dir . basename($_FILES["leaders_guide"]["name"]);

		if (file_exists($leaderguide_dir)) {
		    $field->field['leaders_guide']['error_msg'] = "File already exists.";
			$error = 1;
		}
		$count_to_upload +=1;
	}
	
	if(!$field->error_empty('sermon_date', 'Please select date.', $error))
		$field->error_date('sermon_date', 'Sorry, wrong date format', $error);
	if(!is_null($field->value('sermon_date')))
		$field->error_condition('sermon_date', date('Y-m-d', strtotime($field->field['sermon_date']['value'])) > date('Y-m-d', strtotime("now")), "Sermon date cannot be after current date.", $error);
	
	if(!$error)
	{
		$photo_URL = mysql_real_escape_string($photo_dir);
		$sermon_URL = mysql_real_escape_string($sermon_dir);
		$note_URL = mysql_real_escape_string($note_dir);
		$guide_URL = mysql_real_escape_string($leaderguide_dir);

		$upload_flag = array();
		if (move_uploaded_file($_FILES["cover_photo"]["tmp_name"], $photo_dir))
        	$upload_flag[] = basename($_FILES["cover_photo"]["name"]);
	    if (move_uploaded_file($_FILES["sermon_audio"]["tmp_name"], $sermon_dir))
        	$upload_flag[] = basename($_FILES["sermon_audio"]["name"]);
        if (move_uploaded_file($_FILES["sermon_note"]["tmp_name"], $note_dir))
        	$upload_flag[] = basename($_FILES["sermon_note"]["name"]);
		if (move_uploaded_file($_FILES["leaders_guide"]["tmp_name"], $leaderguide_dir))
        	$upload_flag[] = basename($_FILES["leaders_guide"]["name"]);
		
		if(count($upload_flag) == $count_to_upload)
		{
			// Commit to the database
			$sermon_img = mysql_real_escape_string($sermon_img);
			$sermon_audio = mysql_real_escape_string($sermon_audio);
			$query = sprintf("INSERT INTO sermon (title, series, speaker, date, scripture, picture, sermon, sermon_notes, leader_guide)
						VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')",$field->value('title')
							  , $field->value('series')
							  , $field->value('speaker')
							  , date('Y-m-d', strtotime($field->value('sermon_date')))
							  , $field->value('s_text')
							  , $photo_URL
							  , $sermon_URL
							  , $note_URL
							  , $guide_URL);

			dbc_query($query);
			echo "<script>popup('Files uploaded successfully.');</script>";
			$field->default_value('title', '');
			$field->default_value('series', '');
			$field->default_value('speaker', '');
			$field->default_value('s_text', '');
			$field->default_value('sermon_date', '');
		}
		else
		{
			echo "<script>popup('Files not uploaded successfully.');</script>";
		}
	}
}
?>
<div style="background: url('images/BannerPodcast.jpg') no-repeat; height: 150px; opacity: 1"></div>
<div class="page_wrapper">
	<div class="upload_box">
		<h1>Upload Sermon</h1>
		<br />
		<form id = "upload_form" class="upload_form" name="upload_form" method="post" action="sermon.php" enctype="multipart/form-data">
			<div id = "upload_main_div">
				<div id = "upload_left_div">
					<dl>
						<dt style="height: 50px;">
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
							<input type='text' id='datepicker' name='sermon_date' placeholder='Date' maxlength='45' value="<?php echo $field->value('sermon_date');?>"/>
						</dd><span id='error-msg'><?php echo $field->error_msg('sermon_date');?></span>
					</dl>
				</div>
				<div id = "upload_right_div">
					<dl>
						<dt style="height: 60px;">
							<label for='c_photo'>Cover Photo:</label>
						</dt>
						<dd>
							<input type="file" id="coverfileToUpload" name="cover_photo" size="50" accept="image/*" onchange="check_file('image');" /><br />
							<font size="1px" color="#FF7D4C">Supported file types: jpg, jpeg, gif, png (max 100KB)</font>
						</dd><span id='error-msg'><?php echo $field->error_msg('cover_photo');?></span>
					</dl>
					<dl>
						<dt style="height: 60px;">
							<label for='title'>Audio Sermon:</label>
						</dt>
						<dd>
							<input type="file" id="sermonfileToUpload" name="sermon_audio" size="50" accept="audio/*" onchange="check_file('sermon');" /><br />
							<font size="1px" color="#FF7D4C">Supported file types: mp3, wav, vlc, wma (max 5mb)</font>
						</dd><span id='error-msg'><?php echo $field->error_msg('sermon_audio');?></span>
					</dl>
					<dl style="margin-top: 10px;">
						<dt style="height: 60px;">
							<label for='title'>Sermon Notes:</label>
						</dt>
						<dd>
							<input type="checkbox" name="no_notes" style=" transform: scale(1); -webkit-transform: scale(1);" /><font size="2px">No Sermon Note Available</font>
							<input type="file" id="notefileToUpload" name="sermon_note" size="50" accept=".doc,.pdf" onchange="check_file('notes');" /><br />
							<font size="1px" color="#FF7D4C">Supported file types: doc, pdf (max 500KB)</font>
						</dd><span id='error-msg'><?php echo $field->error_msg('sermon_note');?></span>
					</dl>
					<dl style="margin-top: 10px;">
						<dt style="height: 60px;">
							<label for='title'>Leader's Guide:</label>
						</dt>
						<dd>
							<input type="checkbox" name="no_guide" style=" transform: scale(1); -webkit-transform: scale(1);" /><font size="2px"> No Leader's Guide Available</font>
							<input type="file" id="leaders_guidefileToUpload" name="leaders_guide" size="50" accept=".doc,.pdf" onchange="check_file('notes');" /><br />
							<font size="1px" color="#FF7D4C">Supported file types: doc, pdf (max 500KB)</font>
						</dd><span id='error-msg'><?php echo $field->error_msg('leaders_guide');?></span>
					</dl>
				</div>
				<div style="float: right; margin: 20px; 30px;">
					<dl>
						<dd>
							<input id="button" name='upload' type="submit" value=" UPLOAD "/>
						</dd>
					</dl>
				</div>
			</div>
		</form>
	</div>
</div>

<?php
include_once('footer_page.php');
?>