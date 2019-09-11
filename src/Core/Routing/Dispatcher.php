<?php

namespace News\Core\Routing;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class Dispatcher
{
    /**
     * Matched attributes for a route
     *
     * @var array
     */
    protected $attributes;
    

    /**
     * ContainerBuilder
     *
     * @var \Symfony\Component\DependencyInjection\ContainerBuilder
     */
    protected $container;

    /**
     *
     * @param array $attributes
     * @param \Symfony\Component\DependencyInjection\ContainerBuilder $container [def=null]
     */
    public function __construct(array $attributes, ContainerBuilder $container = null)
    {
        $this->container = is_null($container) ? new ContainerBuilder : $container;

        $this->attributes = $attributes;
    }

    /**
     * Resolves into the controller
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function resolve() : Response
    {
        list($controller, $method) = explode('::', $this->attributes['_controller']);

        $controller = $this->container->get($controller);

        return call_user_func([$controller, $method]);
    }
}
