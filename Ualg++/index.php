<?php
//include 'inc/db.php';
require_once "HTML/Template/IT.php";

//function display($result)
function display()
{

  $template = new HTML_Template_IT('.');
  $template->loadTemplatefile('index.html', true, true);

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

$template->setCurrentBlock("VARIETIES");
     $template->setVariable('variety1', "Workshops");
     $template->setVariable('variety2', "Entretenimento");
     $template->setVariable('variety3', "Desporto");
     $template->parseCurrentBlock();

  /* USAR PARA PREENCHER OS DADOS DOS EVENTOS (POST)
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
*/

     $template->setCurrentBlock("SECOND_TYPE_VARIETIES");
     $template->setVariable('second_variety1', "Workshops");
     $template->setVariable('second_variety2', "Entretenimento");
     $template->setVariable('second_variety3', "Desporto");
     $template->setVariable('second_variety4', "Workshops");
     $template->setVariable('second_variety5', "Entretenimento");
     $template->setVariable('second_variety6', "Desporto");
     $template->setVariable('second_variety7', "Workshops");
     $template->setVariable('second_variety8', "Entretenimento");

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
  
/*
$db = dbconnect($hostname,$db_name,$db_user,$db_passwd);
if($db)
{
  $query  = "SELECT nov.id, nov.nome, nov.descricao, nov.preco, nov.img , nov.disp FROM nov ";
  
  if(!($result = @ mysql_query($query,$db )))
   showerror($db);
  
  display($result);
 
  mysql_close($db);

}
*/

  display();
?>