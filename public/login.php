<?php include("../includes/session.php") ?>
<?php include("../includes/dbconnection.php") ?>
<?php include("../includes/functions.php") ?>
<?php include("../includes/validation_function.php") ?>

<?php $layout_context = "Admin"; ?>
<?php
	$username="";
	$password="";
	if(isset($_POST["submit"]))
	{	

		$require_field = array("username","password");
		validate_presence($require_field);
		
		$field_with_max_length = array("username"=>20,"password"=>15);
		validate_max_length($field_with_max_length);
	
		if(empty($errors))
		{		
		
		$username=$_POST["username"];
		$password =$_POST["password"];
	
		
		$found_admin = attempt_login($username,$password);
		
		// Query verification............................................
		if(isset($found_admin))
			{
				$_SESSION["admin_id"]= $found_admin["id"];
				$_SESSION["username"]= $found_admin["username"];
			redirect_to("admin.php");
			}
			else
			{
			$_SESSION["message"]= "Username/Password Incurrent.";
			
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
        <h2> LogIn</h2>
        <form action="login.php" method="post">
           
            <p>User name:
            <input type="text" name="username" value="<?php echo htmlentities($username); ?>" >
            </p>
             <p>Password:
            <input type="password" name="password" value="" >
            </p> &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;
            <input type="submit" name="submit" value="Submit" >   	
             
        </form>
        

	</div>

        
<?php include("../includes/layouts/footer.php") ?>
