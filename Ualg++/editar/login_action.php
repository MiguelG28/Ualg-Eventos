<?php 
include 'db.php';
     
session_start();

$uid = isset($_POST['username_login']) ? $_POST['username_login'] : $_SESSION['username_login'];
$pwd1 = isset($_POST['pass_utilizador']) ? $_POST['pass_utilizador'] : $_SESSION['pass_utilizador'];
$pwd = substr(md5($pwd1),0,32);

if(!isset($uid))
  header("Location: login.php");     

$_SESSION['uid'] = $uid;
$_SESSION['pwd'] = $pwd;

$db = dbconnect($hostname,$db_name,$db_user,$db_passwd); 
$query = "SELECT * FROM users 
         WHERE email = '$uid' 
           AND password_digest = '$pwd'";
$result = @ mysql_query($query,$db);

$query2 = "SELECT * FROM users 
         WHERE email = '$uid'";
$result2 = @ mysql_query($query2,$db);


if (!$result)
  error('A database error occurred while checking your login details.');

if (!$result2)
  error('A database error occurred while checking your login details.');

if(mysql_num_rows($result2) == 0) {
  unset($_SESSION['uid']);
  unset($_SESSION['pwd']);
  header("Location: login.php?error=1");
}else if (mysql_num_rows($result) == 0) {
  unset($_SESSION['uid']);
  unset($_SESSION['pwd']);
  header("Location: login.php?error=2&email=$uid");
}else{
$tupple = mysql_fetch_array($result);
$_SESSION['username'] = $tupple['name'];
$_SESSION['email'] = $tupple['email'];
$_SESSION['id'] = $tupple['id'];

mysql_close($db);

header("Location: protected.php");
}


?>