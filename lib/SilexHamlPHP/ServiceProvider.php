<?php

namespace SilexHamlPHP;

use Silex\Application;
use Silex\ServiceProviderInterface;

require_once __DIR__ . '/../../vendor/HamlPHP/src/HamlPHP/HamlPHP.php';
require_once __DIR__ . '/../../vendor/HamlPHP/src/HamlPHP/Storage/FileStorage.php';

class ServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        if (!isset($app['hamlphp.cache_dir'])) {
            throw new \Exception('HamlPHP: hamlphp.cache_dir path is not defined');
        }

        $app['hamlphp'] = $app->share(function () use ($app) {
            $parser = new SilexHamlPHP(new \FileStorage($app['hamlphp.cache_dir']));
            $parser->addGlobal('app', $app);

            if (isset($app['hamlphp.view_path'])) {
                $parser->setViewPath($app['hamlphp.view_path']);
            }

            return $parser;
        });
    }
}