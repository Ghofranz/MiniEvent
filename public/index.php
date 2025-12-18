<?php
session_start();

// 1-nnclure la configuration
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/routes.php';

// 2-Obtenir route
$route = route();
$controllerName = $route['controller'];
$action = $route['action'];

// 3-inclure et executer controler
$controllerFile = __DIR__ . '/../app/controllers/' . $controllerName . '.php';

if (file_exists($controllerFile)) {
  require_once $controllerFile;

  // 3- classe existe ?
  if (class_exists($controllerName)) {
    $controller = new $controllerName();

    // 4- methode existe?
    if (method_exists($controller, $action)) {
      $controller->$action();
    } else {
      //si non
      http_response_code(404);
      echo "Action non trouvée: $action";
    }
  } else {
    // Controler non trouve
    http_response_code(404);
    echo "Contrôleur non trouvé: $controllerName";
  }
} else {
  // Fichier controler non trouve
  http_response_code(404);
  echo "Fichier contrôleur non trouvé: $controllerFile";
}