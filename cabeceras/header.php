<?php 
include("../db.php");
session_start();

$url_base="http://localhost/mirador/" ;
if(!isset($_SESSION['usuario'])){
header("location: ".$url_base."index.php");
}
$usuario = $_SESSION["usuario"];
$sql="SELECT * FROM administrador where usuario='$usuario'";
$resultado=$conexion->query($sql);
$row = $resultado->fetch(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html lang="en">
    <head>
        <title>MIRADOR DOS ENCUENTROS</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
      
       <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>

    <link rel="stylesheet" href="../css/header.css">
        
<link rel="stylesheet" href="../css/contenido.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="../../JavaScript/recursos.js"></script>
    </head>

    <body>
    <header>
      <div class="texto-bienvenida">Bienvenido</div>
    

        
        <a class="btn" href="<?php echo $url_base; ?>cerrar.php"><button class="boton"><img src="../img/cerrar.png" alt=""></button></a>
    </header>

