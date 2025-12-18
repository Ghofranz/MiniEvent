<?php
function route()
{
    
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    // Nettoyage final
    $route = rtrim($uri, '/');
    if ($route === '') {
        $route = '/';
    }

    $routes = [
        '/' => ['controller' => 'EventController', 'action' => 'index'],
        '/events' => ['controller' => 'EventController', 'action' => 'list'],
        '/events/details' => ['controller' => 'EventController', 'action' => 'details'],
        '/reservations/create' => ['controller' => 'ReservationController', 'action' => 'create'],
        '/admin/login' => ['controller' => 'AdminController', 'action' => 'login'],
        '/admin/dashboard' => ['controller' => 'AdminController', 'action' => 'dashboard'],
        '/admin/events/create' => ['controller' => 'AdminController', 'action' => 'createEvent'],
        '/admin/events/edit' => ['controller' => 'AdminController', 'action' => 'editEvent'],
        '/admin/logout' => ['controller' => 'AdminController', 'action' => 'logout'],
        '/admin/events/delete' => ['controller' => 'AdminController','action' => 'deleteEvent'],
        '/admin/events/reservations' => ['controller' => 'AdminController','action' => 'reservations'],

    ];

    return $routes[$route] ?? $routes['/'];
}