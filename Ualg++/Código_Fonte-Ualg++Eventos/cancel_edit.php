<?php
include 'db.php';
$db = dbconnect($hostname,$db_name,$db_user,$db_passwd);

session_start();
if(isset($_SESSION['username'])){

if($db)
{
if(isset($_GET["q"]))    
 $id_post = $_GET["q"];
    
 $query  = "UPDATE microposts SET microposts.locked = '0' WHERE microposts.id = '$id_post';";
  
  if(!($result = @ mysql_query($query,$db )))
   showerror($db);
 
  mysql_close($db);
   header("Location: protected.php");
}

}
else{
    header("Location: index.php");
}
?>
