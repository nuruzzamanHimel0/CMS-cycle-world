<?php include("../includes/session.php") ?>
<?php include("../includes/dbconnection.php") ?>
<?php include("../includes/functions.php") ?>
<?php $layout_context = "Admin"; ?>
<?php include("../includes/layouts/header.php") ?>
<?php include("../includes/validation_function.php") ?>

<?php
	find_selected_page();
	
?>
    <div id="header">
    	<h1>Cycle World :<?php if(isset($layout_context)){ echo $layout_context; } ?> </h1>
    </div>
    <div id="main">  
    <div id="navigation"><?php echo nevigation($current_subject,$current_page); ?> </div>
    
	<div id="page">	
    	<?php echo message();?>	
        <?php $errors = errors(); ?>
        <?php  echo form_errors($errors);?>
        <h2> Create Subject</h2>
        <form action="create_subject.php" method="post">
            <p>Subject Name:
            	<input type="text" name="manu_name" value="" >
            </p>
            <p>
            Position :
                <select name="position" >
                <?php
				$subject_set = find_all_subjects();
				$subject_count = mysqli_num_rows($subject_set);
				for($count=1;$count<=$subject_count+1;$count++)
				{   
					
					echo "<option value=\"{$count}\"> {$count} </option>";
					
				}
				
				?>
                	
                </select>
            </p>
            <p>Visible:
                <input type="radio" name="visible" value="0"> No
                &nbsp;
                <input type="radio" name="visible" value="1"> Yes
            </p>
            <input type="submit" name ="submit" value="Create Subject">
        </form>
        <br>
        <a href="manage_content.php">Cancel </a>

	</div>

        
<?php include("../includes/layouts/footer.php") ?>
