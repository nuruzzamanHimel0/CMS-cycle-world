<?php include("../includes/session.php") ?>

<?php include("../includes/functions.php") ?>
<?php include("../includes/validation_function.php") ?>

<?php $layout_context = "Admin"; ?>
<?php
	$_SESSION["admin_id"]= NULL;
	$_SESSION["username"]=NULL;
	
	redirect_to("login.php");
 ?>       
<?php include("../includes/layouts/footer.php") ?>
