<?php
session_start();

if(isset($_SESSION['usuario'])){
  header("location: ".$url_base."contenido/index.php");
  exit; // Asegura que el script se detenga después de la redirección
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    include("db.php");
    
    // Evitar la inyección de SQL utilizando consultas preparadas
    $sentencia = $conexion->prepare("SELECT COUNT(*) as n_usuario FROM administrador WHERE usuario=:usuario and contrasenia=:contrasenia");
    
    // Limpiar y preparar los datos del formulario
    $usuario = htmlspecialchars(trim($_POST["usuario"]));
    $contrasenia = htmlspecialchars(trim($_POST["contrasenia"]));
    
    // Vincular los parámetros de la consulta con los valores recibidos del formulario
    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":contrasenia", $contrasenia);
    
    // Ejecutar la consulta preparada
    $sentencia->execute();
    
    // Obtener el resultado de la consulta
    $registro = $sentencia->fetch(PDO::FETCH_ASSOC);

    if($registro["n_usuario"] > 0){
        $_SESSION['usuario'] = $usuario;
        $_SESSION['logueado'] = true;
        header("location: contenido/index.php");
        exit; // Asegura que el script se detenga después de la redirección
    }else{
        $mensaje = "Error: Usuario o contraseña incorrectos";
    }
}
?>


<!doctype html>
<html lang="en">
    <head>
        <title>INGRESO</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
  background-image: url('img/image.png');
  background-size: cover; /* Ajusta el tamaño de la imagen para cubrir todo el área */
  background-position: center; /* Centra la imagen */
}


.login-container {
  width: 300px;
  margin: 150px auto;
  padding: 20px;
  background-color: #fff;
  border-radius: 5px;
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h2 {
  text-align: center;
}
h3{
  text-align: center !important;
  color: #0056b3;
  font-size: 2vh;
  margin-bottom: 1rem !important;
}
.input-group {
  margin-bottom: 2px;
}

label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
}

input[type="text"],
input[type="password"] {
  width: 90%;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 5px;
  
}

button {
  width: 100%;
  padding: 10px;
  border: none ;
  border-radius: 5px;
  background-color: #007bff;
  color: #fff;
  cursor: pointer;
  margin-top: 3vh;
}

button:hover {
  background-color: #0056b3;
}
/* Agrega estos estilos a tu archivo styles.css */

.btn-index {
  width: 45%;
  padding: 10px;
  text-align: center;
  text-decoration: none;
  color: #fff;
  background-color: #28a745;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}

.btn-index:hover {
  background-color: #218838;
}


</style>
    </head>

    <body>
       
        
     
            
<div class="login-container">
  <h2>Iniciar Sesión</h2>
  <h3>Sistema de gestion de clientes VIP</h3>
  <form action="" method="post">
    <div class="input-group">
      <label for="usuario">Usuario</label>
      <input type="text" id="usuario" name="usuario" required>
    </div>
    <div class="input-group">
      <label for="contrasenia">Contraseña</label>
      <input type="password" id="contrasenia" name="contrasenia" required>
    </div>
    <button type="submit">Iniciar Sesión</button>
  </form>
</div>

      
    

       
        <footer>
            <!-- place footer here -->
        </footer>
        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
