<?php

require_once "pear/HTML/Template/IT.php";


  $template = new HTML_Template_IT('.');
  $template->loadTemplatefile('register_success.html', true, true);

   
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

     $template->setCurrentBlock("aviso");
     $template->setVariable('WARNING', "Novo utilizador criado com sucesso!");





      $template->setCurrentBlock("FOOTER");
     $template->setVariable('FOOTER1', "Ualg++ Eventos");
     $template->setVariable('FOOTER2', "Eventos Futuros");
     $template->setVariable('FOOTER3', "Eventos Anteriores");
     $template->setVariable('FOOTER4', "Sobre nós");
     $template->setVariable('FOOTER5', "Contactos");
     $template->parseCurrentBlock();
 


  $template->show();

 
?>