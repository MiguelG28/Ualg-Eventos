<?php
include 'db.php';
 require_once "pear/HTML/Template/IT.php";
function display($result, $result2)
{
   // Cria um novo objecto template
   $template = new HTML_Template_IT('.');

   $template->loadTemplatefile('login.html', true, true);
 if(isset($_GET['error'])){
    $error = $_GET['error'];
  }
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


$template->setCurrentBlock("MENU1");
     $template->setVariable('teste', "Ualg++ Eventos");
     $template->setVariable('MENU2', "Encontrar Eventos");
     $template->parseCurrentBlock();

 $nrows2  = mysql_num_rows($result2);
  if( $nrows2 > 0 )
  {
    for($j=0; $j<$nrows2; $j++)
    {
      $tuple2 = mysql_fetch_array($result2,MYSQL_ASSOC);
      $categories = $tuple2['categories'];
    $template->setCurrentBlock("DROPDOWN");
    $template->setVariable('MENU3', $categories);
    $template->parseCurrentBlock();
       }
  } 

    $template->setCurrentBlock("MENU2");
     $template->setVariable('MENU8', "Eventos Futuros");
     $template->setVariable('MENU9', "Eventos Anteriores");
     $template->setVariable('MENU10', "Sobre nós");
     $template->setVariable('MENU11', "Contactos");
     $template->parseCurrentBlock();
    if($error==1){
     $template->setCurrentBlock("MENSAGEM");
     $template->setVariable('MESSAGE', "O email não se encontra registado");
     $template->parseCurrentBlock();
   }
    if($error==2){
     $template->setCurrentBlock("MENSAGEM");
     $template->setVariable('MESSAGE', "A password introduzida está errada");
     $template->parseCurrentBlock();
   }
   $template->setCurrentBlock("FOOTER");
     $template->setVariable('FOOTER1', "Ualg++ Eventos");
     $template->setVariable('FOOTER2', "Eventos Futuros");
     $template->setVariable('FOOTER3', "Eventos Anteriores");
     $template->setVariable('FOOTER4', "Sobre nós");
     $template->setVariable('FOOTER5', "Contactos");
     $template->parseCurrentBlock();
 

   $template->show();
   }
   
   $db = dbconnect($hostname,$db_name,$db_user,$db_passwd);
if($db)
{
  $query  = "SELECT microposts.name, microposts.description, microposts.localization, microposts.contact, microposts.event_time FROM microposts ";
  
  if(!($result = @ mysql_query($query,$db )))
   showerror($db);

 $query2  = "SELECT DISTINCT microposts.categories FROM microposts WHERE microposts.event_time >= NOW()";
  
  if(!($result2 = @ mysql_query($query2,$db )))
   showerror($db);

  display($result, $result2);
 
  mysql_close($db);

}
?>