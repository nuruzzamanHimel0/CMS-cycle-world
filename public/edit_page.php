<?php include("../includes/session.php") ?>
<?php include("../includes/dbconnection.php") ?>
<?php include("../includes/functions.php") ?>
<?php include("../includes/validation_function.php") ?>
<?php 	confrom_logged_in(); ?>
<?php find_selected_page(true);?>
<?php
if(!$current_page){ redirect_to("manage_content.php");}
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
		$id = $current_page["id"];
		$subject_id =$current_page["subject_id"];
		$manu_name=$_POST["manu_name"];
		$position =$_POST["position"];
		$visible=$_POST["visible"];
		$content=$_POST["text"];
		$manu_name=mysqli_real_escape_string($connection,$manu_name);
		$content=mysqli_real_escape_string($connection,$content);
		
		$query = "UPDATE pages ";
		$query .="SET subject_id=$subject_id, ";
		$query .="manu_name='$manu_name', ";
		$query .="position=$position, ";
		$query .="visible=$visible, ";
		$query .="content='$content' ";
		$query .="WHERE id={$id} ";
		
		echo $query;
		
		
		$result = mysqli_query($connection,$query);
		// Query verification............................................
		if($result && mysqli_affected_rows($connection) >= 0)
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
        <h2> Edit Page : <?php echo htmlentities($current_page["manu_name"]."(". $current_page["id"].")"."(".$current_page["subject_id"].")"); ?></h2>
        
        <form action="edit_page.php?page_id=<?php echo urlencode($current_page["id"]); ?>" method="post">
            <p>Page Name:
            	<input type="text" name="manu_name" value="<?php echo $current_page["manu_name"]; ?>" >
            </p>
            <p>
            Position :
                <select name="position" >
                <?php
				$page_set = find_all_pages();
				$page_count = mysqli_num_rows($page_set);
				for($count=1;$count<=$page_count+1;$count++)
				{   
					
					echo "<option value=\"{$count}\"";
					if($current_page["id"] == $count){
					echo " selected " ;
					}
					echo "> {$count} </option>";
				}
				?>
                	
                </select>
            </p>
            <p>Visible:
                <input type="radio" name="visible" value="0" <?php if($current_page["visible"] ==0){echo "checked" ;} ?>> No
                &nbsp;
                <input type="radio" name="visible" value="1" <?php if($current_page["visible"] ==1){echo "checked" ;} ?>> Yes
            </p>
            
             Content:<br>
				<textarea name="text" rows="10" cols="40">
                
                </textarea><br>
            <input type="submit" name ="submit" value="Edit Page">
        </form>
        <br>
        <a href="manage_content.php">Cancel </a>
        &nbsp;&nbsp;
        <a href="delete_page.php?page_id=<?php echo urlencode($current_page["id"]); ?>" onClick="return confirm('Are you sure ??');">Delete Page </a>

	</div>

        
<?php include("../includes/layouts/footer.php") ?>
