<?php
	function TextLogger($msg)
	{
	   // open file
	  $fd = fopen('D:/PHPDev/livingworditpark/log/logger.txt', "a");
	  // append date/time to message
	  $str = "[" . date("Y/m/d h:m:s", mktime()) . "] " . $msg;
	  //file_put_contents("D:/PHPDev/WebEmulator/log/logger.txt", "");
	  // write string
	  fwrite($fd, "\n" . $str);
	  // close file
	  fclose($fd);
	}
?>