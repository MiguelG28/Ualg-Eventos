<?php
include 'db.php';
require_once "pear/HTML/Template/IT.php";
session_start();

function display($result, $result2,  $result3)
{
if (isset($_SESSION['username']) && $_SESSION['username'] == true) {

            $template = new HTML_Template_IT('.');
            $template->loadTemplatefile('protected.html', true, true);
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

              $template->setCurrentBlock("VARIETIES");
              $template->setVariable('variety', $categories);
              $template->parseCurrentBlock();
                 }
            } 

              $template->setCurrentBlock("MENU2");
               $template->setVariable('MENU8', "Eventos Futuros");
               $template->setVariable('MENU9', "Eventos Anteriores");
               $template->setVariable('MENU12', "Inserir Evento");
               $template->setVariable('MENU10', "Sobre nós");
               $template->setVariable('MENU11', "Contactos");
               $template->parseCurrentBlock();

            $nrows  = mysql_num_rows($result);
  if( $nrows > 0 )
  {
    for($i=0; $i<$nrows; $i++)
    {
      $tuple = mysql_fetch_array($result,MYSQL_ASSOC);
    
       
       $id = $tuple['id'];
      $name = $tuple['name'];
      $description = $tuple['description'];
       $imagem = $tuple['imagename'];
      $localization = $tuple['localization'];
      $contact = $tuple['contact'];
      $event_time = $tuple['event_time'];
      $user_id = $tuple['user_id'];
      $locked = $tuple['locked'];

    $template->setCurrentBlock("LISTA");
    $template->setVariable('title_list', "Detalhes do evento: $name");
    $template->parseCurrentBlock();
     
      
        if($locked == 1){
             $template->setCurrentBlock("SINGLE_POST2");
       $template->setVariable('IMAGEM', $imagem);
       $template->setVariable('LOCKED', 'De momento este evento encontra-se em edição!');
        $template->setVariable('ID', $id);
       $template->setVariable('NAME', $name);
       $template->setVariable('DESCRIPTION', $description);
      $template->setVariable('LOCALIZATION', $localization);
      $template->setVariable('CONTACT', $contact);
      $template->setVariable('EVENT_TIME', $event_time);
      $template->parseCurrentBlock();
        }
        else if($user_id == $result3){
       $template->setCurrentBlock("SINGLE_POST3");
       $template->setVariable('IMAGEM', $imagem);
       $template->setVariable('EDITAR', 'Editar o meu evento');
       $template->setVariable('ELIMINAR', 'Eliminar o meu evento');
        $template->setVariable('ID', $id);
       $template->setVariable('NAME', $name);
       $template->setVariable('DESCRIPTION', $description);
      $template->setVariable('LOCALIZATION', $localization);
      $template->setVariable('CONTACT', $contact);
      $template->setVariable('EVENT_TIME', $event_time);
      $template->parseCurrentBlock();
       }
     else
     {

      $template->setCurrentBlock("SINGLE_POST");
       $template->setVariable('IMAGEM', $imagem);
        $template->setVariable('ID', $id);
       $template->setVariable('NAME', $name);
       $template->setVariable('DESCRIPTION', $description);
      $template->setVariable('LOCALIZATION', $localization);
      $template->setVariable('CONTACT', $contact);
      $template->setVariable('EVENT_TIME', $event_time);
      $template->parseCurrentBlock();
    }
     }
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

 else{
      $template = new HTML_Template_IT('.');
  $template->loadTemplatefile('index.html', true, true);

   $template->setCurrentBlock("titulo");
    $template->setVariable('TITLE', "Ualg++ Eventos");
    $template->parseCurrentBlock();

     $template->setCurrentBlock("header");
     $template->setVariable('login', "Login");
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

    $template->setCurrentBlock("VARIETIES");
    $template->setVariable('variety', $categories);
    $template->parseCurrentBlock();
       }
  } 

    $template->setCurrentBlock("MENU2");
     $template->setVariable('MENU8', "Eventos Futuros");
     $template->setVariable('MENU9', "Eventos Anteriores");
     $template->setVariable('MENU10', "Sobre nós");
     $template->setVariable('MENU11', "Contactos");
     $template->parseCurrentBlock();

     

$nrows  = mysql_num_rows($result);
 if( $nrows > 0 )
 {
  for($i=0; $i<$nrows; $i++)
  {
    $tuple = mysql_fetch_array($result,MYSQL_ASSOC);
    $id = $tuple['id'];
    $name = $tuple['name'];
    $description = $tuple['description'];
    $imagem = $tuple['imagename'];
    $localization = $tuple['localization'];
    $contact = $tuple['contact'];
    $event_time = $tuple['event_time'];
    $locked = $tuple['locked'];  

    $template->setCurrentBlock("LISTA");
    $template->setVariable('title_list', "Detalhes do evento: $name");
    $template->parseCurrentBlock();
      
    if($locked == 1){
     $template->setCurrentBlock("SINGLE_POST2");
     $template->setVariable('IMAGEM', $imagem);
     $template->setVariable('LOCKED', 'De momento este evento encontra-se em edição!');
     $template->setVariable('ID', $id);
     $template->setVariable('NAME', $name);
     $template->setVariable('DESCRIPTION', $description);
     $template->setVariable('LOCALIZATION', $localization);
     $template->setVariable('CONTACT', $contact);
     $template->setVariable('EVENT_TIME', $event_time);
     $template->parseCurrentBlock();
   }
   else{
     $template->setCurrentBlock("SINGLE_POST");
     $template->setVariable('ID', $id);
     $template->setVariable('NAME', $name);
     $template->setVariable('DESCRIPTION', $description);
     $template->setVariable('IMAGEM', $imagem);
     $template->setVariable('LOCALIZATION', $localization);
     $template->setVariable('CONTACT', $contact);
     $template->setVariable('EVENT_TIME', $event_time);
     $template->parseCurrentBlock();
   }
 }
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
}
  
$db = dbconnect($hostname,$db_name,$db_user,$db_passwd);
if($db)
{
  $uid = $_SESSION['uid'];
  $id_post = $_GET["POST"];
  $query  = "SELECT microposts.id, microposts.name, microposts.description, microposts.imagename, microposts.localization, microposts.contact, microposts.event_time, microposts.user_id, microposts.locked  FROM microposts WHERE microposts.id = '$id_post' ";
  
  if(!($result = @ mysql_query($query,$db )))
   showerror($db);

 $query2  = "SELECT DISTINCT microposts.categories FROM microposts WHERE microposts.event_time >= NOW() ";
  
  if(!($result2 = @ mysql_query($query2,$db )))
   showerror($db);

$query3  = "SELECT users.id FROM users WHERE users.email = '$uid' ";
  
  if(!($resultado = @ mysql_query($query3,$db )))
   showerror($db);

$teste = mysql_fetch_array($resultado); 

$result3 = $teste[0] ; 

  display($result, $result2, $result3);
 
  mysql_close($db);

}
?>