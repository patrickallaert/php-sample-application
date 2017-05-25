<?php

$dispatcher = FastRoute\cachedDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/', 'index.php');
    $r->addRoute('GET', '/{id:[^/]+}', 'user.php');
    $r->addRoute('GET', '/{user:[^/]+}/status/{id:[^/]+}', 'tweet.php');
}, [
    'cacheFile' => __DIR__ . '/../route.cache.php',
    'cacheDisabled' => false,
]);

// Fetch method and URI from somewhere
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}

$routeInfo = $dispatcher->dispatch($_SERVER['REQUEST_METHOD'], rawurldecode($uri));
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        http_response_code(404);
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        http_response_code(405);
        header("Allow: " . implode(', ', $routeInfo[1]));
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $_GET = $routeInfo[2];
        require $handler;
        break;
}
