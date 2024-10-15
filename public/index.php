<?php

require '../vendor/autoload.php';  // Composer autoload
session_start();
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Loader\PhpFileLoader;

$fileLocator = new FileLocator([__DIR__ . '/../src/routes/']);
$loader = new PhpFileLoader($fileLocator);

// Initialize an empty RouteCollection
$routes = new RouteCollection();

// Get all PHP files from the routes directory
$routeFiles = glob(__DIR__ . '/../src/routes/*.php');

// Loop through each file and load it into the route collection
foreach ($routeFiles as $file) {
    $routes->addCollection($loader->load($file));
}
// $routes = $loader->load('web.php');

// Create the Request object from the current request (GET, POST, etc.)
$request = Request::createFromGlobals();

// Create a RequestContext object based on the current request
$context = new RequestContext();
$context->fromRequest($request);

// Set up UrlMatcher, ControllerResolver, and ArgumentResolver
$matcher = new UrlMatcher($routes, $context);
$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

try {
    // Match the current request to a route
    $parameters = $matcher->match($request->getPathInfo());
    $request->attributes->add($parameters);
    
    // Resolve the controller based on the matched route
    $controller = $controllerResolver->getController($request);

    // Optionally, you could add middleware handling here if needed
    $middlewares = $request->attributes->get('_middleware', []);

    // Create the handler for invoking the controller
    $handler = function (Request $request) use ($controller, $argumentResolver) {
        // Resolve the arguments for the controller
        $arguments = $argumentResolver->getArguments($request, $controller);
        // Call the controller and return the response
        return call_user_func_array($controller, $arguments);
    };
    // Process the middleware if any are defined
    foreach (array_reverse($middlewares) as $middlewareClass) {
        // Instantiate the middleware class
        $middleware = new $middlewareClass(); // Make sure the classes are properly namespaced
    
        // Create a handler that calls the middleware's handle method
        $handler = function (Request $request) use ($middleware, $handler) {
            return $middleware->handle($request, $handler);
        };
    }

    // Finally, get the response from the handler
    $response = $handler($request);

} catch (ResourceNotFoundException $e) {
    // Handle route not found error (404)
    $response = new Response('Not Found', 404);
} catch (\Exception $e) {
    // Handle any other errors (500)
    $response = new Response('An error occurred: ' . $e->getMessage(), 500);
}

// Send the response back to the browser/client
$response->send();
