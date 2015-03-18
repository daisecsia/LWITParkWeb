<?php
function get($var, $maxlength)
{
	return(isset($_GET[$var]) && !is_array($_GET[$var])) ? 
	(strlen($_GET[$var]) > 0 ? substr(escapeshellcmd($_GET[$var]), 0, $maxlength) : '') : null;
}

function post($var, $maxlength = 0)
{
	if($maxlength <=0)
		return (isset($_POST[$var])) ? $_POST[$var] : null;
	else
		return (isset($_POST[$var])) ? substr($_POST[$var], 0, $maxlength) : null;
}

function strip_chars($string, $chars)
{
	preg_match_all("(.)", $chars, $tmp_clean);
	return (str_replace($tmp_clean[0], array_fill(0, count($tmp_clean), ""), $string));
}

function page_lookup($table, $column, $filter=null)
{
	$sql = "SELECT DISTINCT $column FROM $table ";
	if($filter)
		$sql .= $filter;
	dbc_query_all($sql);
}

function redirect($page)
{
	header("location: $page");
}
?>