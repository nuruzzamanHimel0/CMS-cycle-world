<?php include("../includes/session.php") ?>
<?php include("../includes/dbconnection.php") ?>
<?php include("../includes/functions.php") ?>
<?php include("../includes/layouts/header.php") ?>
<?php include("../includes/validation_function.php") ?>

<?php
	find_selected_page(true);
?>
    <div id="header">
    	<h1>Cycle World : <?php if(isset($layout_context)){ echo $layout_context; } ?> </h1>
    </div>
    <div id="main">  
    <div id="navigation">
    	<?php echo  public_nevigation($current_subject,$current_page); ?>
	</div>
    
	<div id="page">
		<?php echo message();
			  $errors = errors();
			  
		?>	
        <p>
        	<?php 
			if(isset($current_subject))
			{ echo "<h2> Manage Subject</h2>";
				echo "Subject Manu name = ".htmlentities($current_subject["manu_name"])."<br><br>";
			?>	
		<?php }
			else if(isset($current_page))
			{ echo "<h2> Manage Pages</h2>";
				echo "Page Manu name = ".htmlentities($current_page["manu_name"])."<br><br>";
				echo "Content  = ".nl2br($current_page["content"])."<br><br>";
				?>
             <br><br><br>
			<?php }
			else
			{	echo "<h2> Manage Content</h2>";
				echo "<h3>Welcome To Our Site !!</h3>";
			}
			 ?>
        </p>
	</div>

        
<?php include("../includes/layouts/footer.php") ?>
