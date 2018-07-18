<?php
include 'db.php';
  
$db = dbconnect($hostname,$db_name,$db_user,$db_passwd);
if($db)
{
  $id_post = $_GET["POST"];
    
   $megaQuery = "SELECT imagename 
                 FROM microposts
                 WHERE microposts.id = '$id_post';"; 
    
    if(!($result1 = @ mysql_query($megaQuery,$db )))        
      showerror($db);
    $tuple = mysql_fetch_array($result1,MYSQL_ASSOC);
    $target = $tuple['imagename'];
    unlink($target);
    
    
    
    
    
  $query  = "DELETE FROM microposts WHERE microposts.id = '$id_post' ";
  
    
    
  mysql_query('START TRANSACTION', $db);
    
  $iCheck = 1; 
    
  if(!($result = @ mysql_query($query,$db ))){
   $iCheck = 0;      
   showerror($db);
  }
 
    
  if($iCheck = 0){
        mysql_query('ROLLBACK', $db);
   }
   else{
      mysql_query('COMMIT', $db);
	  
   }  
    
    
  mysql_close($db);

  header("Location: protected.php");

}
?>