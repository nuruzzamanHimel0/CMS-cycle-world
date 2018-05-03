<?php include("../includes/session.php") ?>
<?php include("../includes/dbconnection.php") ?>
<?php include("../includes/functions.php") ?>
<?php

$admin = find_admin_by_id($_GET["id"]);
if(!$admin){ redirect_to("manage_admin.php");}
?>

<?php
$id = $admin["id"];

$query = "DELETE FROM admins where id = {$id} LIMIT 1 ";
$result = mysqli_query($connection,$query);

if($result && mysqli_affected_rows($connection) == 1)
{
	$_SESSION["message"]="Admin DELETED";
	redirect_to("manage_admin.php");
}
else
{
	$_SESSION["message"]="Admin DELETED fail";
	redirect_to("manage_admin.php?id={$id}");
	
}

?>