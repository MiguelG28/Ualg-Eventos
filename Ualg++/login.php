<?php
 require_once "pear/HTML/Template/IT.php";

   // Cria um novo objecto template
   $template = new HTML_Template_IT('.');

   $template->loadTemplatefile('login.html', true, true);
  // if(isset($_GET['error'])){
   //  $error = $_GET['error'];
  // }
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

    /*if($error==1){
     $template->setCurrentBlock("MENSAGEM");
     $template->setVariable('MESSAGE', "O email não se encontra registado");
     $template->parseCurrentBlock();
   }
    if($error==2){
     $template->setCurrentBlock("MENSAGEM");
     $template->setVariable('MESSAGE', "A password introduzida está errada");
     $template->parseCurrentBlock();
   }*/
   $template->setCurrentBlock("FOOTER");
     $template->setVariable('FOOTER1', "Ualg++ Eventos");
     $template->setVariable('FOOTER2', "Eventos Futuros");
     $template->setVariable('FOOTER3', "Eventos Anteriores");
     $template->setVariable('FOOTER4', "Sobre nós");
     $template->setVariable('FOOTER5', "Contactos");
     $template->parseCurrentBlock();
 

   $template->show();
   ?>