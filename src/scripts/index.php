<?php // demoRouting/src/index.php
require_once __DIR__ . '/../../bootstrap.php';
foreach (glob("controllers/*.php") as $filename) {
    include $filename;
}

use Symfony\Component\Routing\Loader\YamlFileLoader;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\Routing\Exception\ResourceNotFoundException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;

// look inside *this* directory
$locator = new FileLocator(array(__DIR__));
$loader = new YamlFileLoader($locator);
$routes = $loader->load('rutas.yml');

/** @var Symfony\Component\Routing\RequestContext $context */
$context = new RequestContext(filter_input(INPUT_SERVER, 'REQUEST_URI'));

$matcher = new UrlMatcher($routes, $context);

$path_info = filter_input(INPUT_SERVER, 'PATH_INFO') ?? '/';

try {
    $parameters = $matcher->match($path_info);
    echo var_dump($parameters);
    echo var_dump($context);
    $controller = $parameters['_controller'];
    $action = $parameters['action'];
    $controller = new $controller();
    if ($action === 'deleteUser') {
        $controller->$action(intval($parameters['id_user']));
    }
    else if(strpos($context->getBaseUrl(), '&') !== false){
        $query = parse_url($context->getBaseUrl(), PHP_URL_QUERY);
        parse_str($query, $params);
        var_dump($params);
        $controller->$action($params['username'], $params['email'], $params['password']);
    }
    else {
        $controller->$action();
    }
} catch (ResourceNotFoundException $e) {
    echo 'Caught exception: The resource could not be found' . PHP_EOL;
} catch (MethodNotAllowedException $e) {
    echo 'Caught exception: the resource was found but the request method is not allowed' . PHP_EOL;
}
