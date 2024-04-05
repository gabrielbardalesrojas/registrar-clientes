<?php
// Incluir archivo de conexión a la base de datos
include("../db.php");

// Verificar si se han enviado datos mediante el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar que se hayan recibido los datos del formulario
    if (isset($_POST["nombre"], $_POST["apellido"], $_POST["dni"], $_POST["codigo"])) {
        // Limpiar y validar los datos del formulario
        $nombre = htmlspecialchars(trim($_POST["nombre"]));
        $apellido = htmlspecialchars(trim($_POST["apellido"]));
        $dni = htmlspecialchars(trim($_POST["dni"]));
        $codigo = htmlspecialchars(trim($_POST["codigo"]));

        // Verificar que los campos no estén vacíos
        if (!empty($nombre) && !empty($apellido) && !empty($dni) && !empty($codigo)) {
            // Verificar si el código ya existe en la base de datos
            $consulta_codigo = $conexion->prepare("SELECT COUNT(*) AS total FROM clientes WHERE codigo = :codigo or dni=:dni");
            $consulta_codigo->bindParam(':codigo', $codigo);
            $consulta_codigo->bindParam(':dni', $dni);
            $consulta_codigo->execute();
            $resultado_codigo = $consulta_codigo->fetch(PDO::FETCH_ASSOC);

            if ($resultado_codigo['total'] > 0) {
                // Si el código ya existe, mostrar un mensaje de error
               
               
            } else {
                // Preparar la consulta SQL para insertar los datos del cliente de forma segura
                $consulta = $conexion->prepare("INSERT INTO clientes (nombre, apellido, dni, codigo) VALUES (:nombre, :apellido, :dni, :codigo)");

                // Vincular los parámetros de la consulta con los valores recibidos del formulario
                $consulta->bindParam(':nombre', $nombre);
                $consulta->bindParam(':apellido', $apellido);
                $consulta->bindParam(':dni', $dni);
                $consulta->bindParam(':codigo', $codigo);

                // Ejecutar la consulta para insertar los datos del cliente
                if ($consulta->execute()) {
                    // Redirigir al usuario de vuelta al índice del contenido después de registrar al cliente
                    header("Location: index.php");
                    exit; // Asegurar que el script se detenga después de la redirección
                } else {
                    // Si ocurre un error al ejecutar la consulta, mostrar un mensaje de error
                    echo "Error al registrar al cliente. Por favor, inténtelo de nuevo.";
                }
            }
        } else {
            // Si algún campo del formulario está vacío, mostrar un mensaje de error
            echo "Todos los campos son obligatorios. Por favor, complete el formulario.";
        }
    } else {
        // Si faltan datos del formulario, mostrar un mensaje de error
        echo "Faltan datos del formulario.";
    }
} else {
    // Si no se ha enviado un formulario POST, mostrar un mensaje de error
}
?>


<?php include("../cabeceras/header.php"); ?>
<br>
<div class="cuerpo">
    <div class="contiene">
    <h2>Registro de Cliente</h2>
    <form class="conti" action="" method="POST">
        <label for="nombre">Nombre:</label><br>
        <input type="text" id="nombre" name="nombre" required><br>

        <label for="apellido">Apellido:</label><br>
        <input type="text" id="apellido" name="apellido" required><br>

        <label for="dni">DNI:</label><br>
        <input type="text" id="dni" name="dni" required><br>

        <label for="codigo">Código:</label><br>
        <input type="text" id="codigo" name="codigo" required><br>

        <button type="submit">Registrar Cliente</button>
       
    </form>
    <a class="btn" href="<?php echo $url_base; ?>contenido/index.php"><button>CANCELAR</button></a>
    </div>

</div>
<br>
<?php include("../cabeceras/footer.php"); ?>
