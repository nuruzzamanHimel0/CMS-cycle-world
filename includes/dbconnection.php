<?php
define("DBHOST","localhost",true);
define("DBUSER","root",true);
define("DBPASS","pass",true);
define("DBNAME","cycle1",true);


$connection = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);

if(mysqli_connect_errno())
{
die("Database connection fail : ".mysqli_connect_error()."(".mysqli_connect_errno().")");	
}

?>