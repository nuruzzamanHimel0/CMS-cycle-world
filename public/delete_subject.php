<?php include("../includes/session.php") ?>
<?php include("../includes/dbconnection.php") ?>
<?php include("../includes/functions.php") ?>
<?php

$current_subject = find_subject_by_id($_GET["subject_id"]);
if(!$current_subject){ redirect_to("manage_content.php");}
?>
<?php
//Delete handling for PAGES...........................
$page_set = find_all_pages_from_subject($current_subject["id"],false);

if(mysqli_num_rows($page_set) >0)
{
	$_SESSION["message"]="Can't delete SUBJECT with PAGE";
	redirect_to("manage_content.php?subject_id={$current_subject["id"]}");
}

?>
<?php
$id = $current_subject["id"];

$query = "DELETE FROM subjects where id = {$id} LIMIT 1 ";
$result = mysqli_query($connection,$query);

if($result && mysqli_affected_rows($connection) == 1)
{
	$_SESSION["message"]="Subject DELETED";
	redirect_to("manage_content.php");
}
else
{
	$_SESSION["message"]="subject DELETED fail";
	redirect_to("manage_content.php?subject_id={$id}");
	
}

?>