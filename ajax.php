<?php

require_once 'app/config.php';

try {
    if (!isset($_POST["action"]) && !isset($_GET["action"])) throw new Exception("El acceso no está autorizado");

    // guardar el valor de la acción
    $action   = isset($_POST["action"]) ? $_POST["action"] : $_GET["action"];
    $action   = str_replace("-", "_", $action);
    $function = sprintf("hook_%s", $action);

    // validar la existencia de la función
    if (!function_exists($function)) throw new Exception("El acceso no está autorizado");

    // ejecutar la función
    $function();
} catch (\Throwable $th) {
    json_output(json_build(403, null, $e->getMessage()));
}
