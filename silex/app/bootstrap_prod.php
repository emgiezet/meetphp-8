<?php

//ini_set('display_errors', 0);

//$app = require __DIR__.'/app.php';

/**** Specific to PROD ****/

//return $app;



use Symfony\Component\ClassLoader\DebugClassLoader;
use Symfony\Component\HttpKernel\Debug\ErrorHandler;
use Symfony\Component\HttpKernel\Debug\ExceptionHandler;

ini_set('display_errors', 1);
error_reporting(-1);
DebugClassLoader::enable();
ErrorHandler::register();
if ('cli' !== php_sapi_name()) {
	ExceptionHandler::register();
}

$app = require __DIR__.'/app.php';

/**** Specific to DEV ****/

return $app;