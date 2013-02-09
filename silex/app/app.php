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
$services_json = json_decode(getenv("VCAP_SERVICES"), true);
if (!empty($services_json)) {
    $mysql_config = $services_json["mysql-5.1"][0]["credentials"];
    $username = $mysql_config["username"];
    $password = $mysql_config["password"];
    $hostname = $mysql_config["hostname"];
    $port = $mysql_config["port"];
    $db = $mysql_config["name"];
} else {
    $username = 'root';
    $password = 'Panties69';
    $hostname = 'localhost';
    $db = 'meetphp';
}

$app
        ->register(new Silex\Provider\DoctrineServiceProvider(),
                array(
                        'dbs.options' => array(
                                'mysql_read' => array(
                                        'driver' => 'pdo_mysql',
                                        'host' => $hostname,
                                        'dbname' => $db,
                                        'user' => $username,
                                        'password' => $password,
                                        'charset' => 'utf8',),
                                'mysql_write' => array(
                                        'driver' => 'pdo_mysql',
                                        'host' => $hostname,
                                        'dbname' => $db,
                                        'user' => $username,
                                        'password' => $password,
                                        'charset' => 'utf8',),),));

require __DIR__ . '/routes.php';

return $app;
