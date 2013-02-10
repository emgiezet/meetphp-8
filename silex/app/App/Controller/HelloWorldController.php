<?php

namespace App\Controller;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HelloWorldController {
	public function indexAction(Request $request, Application $app) {

		$sql = "SELECT * FROM posts WHERE 1";
		$statement = $app['dbs']['mysql_read']->prepare($sql);
		$statement->execute();
		$posts = $statement->fetchAll();
		return $app['twig']
				->render('hello_world/index.html.twig', array('posts' => $posts));
	}
}
