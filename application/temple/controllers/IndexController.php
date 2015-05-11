<?php

/**
 * @author farstrider
 * @version 2 2015-05-08 00:09:02 JST
 * 
 * @category module
 * @package temple
 * @subpackage controller
 */


namespace Temple\Controllers;

use Phalcon\Mvc\Controller;

class IndexController extends Controller
{
	
	public function indexAction()
	{
		// $temples = Temple::find();
		
		/*
		 * This is almost assuredly better implemented in the model somehow =/
		 * 
		 * foreach ($temples as $temple) {
		 *	$temple->addPhotos($temple->getImage());
		 * }
		 */
	}
}