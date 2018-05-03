<?php include("../includes/session.php") ?>
<?php include("../includes/dbconnection.php") ?>
<?php include("../includes/functions.php") ?>
<?php 	confrom_logged_in(); ?>
<?php $admin_set = find_all_admins(); ?>
<?php $layout_context = "Admin"; ?>
<?php include("../includes/layouts/header.php") ?>


    <div id="header">
    	<h1>Cycle World : <?php if(isset($layout_context)){ echo $layout_context; } ?> </h1>
    </div>
    <div id="main"> 
     
    <div id="navigation">
    	<br> <br>
        <h3><a href="admin.php"> &laquo; Main manue </a></h3>
	</div>
    
	<div id="page">
		<?php echo message();?>
        <h2> Manage Admin </h2>	
       
        <table  cellspacing="3px" cellpadding="15">
        	<tr>
            	<th  style="width:86px;color:#ffffff;font-size:1em; padding-bottom:0.5em; text-decoration:underline ; font-weight:bold;padding-right: 55px;" > User name</th> 
                <th colspan="2" style="width:50px;color:#FFF;font-size:1em; padding-bottom:0.5em; text-decoration:underline ; font-weight:bold;">Actions </th>          
            </tr>
            
             <?php while($admin = mysqli_fetch_assoc($admin_set)) { ?>
             
                  <tr>
                    <td ><?php echo htmlentities($admin["username"]); ?></td>
                    <td><a href="edit_admin.php?id=<?php echo urlencode($admin["id"]); ?>">Edit </a></td>
                    <td><a href="deleted_admin.php?id=<?php echo urlencode($admin["id"]); ?> " onClick="return confirm('Are you sure ??')">Delete </a></td>
                </tr>
        	<?php } ?>
        </table><br>
        <a href="new_admin.php" style="color:red; "> Add new Admin</a>
        <hr>
        
        <?php
		                    // Password Encrypt tecnique.......................
			/*$password = "myPass";
			$has_formate = "$2y$10$";
			$salt = "Salt22CharectersOrMore";
			echo "Length :".strlen($salt)."<br> <br>";
			
			$format_and_solt = $has_formate.$salt;
			$has_password = crypt($password,$format_and_solt);
			echo $has_password; */
		
		?>
       
        	
	</div>

        
<?php include("../includes/layouts/footer.php") ?>
