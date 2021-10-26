<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 'on');
	
	//echo "<pre>"; print_r($_SERVER); echo "</pre>";
	
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Expires: " . date("r"));
	
	define("ACCESS", true);
	
	header('Content-Type: text/html; charset=utf-8');
	
	require_once "core/config.php";
	require_once "core/translate.php";
	require_once "core/functions.php";
	require_once "core/tpl_mail.php";
	
	spl_autoload_register(function($class) {
		$path = str_replace('\\', '/', $class.'.php');
		if (!@include_once $path) {
			exit("Не вереныйе путь к файлу для подключения - " . $path);
		}
	});
	
	use core\engine\Langs;
	use core\engine\Route;
	
//	Langs::getInstanse()->autoSetLang();
//	Route::getInstanse();
	
	include("_blogpage.php");
	
//	include("_gidam.html");
//	include("_onas.html");
//	include("_pokupatelam.html");
//	include("_rek.html");
//	include("_usercab.html");
//	include("_vidjet.html");
	
?>
	
	
	