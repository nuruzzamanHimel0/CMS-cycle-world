
<?php
	$errors=array();
	
	function fieldname_as_text($fieldname)
	{
		$fieldname = str_replace("_"," ",$fieldname);
		$fieldname=ucfirst($fieldname);
		return $fieldname;
	}
	
	function validate_presence($required_fields)
	{
		global $errors;
		foreach($required_fields as $require)
		{
			$values = $_POST["$require"];
			if(!has_presence($values))
			{
				$errors["$require"]	=fieldname_as_text($require)." Can't be blank";
			}
		}
		
	}
	function validate_max_length($field_with_max_length)
	{
		global $errors;
		foreach($field_with_max_length as $field => $max)
		{
			$value = $_POST[$field];
			if(!has_max_length($value,$max))
			{
				$errors[$field]=fieldname_as_text($field)." is TOO long .";
			}
		}
	}
	
	
	function has_presence($value)
	{ return isset($value) && !empty($value);
	}
	
	
	function has_max_length($value,$max)
	{
	return strlen($value)<$max ;
	}
	
	// display errors in page.......................

		function form_errors($error)
		{	
			$output = "";
			if(!empty($error))
			{
					$output ="<div>";
					$output .="Please Fixed the Following Errors......";
					$output .="<ol >"	;
					foreach($error as $errors)
					{
						$output .="<li>";	
						$output .=htmlentities($errors);
						$output .="</li>";
					}
					$output .="</ol>";
					$output .="</div>";
					
					return $output;
					
			}
			
		}
?>
