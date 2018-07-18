<?php
function showerror()
{
 die("Error " . mysql_errno() . " : " . mysql_error());
}
$hostname = "10.10.23.183";
//$hostname = "127.0.0.1:3306";
$db_name = "db_a52698";
//$db_name = "mydb";
$db_user = "a52698";
//$db_user = "root";
$db_passwd = "0ffd33";
// faz uma conexão a uma base de dados
function dbconnect($hostname, $db_name, $db_user, $db_passwd)
{
 $db = @ mysql_connect($hostname, $db_user, $db_passwd);
 if(!$db) {
 die('Could not connect: ' . mysql_error());
 }
 if(!(@ mysql_select_db($db_name,$db))){
 showerror();
 }
 return $db;
}
?>