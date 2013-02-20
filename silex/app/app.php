<?php

use Silex\Provider\FormServiceProvider;
use Silex\Provider\HttpCacheServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Silex\Provider\SessionServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ValidatorServiceProvider;
use Igorw\Silex\ConfigServiceProvider;

$app = new Silex\Application();

$app->register(new SessionServiceProvider());
$app->register(new ValidatorServiceProvider());
$app->register(new FormServiceProvider());
$app->register(new UrlGeneratorServiceProvider());

$app
        ->register(new TwigServiceProvider(),
                array('twig.path' => array(__DIR__ . '/Resources/views'),
                        'twig.options' => array()));

$app
        ->register(
                new ConfigServiceProvider(
                        __DIR__ . '/Resources/config/config_' . $env . '.yml'),
                array());

$app->register(new MonologServiceProvider(), array(
        'monolog.logfile' => __DIR__.'/../storage/log/app.log',
        'monolog.name' => 'app',
        'monolog.level' => 300 // = Logger::WARNING
));


$appname = getenv('APP_NAME');
$services_json = json_decode(getenv("VCAP_SERVICES"), true);

if (!empty($services_json)) { // For Appfog
    $mysql_config = $services_json["mysql-5.1"][0]["credentials"];
    $username = $mysql_config["username"];
    $password = $mysql_config["password"];
    $hostname = $mysql_config["hostname"];
    $port = $mysql_config["port"];
    $db = $mysql_config["name"];
} elseif(!empty($appname) && $appname ==='meetphp8') {  // For Pagodabox
    $hostname = $_SERVER["DB1_HOST"];
    $db = $_SERVER["DB1_NAME"];
    $username = $_SERVER["DB1_USER"];
    $password = $_SERVER["DB1_PASS"];
    $port  = '3306';
    

} else {  //For localhost
    $username = 'root';
    $password = 'Panties69';
    $hostname = 'localhost';
    $db = 'meetphp';
    $port  = '3306';
}

$app
        ->register(new Silex\Provider\DoctrineServiceProvider(),
                array(
                        'dbs.options' => array(
                                'mysql_read' => array(
                                        'driver' => 'pdo_mysql',
                                        'host' => $hostname,
                                        'port' => $port,
                                        'dbname' => $db,
                                        'user' => $username,
                                        'password' => $password,
                                        'charset' => 'utf8',),
                                'mysql_write' => array(
                                        'driver' => 'pdo_mysql',
                                        'port' => $port,
                                        'host' => $hostname,
                                        'dbname' => $db,
                                        'user' => $username,
                                        'password' => $password,
                                        'charset' => 'utf8',),),));

require __DIR__ . '/routes.php';

return $app;
