<?php 

	session_start();
	$web = true;
	$lang = "en";
	require("../../config/config.php");
	include(DIRECTORIO_ROOT."lang/{$lang}.php");
	include(DIRECTORIO_ROOT."checkout_address/index.php");