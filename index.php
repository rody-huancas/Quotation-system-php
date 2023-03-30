<?php

require_once 'app/config.php';

// Prueba PHPMailer
use PHPMailer\PHPMailer\PHPMailer;

$data = [
    'name'     => 'Rody',
    'email'    => 'prueba@correo.com',
    'subject'  => 'Un nuevo correo',
    'body'     => '<h1>Hola, esta es una plantilla de emial</h1>',
    'alt_text' => 'Este es el texto alternativo'
];



// die;

// Renderizado a la vista
get_view("index");
