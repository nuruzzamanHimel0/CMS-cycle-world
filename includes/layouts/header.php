<?php
	if(!isset($layout_context))
	{
		$layout_context= "Public";	
	}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Cycle World : <?php if(isset($layout_context)){ echo $layout_context; } ?></title>
<link rel="stylesheet" type="text/css" href="syslesheet/main.css">
</head>

<body>