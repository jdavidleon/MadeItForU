<?php

	spl_autoload_register( function ($nombre_clase) {
		include DIRECTORIO_ROOT.'class/class.'.$nombre_clase.".php";
	});
