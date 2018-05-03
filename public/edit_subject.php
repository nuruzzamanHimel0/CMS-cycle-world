<?php include("../includes/session.php") ?>
<?php include("../includes/dbconnection.php") ?>
<?php include("../includes/functions.php") ?>
<?php include("../includes/validation_function.php") ?>
<?php 	confrom_logged_in(); ?>
<?php find_selected_page(true);?>
<?php
if(!$current_subject){ redirect_to("manage_content.php");}
?>

<?php
	if(isset($_POST["submit"]))
	{	
		
		
		$require_field = array("manu_name","position");
		validate_presence($require_field);
		
		$field_with_max_length = array("manu_name"=>20);
		validate_max_length($field_with_max_length);
	
		if(empty($errors))
		{		
		$id = $current_subject["id"];
		$manu_name=$_POST["manu_name"];
		$position =$_POST["position"];
		$visible=$_POST["visible"];
		$manu_name=mysqli_real_escape_string($connection,$manu_name);
		
		$query = "UPDATE subjects ";
		$query .="SET manu_name='$manu_name', ";
		$query .="position=$position, ";
		$query .="visible=$visible ";
		$query .="WHERE id={$id} ";
		$query .="LIMIT 1 ";
		
		$result = mysqli_query($connection,$query);
		// Query verification............................................
		if($result && mysqli_affected_rows($connection)>=0)
			{
			$_SESSION["message"]= "Subject Updated.";
			redirect_to("manage_content.php");
			}
			else
			{
			$message= "Subject Updated fail.";
			
			}
		}
	}
		else{
			// probably get request.......
			//redirect_to("new_subject.php");
		}
?>

<?php include("../includes/layouts/header.php") ?>

    <div id="header">
    	<h1>Cycle World </h1>
    </div>
    <div id="main">  
    <div id="navigation"><?php echo nevigation($current_subject,$current_page); ?> </div>
    
	<div id="page">	
    	<?php 
			if(!empty($message))
			{
				echo "<div class=\"message\">{htmlentities($message)}</div>";
			}
		?>	
        
        <?php  echo form_errors($errors);?>
        <h2> Edit Subject : <?php echo htmlentities($current_subject["manu_name"]); ?></h2>
        <form action="edit_subject.php?subject_id=<?php echo urlencode($current_subject["id"]); ?>" method="post">
            <p>Subject Name:
            	<input type="text" name="manu_name" value="<?php echo $current_subject["manu_name"]; ?>" >
            </p>
            <p>
            Position :
                <select name="position" >
                <?php
				$subject_set = find_all_subjects(false);
				$subject_count = mysqli_num_rows($subject_set);
				for($count=1;$count<=$subject_count+1;$count++)
				{   
					
					echo "<option value=\"{$count}\"";
					if($current_subject["id"] == $count){
					echo " selected " ;
					}
					echo "> {$count} </option>";
				}
				?>
                	
                </select>
            </p>
            <p>Visible:
                <input type="radio" name="visible" value="0" <?php if($current_subject["visible"] ==0){echo "checked" ;} ?>> No
                &nbsp;
                <input type="radio" name="visible" value="1" <?php if($current_subject["visible"] ==1){echo "checked" ;} ?>> Yes
            </p>
            <input type="submit" name ="submit" value="Create Subject">
        </form>
        <br>
        <a href="manage_content.php">Cancel </a>
        &nbsp;&nbsp;
        <a href="delete_subject.php?subject_id=<?php echo urlencode($current_subject["id"]); ?>" onClick="return confirm('Are you sure ??');">Delete Subject </a>

	</div>

        
<?php include("../includes/layouts/footer.php") ?>
