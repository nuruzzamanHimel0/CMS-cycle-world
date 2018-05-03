<?php include("../includes/session.php") ?>
<?php include("../includes/dbconnection.php") ?>
<?php include("../includes/functions.php") ?>
<?php

find_selected_page();
if(!$current_page){ redirect_to("manage_content.php");}
?>

<?php
$id = $current_page["id"];

$query = "DELETE FROM pages where id = {$id} LIMIT 1 ";
$result = mysqli_query($connection,$query);

if($result && mysqli_affected_rows($connection) == 1)
{
	$_SESSION["message"]="Page DELETED";
	redirect_to("manage_content.php");
}
else
{
	$_SESSION["message"]="Page DELETED fail";
	redirect_to("manage_content.php");
	
}

?>