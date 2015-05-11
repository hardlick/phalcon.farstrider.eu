<?php

/**
 * @author farstrider
 * @version 3 2015-05-11 17:51:56 JST
 * 
 * @category module
 * @package temple
 */

namespace farstrider\temple;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{
	
	// Register a specific autoloader for this module
	public function registerAutoloaders(\Phalcon\DiInterface $di = null)
	{
		$loader = new Loader();
		$loader->registerNamespaces(
				array(
						'farstrider\temple\controller'	=>	APPLICATION_PATH .'/temple/controllers/',
						'farstrider\temple\model'		=>	APPLICATION_PATH .'/temple/models/',
				)
		);
		
		$loader->register();
	}
	
	// Register specific services for this module
	public function registerServices(\Phalcon\DiInterface $di)
	{
		// Register a dispatcher
		$di->set('dispatcher', function() use ($di) {
			$dispatcher = new Dispatcher();
			$dispatcher->setDefaultNamespace('farstrider\temple\controller');
			$dispatcher->setEventsManager($di->get('eventsManager'));
			
			return $dispatcher;
		});
		
		// Register the view
		$di->set('view', function() {
			$view = new View();
			$view->setViewsDir(APPLICATION_PATH .'/temple/views/');
			
			return $view;
		});
	}
}