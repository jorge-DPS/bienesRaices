<?php
// Iportar la conexion
require __DIR__ . '/includes/config/database.php';
$db = conectarDB();

// Crear un email y passoword
$email = "correo@correo.com";
$password = "123456";

$passwordHash = password_hash($password, PASSWORD_DEFAULT);
// var_dump(md5($passwordHash));

// Query para crear el usuario
$consultaUsusarios = "INSERT INTO usuarios (email, password) VALUES ('$email', '$passwordHash')";
// echo $consultaUsusarios;


// Agregarlo a la base de datos

mysqli_query($db, $consultaUsusarios);
