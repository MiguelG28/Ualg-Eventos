<?php
/*
//mysqli_begin_transaction($mysqli);
//mysqli_query($mysqli, "SELECT * FROM utilizadores");
//mysqli_commit($mysqli);
mysqli_close($mysqli);
*/
// mostra uma mensagem de erro vinda do mysql
function showerror()
{
 die("Error " . mysql_errno() . " : " . mysql_error());
}
$hostname = "eventosualg-mysqldbserver.mysql.database.azure.com";
$db_name = "db_grupo";
$db_user = "master@eventosualg-mysqldbserver";
$db_passwd = "Rumoao20";
// faz uma conexão a uma base de dados
function dbconnect($hostname, $db_name,$db_user,$db_passwd)
{
 $db = @ mysql_connect($hostname, $db_user,$db_passwd);
 if(!$db) {
 die("Nao consigo ligar ao servidor da base de
dados.". $db->connect_error);
 }
 if(!(@ mysql_select_db($db_name,$db))){
 showerror();
 }
 return $db;
}
?>
