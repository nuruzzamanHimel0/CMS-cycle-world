<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>
<?php
	$password="pass";
	$hash_format="$2y$10$";
	$salt="Salt22CharactersOrMore";
	
	echo "String length : ".strlen($salt)."<br> <br>";
	
	$formate_and_salt = $hash_format.$salt;
	
	echo $hash = crypt($password,$formate_and_salt)."<br>";
	
	$again_hash = crypt($password,$hash );
	echo $again_hash."<br>";

?>
</body>
</html>