<?php 

	session_start();
	$web = true;
	$lang = "es";
	require("../../config/config.php");
	include(DIRECTORIO_ROOT."lang/{$lang}.php");
	include(DIRECTORIO_ROOT."bussiness/index.php");