<?php

/**
 * @author farstrider
 * @version 2 2015-05-11 18:27:27 JST
 * 
 * @category module
 * @package default
 */

namespace farstrider;

use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;

class Module implements ModuleDefinitionInterface
{
	
	// Register specific autoloader for this module
	public function registerAutoloaders(\Phalcon\DiInterface $di = null)
	{
		$loader = new Loader();
		$loader->registerNamespaces(
				array(
						'farstrider\controller'	=>	APPLICATION_PATH .'/default/controllers/',
						'farstrider\model'		=>	APPLICATION_PATH .'/default/models/',
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
			$dispatcher->setDefaultNamespace('farstrider\controller');
			$dispatcher->setEventsManager($di->get('eventsManager'));
			
			return $dispatcher;
		});
		
		// Register the view
		$di->set('view', function() {
			$view = new View();
			$view->setViewsDir(APPLICATION_PATH .'/default/views/');
			
			return $view;
		});
	}
}