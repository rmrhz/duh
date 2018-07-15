<?php

namespace News\Core\Routing;

use Symfony\Component\DependencyInjection\ContainerBuilder;

class HandlerResolver implements \Phroute\Phroute\HandlerResolverInterface {

	public function __construct(ContainerBuilder $container)
	{
		$this->container = $container;
	}
	
	/**
	 * Create an instance of the given handler.
	 *
	 * @param $handler
	 * @return array
	 */
	
	public function resolve ($handler)
	{
		if(is_array($handler) && is_string($handler[0]))
		{
			$handler[0] = new $handler[0];
		}
		
		return $handler;
	}
}
