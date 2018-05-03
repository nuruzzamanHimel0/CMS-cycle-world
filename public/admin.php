<?php include("../includes/session.php"); ?>
<?php include("../includes/functions.php") ?>
<?php 	confrom_logged_in(); ?>
<?php $layout_context = "Admin"; ?><?php  //user name:himel Pass:pass ?>
<?php include("../includes/layouts/header.php") ?>
		<div id="header">
    	<h1>Cycle World : <?php if(isset($layout_context)){ echo $layout_context; } ?> </h1>
    </div>
     <div id="main">  
     	<div id="navigation">&nbsp;</div>
         <div id="page">
        	<h2> Admin Menu</h2>
            <p> Welcome to Admin Area:<strong><?php echo htmlentities($_SESSION["username"]); ?></strong></p>
            <ul>
            	<li><a href="manage_content.php">Manage Website<br> </a> </li>
                <li><a href="manage_admin.php">Manage Admin <br> </a> </li>
                <li><a href="logout.php">Logout <br> </a> </li>
            </ul>
         </div>
        
<?php include("../includes/layouts/footer.php") ?>