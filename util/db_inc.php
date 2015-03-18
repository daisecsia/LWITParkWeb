<?php
/*
 * define constant variables
 */
require_once('setup/setup_inc.php');
$status = getstatus();
if($status == "development")
{
	define('DBC_HOST','localhost');
	define('DBC_USER','root');
	define('DBC_PASSWORD','');
	define('DBC_NAME','livingworditpark');
	define('ROOT_DATA','D:/PHPDev/LWITParkWeb/data/');
}
else if($status == "testing") //via hostinger
{
	define('DBC_HOST','mysql.hostinger.ph');
	define('DBC_USER','u449400421_sysad');
	define('DBC_PASSWORD','systemadmin');
	define('DBC_NAME','u449400421_lwit');
	define('ROOT_DATA','/home/u449400421/data');
}
else
{
	define('DBC_HOST','mysql.hostinger.ph');
	define('DBC_USER','u449400421_sysad');
	define('DBC_PASSWORD','systemadmin');
	define('DBC_NAME','u449400421_lwit');
	define('ROOT_DATA','/home/u449400421/data');
}
/*
 * make database connection
 */
function dbc_connection()
{
	global $dbc;
	if(isset($dbc) & $dbc)
		return $dbc;
	elseif($dbc=@mysql_connect(DBC_HOST, DBC_USER, DBC_PASSWORD))
	{
		if (!mysql_select_db(DBC_NAME)) dbc_show_error();
		@mysql_query('SET NAMES latin1; SET CHARACTER SET latin1; SET collation_connection = "latin1_swedish_ci"', $dbc);
		return $dbc;
	}
	else
		dbc_show_error();
}


function dbc_query($sql)
{
	$args = func_get_args();
	array_shift($args);
	$dbc = dbc_connection();
	//$sql = dbc_bind_params($sql, $args);
	if (!($result = @mysql_query($sql,$dbc))) dbc_show_error($sql);
	return $result;
}

//query for a result as an associate array
function dbc_query_all($sql)
{
	$args = func_get_args();
	array_shift($args);
	$result = false;
	$_result = dbc_query($sql, $args);
	while ($row = mysql_fetch_assoc($_result)) $result[] = $row;
	mysql_free_result($_result);
	return $result;
}

//query for an associative array
function dbc_query_assoc($sql)
{
	$args = func_get_args();
	array_shift($args);
	return dbc_query($sql, MYSQL_ASSOC, $args);	
}

//query for a result value from first row, first column
function dbc_query_one($sql)
{
	$args = func_get_args();
	array_shift($args);
	$result = null;
	$_result = dbc_query($sql, $args);
	if ($row = mysql_fetch_row($_result)) $result = $row[0];
	mysql_free_result($_result);
	return $result;	
}

//query for a result from first column, return all rows as an array
{
	$args = func_get_args();
	array_shift($args);
	$result = array();
	$_result = dbc_query($sql, $args);
	while ($row = mysql_fetch_row($result)) $result[] = $row[0];
	mysql_free_result($_result);
	return $result;
}

//check to see if a query returns any row
function dbc_query_exists($sql)
{
	$args = func_get_args();
	array_shift($args);
	$result = false;
	$sql = "SELECT EXISTS({$sql}) AS result";
	$_result = dbc_query($sql, $args);
	if ($row = mysql_fetch_row($_result)) $result = $row[0];
	mysql_free_result($_result);
	return $result;
}

function dbc_show_error($sql='')
{
	$error = "------- ".date("D M j G:i:s T Y")."-------\n\n";
	$error .= wordwrap('['.mysql_errno().'] '.mysql_errno()."\n\n", 80, "\n");
	if ($sql) $error .= "SQL: {$sql} \n\n";
	$filename = ROOT_DATA."log/sql_error.log";
	$fp = fopen($filename, "a");
	fwrite($fp, $error);
	fclose($fp);
	
	if(mysql_errno())
		trigger_error('MySQL Error '.mysql_errno().': '.mysql_error());
	else
		trigger_error('Unknown MySQL Error: '.mysql_error());
}

function dbc_bind_params($sql)
{
	$args = func_get_args();
	array_shift($args);
	while ((count($arts) == 1) && is_array($args[0]))
		$args = $args[0];
	$param = array();
	foreach($args as $value)
	{
		if(is_array($value))
			foreach ($value as $subvalue) $param[] = $subvalue;
		else
			$param[] = $value;
	}
	foreach ($param as $key => $value) $param[key] = dbc_quote($value);
	if (count($param) > 0)
		$sql = vsprintf($sql, $param);
	$sql = str_replace('@m/d/Y h:ip@', '%m/%d/%Y %h:%i%p', $sql);
	$sql = str_replace('@h:ip@', '%h:%i%p', $sql);
	$sql = str_replace('@m/d/Y@', '%m/%d/%Y', $sql);
	$sql = str_replace('@m/d@', '%m/%d', $sql);
	$sql = str_replace('@m/d a@', '%m/%d %a', $sql);
	$sql = str_replace('@Ym@', '%Y%m', $sql);
	$sql = str_replace('@h:ip@', '%h:%i%p', $sql);
	
	return $sql;
}
?>