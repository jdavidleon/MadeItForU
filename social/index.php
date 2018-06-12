<?php


	include '../config/config.php';


	$idioma = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
	    
	if($idioma=="es") { 
        header('Location: '.URL_BASE.'es/#products'); 
    } else {   
        header( 'Location: '.URL_BASE.'en/#products');
    }