<?php

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

// error
$app->error(function (\Exception $e, $code) use ($app, $env) {
        throw $e;

    $page = 404 == $code ? '404.twig.html' : '500.twig.html';

    return new Response($app['twig']->render($page, array('code' => $code)), $code);
});

// Hello World Controller
$app->get('/', 'App\Controller\HelloWorldController::indexAction')
    ->bind('homepage');