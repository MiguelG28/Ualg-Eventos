<?php
include 'db.php';
require_once "pear/HTML/Template/IT.php";
session_start();
function display($result, $result2, $result3, $id_post)
//function display()
{ 
  if (isset($_SESSION['username']) && $_SESSION['username'] == true) {
$template = new HTML_Template_IT('.');
$template->loadTemplatefile('edit_event.html', true, true);
$nomeuser = $_SESSION['username'];

$template->setCurrentBlock("titulo");
 $template->setVariable('TITLE', "Ualg++ Eventos");
 $template->parseCurrentBlock();

  $template->setCurrentBlock("header");
     $template->setVariable('Welcome', "Welcome $nomeuser");
     $template->setVariable('Logout', "Sair");
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

  $tuple3 = mysql_fetch_array($result3,MYSQL_ASSOC);

      $edit_cat = $tuple3['categories'];
      $edit_name = $tuple3['name'];
      $edit_descrip = $tuple3['description'];
      $edit_loc = $tuple3['localization'];
      $edit_contact = $tuple3['contact'];
      $edit_time = $tuple3['event_time'];
      $edit_img = $tuple3['imagename'];
      
$template->setCurrentBlock("EDITION");
    $template->setVariable('ID', $id_post);
    $template->setVariable('edit_cat', $edit_cat);
    $template->setVariable('edit_name', $edit_name);
    $template->setVariable('edit_descrip', $edit_descrip);
    $template->setVariable('edit_loc', $edit_loc);
    $template->setVariable('edit_contact', $edit_contact);
    $template->setVariable('edit_time', $edit_time);
    $template->setVariable('edit_img', $edit_img);
    $template->parseCurrentBlock();

    $template->setCurrentBlock("MENU2");
     $template->setVariable('MENU8', "Eventos Futuros");
     $template->setVariable('MENU9', "Eventos Anteriores");
     $template->setVariable('MENU12', "Adicionar Evento");
     $template->setVariable('MENU10', "Sobre nós");
     $template->setVariable('MENU11', "Contactos");
     $template->parseCurrentBlock();

$template->setCurrentBlock("FOOTER");
 $template->setVariable('FOOTER1', "Ualg++ Eventos");
 $template->setVariable('FOOTER2', "Eventos Futuros");
 $template->setVariable('FOOTER3', "Eventos Anteriores");
 $template->setVariable('FOOTER4', "Sobre nós");
 $template->setVariable('FOOTER5', "Contactos");
 $template->parseCurrentBlock();

$template->show();
    }
   else
   {
    echo "Acesso Negado!";
   }
}

$db = dbconnect($hostname,$db_name,$db_user,$db_passwd);
if($db && isset($_SESSION['username'])) {
  $id_post = $_GET["POST"];

$test_validation  = "SELECT microposts.locked FROM microposts WHERE microposts.id = '$id_post' ";

if(!($test_val = @ mysql_query($test_validation,$db )))
   showerror($db);

$teste = mysql_fetch_array($test_val); 
$resultadinho = $teste[0] ; 
if($resultadinho == 0 )
{
    
    
    
$query  = "SELECT microposts.name, microposts.description, microposts.localization, microposts.contact, microposts.event_time FROM microposts ";
  
  if(!($result = @ mysql_query($query,$db )))
   showerror($db);

 $query2  = "SELECT DISTINCT microposts.categories FROM microposts WHERE microposts.event_time >= NOW() ";
  
  if(!($result2 = @ mysql_query($query2,$db )))
   showerror($db);
 $query3  = "SELECT * FROM microposts WHERE microposts.id = '$id_post' ";
  
  if(!($result3 = @ mysql_query($query3,$db )))
   showerror($db);
  
$cTime = date("Y-m-d H:i:s");   
    
  $query4  = "UPDATE microposts SET microposts.locked = '1', microposts.locked_at = '$cTime' WHERE microposts.id = '$id_post' ";
  
  if(!($result4 = @ mysql_query($query4,$db )))
   showerror($db);

    
  display($result, $result2, $result3, $id_post );

    
  mysql_close($db);
}
else
echo "Este evento já se encontra em edição";
  //display();
}


?>