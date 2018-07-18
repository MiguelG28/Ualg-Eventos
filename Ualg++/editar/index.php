<?php
include 'inc/db.php';
require_once "HTML/Template/IT.php";

function display($result)
{
  $template = new HTML_Template_IT('.');
  $template->loadTemplatefile('index_template.html', true, true);

   
     $template->setCurrentBlock("MENU");
     $template->setVariable('Home', "ClassicParts");
     $template->setVariable('Dropdown', "Motorizadas");
     $template->setVariable('Mota1', "Sachs");
     $template->setVariable('Mota2', "Famel");
     $template->setVariable('Mota3', "Casal");
     $template->setVariable('Menu1', "Sobre nós/Contactos");
     $template->setVariable('Menu2', "Registar");
     $template->setVariable('Menu3', "Login");
     $template->parseCurrentBlock();

     $template->setCurrentBlock("SLIDE");
     $template->setVariable('Mota1', "Sachs");
     $template->setVariable('Mota2', "Famel");
     $template->setVariable('Mota3', "Casal");
     $template->parseCurrentBlock();

  
    $nrows  = mysql_num_rows($result);
  if( $nrows > 0 )
  {
    for($i=0; $i<3; $i++)
    {
      $tuple = mysql_fetch_array($result,MYSQL_ASSOC);
      $id = $tuple['id'];
      $nome = $tuple['nome'];
      $descricao = $tuple['descricao'];
      $preco = $tuple['preco'];
      $img = $tuple['img'];
      $disp = $tuple['disp'];


       $template->setCurrentBlock("NEWS");
       $template->setVariable('ID', $id);
       $template->setVariable('IMG', $img);
      $template->setVariable('NOME', $nome);
      $template->setVariable('DESCRICAO', $descricao);
      $template->setVariable('PRECO', $preco);
      $template->setVariable('DISPONIBILIDADE', $disp);
      $template->parseCurrentBlock();
    }
  } 
      $template->show();
 }
$db = dbconnect($hostname,$db_name,$db_user,$db_passwd);
if($db)
{
  $query  = "SELECT nov.id, nov.nome, nov.descricao, nov.preco, nov.img , nov.disp FROM nov ";
  
  if(!($result = @ mysql_query($query,$db )))
   showerror($db);
  
  display($result);
 
  mysql_close($db);

}

?>