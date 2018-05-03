<?php include("../includes/session.php") ?>
<?php include("../includes/dbconnection.php") ?>
<?php include("../includes/functions.php") ?>
<?php include("../includes/validation_function.php") ?>
<?php 	confrom_logged_in(); ?>
<?php
	if(isset($_POST["submit"]))
	{
		$manu_name=$_POST["manu_name"];
		$position =$_POST["position"];
		$visible=$_POST["visible"];
		
		$manu_name=mysqli_real_escape_string($connection,$manu_name);
		
		$require_field = array("manu_name","position","visible");
		validate_presence($require_field);
		
		$field_with_max_length = array("manu_name"=>20);
		validate_max_length($field_with_max_length);
	
		if(!empty($errors))
		{
			$_SESSION["errors"]=$errors;
			redirect_to("new_subject.php");
		}
		
		$query ="INSERT INTO subjects ( ";
		$query .="manu_name, position, visible ";
		$query .=") VALUES ( ";
		$query .="'{$manu_name}',{$position},{$visible} ";
		$query .=") ";
		
		$result = mysqli_query($connection,$query);
		// Query verification............................................
		if($result){
			$_SESSION["message"]= "Subject created.";
			redirect_to("manage_content.php");
		}
			else
			{
			$_SESSION["message"]= "Subject creation fail.";
			redirect_to("new_subject.php"); 
		}
		}
		else{
			// probably get request.......
			redirect_to("new_subject.php");
		}
?>


<?php if(isset($connection)){ mysqli_close($connection);} ?>