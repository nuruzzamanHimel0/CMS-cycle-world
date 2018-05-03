<?php
function redirect_to($location){
	header("Location: ".$location);
	exit;
}

function conform_query($result){if(!$result){die("Database query fail"); }
}

function find_all_subjects($public=true){
	global $connection;
	$quere="SELECT * FROM subjects ";
	if($public)
	{
		$quere .="WHERE visible=1 ";
	}
	$subject_set = mysqli_query($connection,$quere);
	conform_query($subject_set);
	return 	$subject_set;
}

function find_all_pages(){global $connection;
	$quere="SELECT * FROM pages ";
	$quere .="WHERE visible=1 ";
	$page_set = mysqli_query($connection,$quere);
	conform_query($page_set);
	return 	$page_set;
}

function find_all_pages_from_subject($subject_id,$public=true){
	global $connection;
	$subject_id=mysqli_real_escape_string($connection,$subject_id);
	$quere="SELECT * FROM pages ";

	$quere .="WHERE subject_id=$subject_id ";
	if($public)
	{
		$quere .="AND visible=1 ";
	}
	$page_set = mysqli_query($connection,$quere);
	conform_query($page_set); 	
	return $page_set;
}

function find_subject_by_id($selected_subject_id){
	global $connection;
	$selected_subject_id = mysqli_real_escape_string($connection,$selected_subject_id);
	$quere="SELECT * FROM subjects ";
	$quere .="WHERE visible=1 ";
	$quere .="AND id=$selected_subject_id ";
	
	
	$subject_set = mysqli_query($connection,$quere);
	conform_query($subject_set); 
	
	if($subject_row = mysqli_fetch_assoc($subject_set)){
	return $subject_row;
	}else{
	return NULL;	
	}
}
function find_page_by_id($selected_page_id){	global $connection;
	$selected_subject_id = mysqli_real_escape_string($connection,$selected_page_id);
	$quere="SELECT * FROM pages ";
	$quere .="WHERE visible=1 ";
	$quere .="AND id=$selected_page_id ";
	
	
	$page_set = mysqli_query($connection,$quere);
	conform_query($page_set); 
	
	if($pages_row = mysqli_fetch_assoc($page_set)){
	return $pages_row;
	}else{
	return NULL;	
	}
}

function find_selected_page(){
	global $current_subject;
	global $current_page;
	if(isset($_GET["subject_id"]))
	{
		$current_subject = find_subject_by_id($_GET["subject_id"]);
		$selected_page_id=NULL;
		$current_page=NULL;
	}
	else if(isset($_GET["page_id"]))
	{
		$current_page = find_page_by_id($_GET["page_id"]);
		$selected_subject_id=NULL;
		$current_subject=NULL;
	}
	else{
		$current_page=NULL;
		$current_subject=NULL;
	}	
}

function find_all_admins(){
	global $connection;
	$quere ="SELECT *  ";
	$quere .="FROM admins ";
	$quere .="ORDER BY id ASC ";

	$admin_set = mysqli_query($connection,$quere);
	conform_query($admin_set);
	return 	$admin_set;
}

function find_admin_by_id($admin_id){
	
	global $connection;
	$admin_id = mysqli_real_escape_string($connection,$admin_id);
	$quere = "SELECT * FROM admins ";
	$quere .="WHERE id={$admin_id} ";
	$quere .="LIMIT 1";

	$admin_set = mysqli_query($connection,$quere);
	conform_query($admin_set);
	
	if($admin_row = mysqli_fetch_assoc($admin_set)){
	return $admin_row;
	}else{
	return NULL;	
	}
}

