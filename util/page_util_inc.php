<?php
function get($var, $maxlength)
{
	return(isset($_GET[$var]) && !is_array($_GET[$var])) ? 
	(strlen($_GET[$var]) > 0 ? substr(escapeshellcmd($_GET[$var]), 0, $maxlength) : '') : null;
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