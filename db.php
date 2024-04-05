<?php
$servidor="localhost";
$baseDeDatos="mirador";
$usuario="root";
$contrasenia="";

try{
    $conexion= new PDO("mysql:host=$servidor;dbname=$baseDeDatos",$usuario,$contrasenia);
}catch(exception $ex){
    echo $ex->getMessage();
}