function nevigation($subject_array,$page_array){
	$subject_set = find_all_subjects(false);
	
	$output = "<ul type=\"disc\" class=\"subjects\">";
	while($subject = mysqli_fetch_assoc($subject_set)) { 
		$output .= " <div class=\"subjectList\">";
		$output .= "<li" ;
		if($subject_array && $subject["id"] == $subject_array["id"]){
		$output .= " class=\"selected\"";
		}
		
		$output .= ">"; 
		$output .= "<a href=\"manage_content.php?subject_id=";
		$output .= urlencode($subject["id"]);
		$output .="\">"; 	
		$output .= htmlentities($subject["manu_name"]);	
		$output .= "</a><ul class=\"pages\">";	
		$page_set = find_all_pages_from_subject($subject["id"],false);
		
		while($page = mysqli_fetch_assoc($page_set)) { 
				$output .=" <div class=\"pageList\">"; 
				$output .= "<li" ;
				
				if($page_array && $page["id"] == $page_array["id"]){
				$output .= " class=\"selected\"";
				}
				
				$output .= ">"; 
				$output .=" <a href=\"manage_content.php?page_id=";
				
				$output .= urlencode($page["id"]) ;
				$output .="\">";
				
				$output .= htmlentities($page["manu_name"]);
				
				$output .="</a></li></div>";
		}
		
			$output .= "</ul>";
			mysqli_free_result($page_set);
			$output .= "</li> </div>";
		}
	$output .="</ul>";
	mysqli_free_result($subject_set); 
	return $output;
}

function public_nevigation($subject_array,$page_array)
{
	$subject_set = find_all_subjects();
	
	$output = "<ul type=\"disc\" class=\"subjects\">";
	while($subject = mysqli_fetch_assoc($subject_set)) { 
		$output .= " <div class=\"subjectList\">";
		$output .= "<li" ;
		if($subject_array && $subject["id"] == $subject_array["id"]){
		$output .= " class=\"selected\"";
		}
		
		$output .= ">"; 
		$output .= "<a href=\"index.php?subject_id=";
		$output .= urlencode($subject["id"]);
		$output .="\">"; 	
		$output .= htmlentities($subject["manu_name"]);	
		$output .= "</a>";
		
		if($subject_array["id"] == $subject["id"] || $page_array["subject_id"] == $subject["id"] )
		{	
			$page_set = find_all_pages_from_subject($subject["id"]);
			$output .="<ul class=\"pages\">";
			while($page = mysqli_fetch_assoc($page_set))
			 { 
					$output .=" <div class=\"pageList\">"; 
					$output .= "<li" ;
					
					if($page_array && $page["id"] == $page_array["id"]){
					$output .= " class=\"selected\"";
					}
					
					$output .= ">"; 
					$output .=" <a href=\"index.php?page_id=";
					
					$output .= urlencode($page["id"]) ;
					$output .="\">";
					
					$output .= htmlentities($page["manu_name"]);
					
					$output .="</a></li></div>";
			  }	
				$output .= "</ul>";
				mysqli_free_result($page_set);
			}
			$output .= "</li> </div>";
		}
	$output .="</ul>";
	mysqli_free_result($subject_set); 
	return $output;
}

function password_encypt($password)
{
	$has_formate = "$2y$10$";
	$salt_length =22;
	$salt = generate_salt($salt_length);
	$formate_and_salt = $has_formate.$salt;
	$has_password = crypt($password,$formate_and_salt);
	
	return $has_password;
}

function generate_salt($salt_length)
{
	$unique_random_string= md5(uniqid(mt_rand(), true));
	// a-z, A-Z,. , /
	$base64_string = base64_encode($unique_random_string);
	$modify_base64_string = str_replace("+",".",$base64_string);
	$salt = substr($modify_base64_string,0,$salt_length);
	
	return $salt;
	
}

function password_check($password, $existing_hash)
{
	
	if($hash = crypt($password,$existing_hash) )
	{
		return true;	
	}
	else
	{
		return false;	
	}
	
}

function attempt_login($username,$password)
{
	$admin = find_admin_by_username($username);
	if(isset($admin))
	{
		// Found Admin, now check Password	
		if(password_check($password, $admin["password"]))
		{
			return $admin;
		}
		else{
			// Password not match
			return false;
		}
	}
	else{
		// Admin not found	
		return false;
	}
	
}

function find_admin_by_username($username)
{
	global $connection;
	
	$username = mysqli_real_escape_string($connection,$username);
	
	$query = "SELECT * ";
	$query .= "FROM admins ";
	$query .= "WHERE username ='{$username}' ";
	$query .= "LIMIT 1 ";	
	
	$admin_set = mysqli_query($connection,$query);
	conform_query($admin_set);
	
	if($admin = mysqli_fetch_assoc($admin_set))
	{
		return $admin;	
	}
	else{
		return NULL;
	}	
	
}
function confrom_logged_in()
{
	if(!isset($_SESSION["admin_id"])){ redirect_to("login.php"); }	
}

?>