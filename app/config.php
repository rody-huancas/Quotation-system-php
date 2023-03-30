<?php
session_start();

// verificar si estamos en un servidor local
define('IS_LOCAL', in_array($_SERVER["REMOTE_ADDR"], ["127.0.0.1", "::1"]));

// Definir la url base
$web_url = IS_LOCAL ? "http://127.0.0.1/GitHub/Quotation-system-php/" : "URL DEL SERVIDOR EN PRODUCCIÓN";
define("URL", $web_url);

// Rutas para las carpetas
define("DS", DIRECTORY_SEPARATOR);
define("ROOT", getcwd() . DS);
define('APP', ROOT . "app" . DS);
define("ASSETS", ROOT . "assets" . DS);
define("TEMPLATES", ROOT . "templates" . DS);
define("INCLUDES", TEMPLATES . "includes" . DS);
define("MODULES", TEMPLATES . "modules" . DS);
define("VIEWS", TEMPLATES . "views" . DS);
define("UPLOADS", ROOT . "assets/uploads/" . DS);

// Constante para archivos que vayamos a incluir como el header, footer o archivos js o css
define('CSS', URL . "assets/css/");
define('IMG', URL . "assets/images/");
define('JS', URL . "assets/js/");

// Personalización
define("APP_NAME", "Cotizador App");
define("APP_EMAIL", "rody@correo.com");
define("TAXES_RATE", 18); // Porcentaje
define("SHIPPING", 99.50);

// Autoload de composer
require_once ROOT . 'vendor/autoload.php';

// Cargar todas las funciones
require_once APP . "functions.php";
