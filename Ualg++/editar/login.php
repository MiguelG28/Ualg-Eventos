<?php
require_once "HTML/Template/IT.php";

   // Cria um novo objecto template
   $template = new HTML_Template_IT('.');

   $template->loadTemplatefile('login.html', true, true);
   if(isset($_GET['error'])){
     $error = $_GET['error'];
   }

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

 
   $template->show();


?>