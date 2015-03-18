<?php
require_once('page_util_inc.php');
/**
 * 
 */
class Field
{
	var $field;
	function Field()
	{
		$this->field = array();
		$this->error_anchor = null;
		$this->error_field = null;
		$this->error = 0;
	}
	
	function define_field($field, $default='')
	{
		$this->field[$field] = array
		(
			'error_msg'=>'',
			'value'=>$default
		);
	}
	
	function value($pointer, $htmlentities = true)
	{
		if(!isset($this->field[$pointer])) return '';
		if($htmlentities)
			$result = htmlentities($this->field[$pointer]['value'], ENT_QUOTES, "ISO-8859-1");
		else
			$result = $this->field[$pointer]['value'];

		return $result;
	}
	
	function default_value($pointer, $value)
	{
		if($this->is_Field_Date($pointer) && ($value instanceof Field_Date))
			$this->field[$pointer]['value'] = $value;
		elseif($this->is_Field_Date($pointer))
			$this->field[$pointer]['value']->set_from_user($value);
		else
			$this->field[$pointer]['value'] = $value;
	}
	
	function is_Field_Date($pointer)
	{
		return ($this->field[$pointer]['value'] instanceof Field_Date);
	}
	
	function error_msg($pointer)
	{
		if(!isset($this->field[$pointer])) return null;
		return $this->field[$pointer]['error_msg'];
	}
	
	function error_condition($pointer, $condition, $message, &$error = NULL)
	{
		if(!isset($_POST[$pointer])) return false;
		if($condition)
		{
			$this->field[$pointer]['error_msg'] = $message;
			$error = true;
			return true;
		}
		else return false;
	}
	
	function error_checkbox($pointer, $messag, &$error = NULL)
	{
		if(!isset($_POST[$pointer]))
		{
			$this->field[$pointer]['error_msg'] = $message;
			$error = true;
			return true;
		}
		else
		{
			$this->field[$pointer]['value'] = $_POST[$pointer];
			return false;
		}
	}
	
	function error_empty($pointer, $message, &$error = NULL)
	{
		if(!isset($_POST[$pointer])) return false;
		
		$empty = empty($_POST[$pointer]);
		if($empty)
		{
			$this->field[$pointer]['error_msg'] = $message;
			$error = true;
			return true;
		}
		else
			$this->field[$pointer]['value'] = $_POST[$pointer];
		
		return false;
	}
	
	function error_date($pointer, $error_msg, &$error = NULL)
	{
		if(!isset($this->field[$pointer]['value'])) return false;
		if(is_null($this->field[$pointer]['value']) && !empty($this->field[$pointer]['value']->input))
		{
			$this->field[$pointer]['error_msg'] = $error_msg;
			$error = true;
			$this->error_anchor($pointer);
			return true;
		}
		else return false;
	}
	
	function error_datetime($pointer, $error_msg, &$error = NULL)
	{
		if(!isset($this->field[$pointer]['value'])) return false;
		if(is_null($this->field[$pointer]['value']) && !empty($this->field[$pointer]['value']->input))
		{
			$this->field[$pointer]['error_msg'] = $error_msg;
			$error = true;
			$this->error_anchor($pointer);
			return true;
		}
		else return false;
	}
	
	function error_phone($pointer, $message, &$error = NULL)
	{
		if(!isset($_POST[$pointer])) return false;
		$this->field[$pointer]['value'] = trim($_POST[$pointer]);
		$phone = str_replace(array('+','(',')','-','.','/'), '', $this->field[$pointer]['value']);
		if(!preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/", $phone) && 
			!(strlen($phone) == 7 || (substr($phone, 0,2)=='63'? strlen($phone) == 12 : strlen($phone) == 11)))
		{//"?\+63?[\s-]?\(?(\d{3})\)?[\s-]?\d{3}[\s-]?\d{4}";
			$this->field[$pointer]['error_msg'] = $message;
			$error = true;
			return true;
		}
	}
	
	function error_email($pointer, $message, &$error = NULL)
	{
		if(!isset($_POST[$pointer])) return false;
		$this->field[$pointer]['value'] = trim($_POST[$pointer]);
		if(!empty($this->field[$pointer]['value']) &&
		   !preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/i", $this->field[$pointer]['value']))
		{
			$this->field[$pointer]['error_msg'] = $message;
			$error = true;
			return true;	
		}
		else return false;
	}
	
	function error_password($pointer, $message, &$error = NULL)
	{
		if(!isset($_POST[$pointer])) return false;
		$this->field[$pointer]['value'] = trim($_POST[$pointer]);
		$pwd = $this->field[$pointer]['value'];
		/* password condition:
		 * - must contain digit from 1-9
		 * - must contain one lowercase
		 * - must contain one uppercase
		 * - must contain one special symbol in the list @#$%_!
		 * - length must be 6-8
		 *///mkYOn12$
		
		if(!preg_match("((?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@#$%_!]).{6,8})",$this->field[$pointer]['value']))
		{
			$this->field[$pointer]['error_msg'] = $message;
			$error = true;
			return true;
		}
	}
	
	function error_int($pointer, $message=null)
	{
		if(!isset($_POST[$pointer])) return false;
		$this->field[$pointer]['value'] = trim($_POST[$pointer]);
		$num = $this->field[$pointer]['value'];
		
		if(!preg_match("/^[0-9]*$/", $num))
		{
			$this->field[$pointer]['error_msg'] = $message;
			$error = true;
			return true;
		}
	}
	
	function is_exist($pointer, $table, $column, $message, &$error = NULL)
	{
		if(!isset($_POST[$pointer])) return false;
		$this->field[$pointer]['value'] = trim($_POST[$pointer]);
		$exist = dbc_query_exists("SELECT {$column} FROM {$table} WHERE {$column}= '{$this->field[$pointer]['value']}'");
		if(!empty($this->field[$pointer]['value']) && $exist)
		{
			$this->field[$pointer]['error_msg'] = $message;
			$error = true;
			return true;
		}
		else return false;
	}
	
	function initialize_field($pointer, $value='')
	{
		$this->field[$pointer]['value'] = $value;
	}
	
	function error_anchor($pointer)
	{
		if (!$this->error_anchor) $this->error_anchor = $pointer;
		if (!$this->error_field) $this->error_field = $pointer;
		$this->error = true;
	}
	
	function post_value($i="")
	{
		foreach($this->field as $pointer=>$value)
		{
			if($this->is_Field_Date($pointer))
			{
				$post = post($pointer.$i, $this->field[$pointer]['max_length']);
				$this->field[$pointer]['value']->set_from_user($post);
			}
			else
			{
				$this->field[$pointer]['value'] = post($pointer.$i, $this->field[$pointer]['max_length']);
				if($this->field[$pointer]['format'] == '%f')
					$this->field[$pointer]['value'] = strip_chars($this->field[$pointer]['value'], '$,');
			}
		}
	}
	
}
?>