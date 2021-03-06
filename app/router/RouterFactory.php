<?php

namespace App;

use Nette;
use Nette\Application\Routers\RouteList;
use Nette\Application\Routers\Route;


class RouterFactory
{
	use Nette\StaticClass;

	/**
	 * @return Nette\Application\IRouter
	 */
	public static function createRouter()
	{
		$router = new RouteList;
		$router[] = new Route('clanek/<id>', 'Article:show');
		$router[] = new Route('<presenter>/<action>[/<id=NULL>]', 'Homepage:default');
		return $router;
	}

}
