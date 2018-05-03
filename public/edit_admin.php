<?php include("../includes/session.php") ?>
<?php include("../includes/dbconnection.php") ?>
<?php include("../includes/functions.php") ?>
<?php include("../includes/validation_function.php") ?>
<?php 	confrom_logged_in(); ?>
<?php $admin = find_admin_by_id($_GET["id"]); ?>
<?php $layout_context = "Admin"; ?>
<?php
	if(isset($_POST["submit"]))
	{	

		$require_field = array("username","password");
		validate_presence($require_field);
		
		$field_with_max_length = array("username"=>20,"password"=>15);
		validate_max_length($field_with_max_length);
	
		if(empty($errors))
		{		
		$id = $admin["id"];
		$username=$_POST["username"];
		$password =$_POST["password"];
		$password = password_encypt($password);
	
		$username=mysqli_real_escape_string($connection,$username);
		$password=mysqli_real_escape_string($connection,$password);
		
		$query ="UPDATE admins SET  ";
		$query .="username= '{$username}', password='{$password}' ";
		$query .="WHERE id={$id} ";
		$query .="LIMIT 1 ";
		
		$result = mysqli_query($connection,$query);
		// Query verification............................................
		if($result && mysqli_affected_rows($connection) == 1)
			{
			$_SESSION["message"]= "Admin Updated.";
			redirect_to("manage_admin.php");
			}
			else
			{
			$_SESSION["message"]= "Admin Updated fail.";
			
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
    	<h1>Cycle World :<?php if(isset($layout_context)){ echo $layout_context; } ?> </h1>
    </div>
    <div id="main">  
   <div id="navigation">
    	<br> <br>
        <h3><a href="admin.php"> &laquo; Main manue </a></h3>
	</div>
    
	<div id="page">	
    	<?php echo message();?>	
      
        <?php  echo form_errors($errors);?>
        <h2> Create Admins</h2>
        <form action="" method="post">
           
            <p>User name:
            <input type="text" name="username" value="<?php echo htmlentities($admin["username"]); ?>" >
            </p>
             <p>Password:
            <input type="password" name="password" value="" >
            </p>
             <input type="submit" name="submit" value="Edit Admin" >   	
             
        </form>
        <br>
        <a href="manage_admin.php">Cancel </a>

	</div>

        
<?php include("../includes/layouts/footer.php") ?>
