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
			$handler[0] = $this->resolveController($handler[0]);
		}
		
		return $handler;
	}

	public function resolveController($controller)
	{
		$reflection = $this->container->getReflectionClass($controller);

		$args = [];

		foreach($reflection->getConstructor()->getParameters() as $key => $parameter) {
			// Don't catch exceptions for now if the service is not found
			$args[$key] = $this->container->get($parameter->name);
		}

		return $reflection->newInstanceArgs($args);
	}
}
