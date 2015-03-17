<?php
$menu_id = "home";
$page_title = "Home";

include_once('util/page_util_inc.php');
$logout = get('logout',1);

if($logout)
{
	session_start();
	if(session_destroy())
		redirect('index.php');
}


include_once('header_page.php');
include_once('index_content.php');
include_once('footer_page.php');
?>