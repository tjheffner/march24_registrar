<?php
  require_once __DIR__."/../vendor/autoload.php";
  require_once __DIR__."/../src/Course.php";
  require_once __DIR__."/../src/Student.php";

  $app = new Silex\Application();

  $app['debug'] = true;

  $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
  ));

  use Symfony\Component\HttpFoundation\Request;
  Request::enableHttpMethodParameterOverride();

  $app->get("/", function() use ($app) {
    return "Home";
  });

  return $app;

 ?>
