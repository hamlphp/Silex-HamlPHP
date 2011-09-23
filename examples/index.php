<?php

require_once __DIR__ . '/silex.phar';

$app = new Silex\Application();
$app['debug'] = true;

$app['autoloader']->registerNamespace('SilexHamlPHP', __DIR__ . '/../lib');

$app->register(new SilexHamlPHP\ServiceProvider(), array(
    'hamlphp.view_path' => __DIR__ . '/views',
    'hamlphp.cache_dir' => __DIR__ . '/tmp/',
));

$app->get('/', function () use ($app) {
  return $app['hamlphp']->render('index.haml');
});

$app->run();

?>