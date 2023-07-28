<?php

require 'app.php'; //-> aqui tiene las funciones: TEMPLATES_URL, FUNCIONES_URL
// funcion para el header 
function incluirTemplates(string $nombreTemplate, bool $inicio = false)
{
    include TEMPLATES_URL . "/$nombreTemplate.php";
}
