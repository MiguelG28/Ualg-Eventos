<?php
require_once "pear/HTML/Template/IT.php";
include 'inc/db.php';


function display()
{ /*
$nome = '';
$email = '';

$error = $_GET["error"];
$nome = $_GET["nome"];
$email = $_GET["email"];


if($error == 1){
	$notificacao="Insira palavra passe com pelo menos 10 caracteres.";}
if($error == 2){
	$notificacao="As palavras passe introduzidas não coincidem.";}
if($error ==  3){
	$notificacao="Falha na criação de nova conta.Email já existe!";}
if($error ==  4){
  $notificacao="Insira um nome de utilizador válido.";}*/


   $template = new HTML_Template_IT('.');

   $template->loadTemplatefile('register.html', true, true);
   
   /*$template->setCurrentBlock("MENSSAGEM");
    $template->setVariable('MESSAGE', $notificacao);
    $template->parseCurrentBlock();*/
   
   $template->setCurrentBlock("titulo");
    $template->setVariable('TITLE', "Ualg++ Eventos");
    $template->parseCurrentBlock();

     $template->setCurrentBlock("header");
     $template->setVariable('login', "Entrar");
     $template->setVariable('register', "Registar");
     $template->parseCurrentBlock();

    $template->setCurrentBlock("logo");
    $template->setVariable('site', "Ualg++ Eventos");
    $template->parseCurrentBlock();


  $template->setCurrentBlock("MENU");
     $template->setVariable('teste', "Ualg++ Eventos");
     $template->setVariable('MENU2', "Encontrar Eventos");
     $template->setVariable('MENU3', "Workshops");
     $template->setVariable('MENU4', "Entretenimento");
     $template->setVariable('MENU5', "Saúde");
     $template->setVariable('MENU6', "Seminários");
     $template->setVariable('MENU7', "Desporto");
     $template->setVariable('MENU8', "Eventos Futuros");
     $template->setVariable('MENU9', "Eventos Anteriores");
     $template->setVariable('MENU10', "Sobre nós");
     $template->setVariable('MENU11', "Contactos");
     $template->parseCurrentBlock();

     /*$template->setCurrentBlock("SIGN");
     $template->setVariable('Utilizador', $nome);
     $template->setVariable('Email', $email);
     $template->parseCurrentBlock();*/

      $template->setCurrentBlock("FOOTER");
     $template->setVariable('FOOTER1', "Ualg++ Eventos");
     $template->setVariable('FOOTER2', "Eventos Futuros");
     $template->setVariable('FOOTER3', "Eventos Anteriores");
     $template->setVariable('FOOTER4', "Sobre nós");
     $template->setVariable('FOOTER5', "Contactos");
     $template->parseCurrentBlock();
	
   $template->show();
   
}
 

$db = dbconnect($hostname, $db_name, $db_user, $db_passwd);  
if($db) {
  
  $tuplo = "('oi', '123')";       
  $sql_stmt = "INSERT INTO users (Email, Password) VALUES $tuplo";  

  mysql_query($sql_stmt, $db);
  display();
}

?>