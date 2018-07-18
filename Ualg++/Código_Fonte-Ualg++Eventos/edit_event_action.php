<?php
include 'db.php';
session_start();

if(isset($_SESSION['username'])){

$target_dir = "img/catagory-img/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

	$nomeuser = $_SESSION['username'];
	$categories = $_POST["categories"];
	$name = $_POST["name"];
	$description = $_POST["description"];
	$localization = $_POST["localization"];
	$contact = $_POST["contact"];
	$datetime = $_POST["datetime"];
	$created_at = date("Y-m-d H:i:s");
	$updated_at = date("Y-m-d H:i:s");
	

$db = dbconnect($hostname,$db_name,$db_user,$db_passwd);
if($db) {
  $id_post = $_GET["POST"];
  $id = mysql_result(mysql_query( "SELECT id from users where name= '$nomeuser' limit 1 "),0);
  

$sql_stmt  = "UPDATE microposts SET categories = '$categories', name = '$name', description = '$description' , imagename = '$target_file' , localization = '$localization' , contact = '$contact' , event_time= '$datetime' , user_id = '$id' ,  created_at = '$created_at' , updated_at = '$updated_at' , locked = 0  WHERE microposts.id = $id_post " ;

    
   mysql_query('START TRANSACTION', $db);
    
   $iCheck = 1; 
    
    

  if(!( $chamada =  @ mysql_query($sql_stmt, $db))) {
	  echo mysql_errno($db) . ": " . mysql_error($db). "\n";
      $iCheck = 0;
  }
  
    if($iCheck = 0){
        mysql_query('ROLLBACK', $db);
    }
    else{
      mysql_query('COMMIT', $db);
	  header("Location:success.php");
	  }
    
    
  

  $query  = "UPDATE microposts SET microposts.locked = '0' WHERE microposts.id = '$id_post' ";
  
  if(!($result = @ mysql_query($query,$db )))
   showerror($db);
	 
  mysql_close($db);
	  
}
}
else{
header("Location: index.php");
}

?>

