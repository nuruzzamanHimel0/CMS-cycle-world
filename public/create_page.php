<?php include("../includes/session.php") ?>
<?php include("../includes/dbconnection.php") ?>
<?php include("../includes/functions.php") ?>
<?php include("../includes/validation_function.php") ?>
<?php 	confrom_logged_in(); ?>
<?php
	find_selected_page();
	
?>
<?php
	if(isset($_POST["submit"]))
	{	
	
		$subject_id =$current_subject["id"];
		$manu_name=$_POST["manu_name"];
		$position =$_POST["position"];
		$visible=$_POST["visible"];
		$content=$_POST["text"];
		
		$manu_name=mysqli_real_escape_string($connection,$manu_name);
		$content=mysqli_real_escape_string($connection,$content);
		
		$require_field = array("manu_name","position","visible","text");
		validate_presence($require_field);
		
		$field_with_max_length = array("manu_name"=>20,"text"=>1000);
		validate_max_length($field_with_max_length);
	
		if(!empty($errors))
		{
			$_SESSION["errors"]=$errors;
			redirect_to("new_page.php");
		}
		
		$query ="INSERT INTO pages ( ";
		$query .="subject_id,manu_name, position, visible,content ";
		$query .=") VALUES ( ";
		$query .="{$subject_id},'{$manu_name}',{$position},{$visible},'{$content}' ";
		$query .=") ";
		
		$result = mysqli_query($connection,$query);
		// Query verification............................................
		if($result){
			$_SESSION["message"]= "Page created.";
			redirect_to("manage_content.php");
		}
			else
			{
			$_SESSION["message"]= "Subject creation fail.";
			redirect_to("new_page.php"); 
		}
		}
		else{
			// probably get request.......
			redirect_to("new_page.php");
		}
?>


<?php if(isset($connection)){ mysqli_close($connection);} ?>