<?php include("../includes/session.php") ?>
<?php include("../includes/dbconnection.php") ?>
<?php include("../includes/functions.php") ?>
<?php 	confrom_logged_in(); ?>
<?php $layout_context = "Admin"; ?>
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
    	<br> <br>
        <h3><a href="admin.php"> &laquo; Main manue </a></h3>
    	<?php echo nevigation($current_subject,$current_page); ?>
        <br>
        <a href="new_subject.php"> + Add a new Subject</a><br><br><br>
        
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
				echo "Position Name = ".$current_subject["position"]."<br><br>";
				if($current_subject["visible"] == 1)
				{
					echo "Visible Name = Yes";
				}
				else
				{
					echo "Visible Name = NO";
				}
				?><br><br><br>
			<a href="edit_subject.php?subject_id=<?php echo urlencode($current_subject["id"]) ;?>">Edit Subject : <?php echo $current_subject["manu_name"] ;?></a>
            
           <?php $page_set = find_all_pages_from_subject($current_subject["id"],false);
		   	?>	
			<ul> 
				<?php	while($row = mysqli_fetch_assoc($page_set))
                    {
                    ?>   
                    <li>
					
					<a href="edit_page.php?page_id=<?php echo urlencode($row["id"]); ?>"><?php	echo $row["manu_name"];?> </a>
                         
                    </li> <br>		 
                		<?php
				    }?>
     		</ul>  
		    <a href="new_page.php?subject_id=<?php echo urlencode($current_subject["id"]) ;?>"> + Add a new Page for this Subjects</a><br><br><br>
				
		<?php }
			else if(isset($current_page))
			{ echo "<h2> Manage Pages</h2>";
				echo "Page Manu name = ".htmlentities($current_page["manu_name"])."<br><br>";
				echo "Position Name = ".$current_page["position"]."<br><br>";	
				if($current_page["visible"] == 1)
				{
					echo "Visible Name = Yes <br><br>";
				}
				else
				{
					echo "Visible Name = NO <br><br>";
				}
				echo "Content Name = ".$current_page["content"]."<br><br>";
				?>
             <br><br><br>
			<a href="edit_page.php?page_id=<?php echo urlencode($current_page["id"]) ;?>">Edit Page : <?php echo $current_page["manu_name"] ;?></a>  
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <a href="delete_page.php?page_id=<?php echo urlencode($current_page["id"]); ?>" onClick="return confirm('Are you sure ??');">Delete Page </a>
			<?php }
			else
			{	echo "<h2> Manage Content</h2>";
				echo "Please select subject or page";
			}
			 ?>
        </p>
	</div>

        
<?php include("../includes/layouts/footer.php") ?>
