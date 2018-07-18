<!DOCTYPE html>
<html>
<body>
<?php
include 'db.php';
require_once "pear/HTML/Template/IT.php";
    
$db = dbconnect($hostname,$db_name,$db_user,$db_passwd);    
if($db) {
    
    if(isset($_GET['q']))
        $id_post = $_GET['q'];
        $cTime = date("Y-m-d H:i:s");
 
    
    
    $query3  = "SELECT locked_at 
                FROM microposts
                WHERE microposts.id = '$id_post';";
  
  if(!($result3 = @ mysql_query($query3,$db ))){
   showerror($db);
  }
  else{
      
            $tuple = mysql_fetch_array($result3,MYSQL_ASSOC);
            
            $past = $tuple['locked_at'];
            $present = date("Y-m-d H:i:s");
            
            $lockedAt = strtotime($past);
            $today = strtotime($present);
            
            
            $minus = $today - $lockedAt;
            
            if($minus > 2 * 60){
                session_start();
                session_destroy();
                
                $query4  = "UPDATE microposts 
                            SET locked = '0'
                            WHERE id = '$id_post';";
                
                //echo $minus."    ";
                //echo date("Y-m-d H:i:s");
                if(!($result4 = @ mysql_query($query4,$db ))){
                    showerror($db);
                }
                
                
                
                echo "<h5 style='color: red;'>Tempo de edição expirou, por favor volte à página inicial<p style='color: red;'>Terá de voltar a iniciar sessão</h5>
                       <button type='button' class='btn btn-default btn-icon' ><a href='index.php'> Go to index</button> ";
            }
      
            else{
                
                
                
                $query4  = "UPDATE microposts SET microposts.locked_at = '$cTime' WHERE microposts.id = '$id_post';";
  
                if(!($result4 = @ mysql_query($query4,$db ))){
                    showerror($db);
                    echo "<h5> ERRO </h5>";   
                }
                //echo "<h5> Time updated to</h5>".$cTime;
                
                  
                
                
            }
    
  } 
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
     
    mysql_close($db);
 
    
}
  
  
?>
    
</body>
</html>    