<?php

namespace News\Core\Routing;

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\Loader\YamlFileLoader as RoutingLoader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Config\FileLocator;

class Routing
{
    public static function getMatcherAttributes(FileLocator $locator, Request $request)
    {
        $routes = (new RoutingLoader($locator))->load('routes.yaml');

        $context = new RequestContext($request);
        $context->fromRequest($request);
        $matcher = new UrlMatcher($routes, $context);

        return $matcher->match($request->getPathInfo());
    }
}
