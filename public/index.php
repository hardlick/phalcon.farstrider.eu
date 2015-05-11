<?php

error_reporting(E_ALL);

/**
 * @author farstrider
 * @version 5 2015-05-11 18:41:09 JST
 * 
 * @category public
 */
use Phalcon\Mvc\Router;
use Phalcon\Mvc\Application;
use Phalcon\DI\FactoryDefault;
use Phalcon\Config\Adapter\Ini as ConfigIni;

/**
 * Define site-wide constants
 */
if (!defined('APPLICATION_PATH')) {
    define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));
}

if (!defined('APPLICATION_ENV')) {
    if (getenv('APPLICATION_ENV')) {
        $env = getenv('APPLICATION_ENV');
    } else {
        $env = 'production';
    }

    define('APPLICATION_ENV', $env);
}

$di = new FactoryDefault();

// Set up module routing
$di->set('router', function() {
    $router = new Router(false);
    $router->setDefaultModule('default')
            ->setDefaultController('index')
            ->setDefaultAction('index')
            ->notFound(array(
                'module' => 'default',
                'controller' => 'error',
                'action' => 'index',
                'params' => '404',
                    )
    );

    $router->add('/', array(
        'module' => 'default',
        'controller' => 'index',
        'action' => 'index',
    ));

    $router->add('/temple', array(
        'module' => 'temple',
        'controller' => 'index',
        'action' => 'index',
    ));

    return $router;
});

try {
    // Get config
    $config = new ConfigIni(APPLICATION_PATH . '/config/global.ini');

    // Create an application
    $application = new Application($di);

    // Register modules
    $application->registerModules(
            array(
                'default' => array(
                    'className' => 'Backend\Module',
                    'path' => APPLICATION_PATH . '/default/Module.php',
                ),
                'temple' => array(
                    'className' => 'Temple\Module',
                    'path' => APPLICATION_PATH . '/temple/Module.php',
                )
            )
    );

    // Handle the request
    echo $application->handle()->getContent();
} catch (\Exception $e) {
    echo "PhalconException: ", $e->getMessage();
}