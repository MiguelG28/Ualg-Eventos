<?php
include 'inc/db.php';

   // Cria um novo objecto template
	$nome = $_POST["user"];
	$email = $_POST["userEmail"];
	$passe1 = $_POST["passe1"];
	$passe2 = $_POST["passe2"];

	$passe = substr(md5($passe1),0,32);
	$created_at = date("Y-m-d H:i:s");
	$updated_at = date("Y-m-d H:i:s");

	if (strlen($nome) < 2){
		header("Location:register.php?error=4&nome=$nome&email=$email");
		die;
	}
	else if (strlen($passe1) < 10){
		header("Location:register.php?error=1&nome=$nome&email=$email");
		die;
	}
	else if($passe1 != $passe2) {
		header("Location:register.php?error=2&nome=$nome&email=$email");
		die;
	}


$db = dbconnect($hostname,$db_name,$db_user,$db_passwd);
if($db) {
	
  $tuplo = "('$nome', '$email', '$passe', '$created_at', '$updated_at')";       
  $sql_stmt  = "INSERT INTO users (name, email, password_digest, created_at, updated_at) VALUES $tuplo";	

  if(!( $chamada =  @ mysql_query($sql_stmt, $db))) {
	  header("Location:register.php?error=3&nome=$nome");
	
  }
  else{
	  header("Location:success.php");
	  }
	    mysql_close($db);
	  
}  
?>