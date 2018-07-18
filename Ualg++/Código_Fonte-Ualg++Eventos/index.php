<?php
include 'db.php';
require_once "pear/HTML/Template/IT.php";

function display($result, $result2)
{
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

       }
  } 

    $template->setCurrentBlock("MENU2");
     $template->setVariable('MENU8', "Eventos Futuros");
     $template->setVariable('MENU9', "Eventos Anteriores");
     $template->setVariable('MENU10', "Sobre nós");
     $template->setVariable('MENU11', "Contactos");
     $template->parseCurrentBlock();
     
      $template->setCurrentBlock("LISTA");
     $template->setVariable('title_list', "Lista de Eventos:");
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
      
    if($locked == 1){
     $template->setCurrentBlock("EDIT2");
     $template->setVariable('IMAGEM', $imagem);
     $template->setVariable('LOCKED', ' De momento este evento encontra-se em edição!');
     $template->setVariable('ID', $id);
     $template->setVariable('NAME', $name);
     $template->setVariable('DESCRIPTION', $description);
     $template->setVariable('LOCALIZATION', $localization);
     $template->setVariable('CONTACT', $contact);
     $template->setVariable('EVENT_TIME', $event_time);
     $template->parseCurrentBlock();
   }
   else{
     $template->setCurrentBlock("POST");
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
  

$db = dbconnect($hostname,$db_name,$db_user,$db_passwd);
if($db)
{
  $query  = "SELECT microposts.id, microposts.name, microposts.description, microposts.imagename, microposts.localization, microposts.contact, microposts.event_time,microposts.locked, microposts.locked_at FROM microposts WHERE microposts.event_time >= NOW() ORDER BY microposts.event_time ASC ";
  
  if(!($result = @ mysql_query($query,$db )))
   showerror($db);

 $query2  = "SELECT DISTINCT microposts.categories FROM microposts WHERE microposts.event_time >= NOW()";
  
  if(!($result2 = @ mysql_query($query2,$db )))
   showerror($db);
    
   $query3  = "SELECT locked_at, id, locked FROM microposts;";
  
  if(!($result3 = @ mysql_query($query3,$db ))){
   showerror($db);
  }
  else{
      $nrows  = mysql_num_rows($result3);
        for($i=0; $i<$nrows; $i++){
            $tuple = mysql_fetch_array($result3,MYSQL_ASSOC);
            
            $past = $tuple['locked_at'];
            $present = date("Y-m-d H:i:s");
            
            $lockedAt = strtotime($past);
            $today = strtotime($present);
            
            $postID = $tuple['id'];
            
            $minus = $today - $lockedAt;
            
            if($minus > 2 * 60){
                $query4  = "UPDATE microposts 
                            SET locked = '0'
                            WHERE id = '$postID';";
                
                //echo $minus."    ";
                //echo date("Y-m-d H:i:s");
                if(!($result4 = @ mysql_query($query4,$db ))){
                    showerror($db);
            }
        }
    }
  }    
    
    
    
    

  display($result, $result2);
 
  mysql_close($db);

}
?>