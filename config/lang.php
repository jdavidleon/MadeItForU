<?php 

/*Config Language*/
	if (!isset($web)) { $web = false; }
    if ($web!=true) {
		$pr = explode('/',$_SERVER["REQUEST_URI"]);
		$nw = array_pop($pr);
		if ($nw == '') {
			$nw = array_pop($pr);
		}
	    $idioma = substr($_SERVER["HTTP_ACCEPT_LANGUAGE"],0,2);
	    
		if($idioma=="es") { 
	        header('Location: '.URL_BASE.'es/'.$nw); 
	    } else {   
	        header( 'Location: '.URL_BASE.'en/'.$nw);
	    }
	}
/*#Config Language*/