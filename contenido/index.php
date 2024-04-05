<?php
include("../db.php");

$resultados = []; // Inicializamos la variable $resultados como un array vacío

if(isset($_GET['codigo'])) {
    $codigo_cliente = $_GET['codigo'];

    // Realizar la consulta para buscar al cliente por su código en la base de datos
    $sql = "SELECT * FROM clientes WHERE codigo = :codigo";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':codigo', $codigo_cliente);
    $stmt->execute();
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>

<?php include("../cabeceras/header.php");?>
<br>
<div class="cuerpo">
<div class="container">
    <h2>Buscar Cliente por Código</h2>
    <form class="clase" action="" method="GET">
        <input type="text" name="codigo" id="codigo" placeholder="Ingrese el código del cliente">
        <button type="submit">Buscar</button>
    </form>
    <div id="resultados">
        <?php if (!empty($resultados)) : ?>
            <table>
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>DNI</th>
                        <th>Código</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($resultados as $cliente) : ?>
                        <tr>
                            <td><?= $cliente['nombre'] ?></td>
                            <td><?= $cliente['apellido'] ?></td>
                            <td><?= $cliente['dni'] ?></td>
                            <td><?= $cliente['codigo'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No se encontraron resultados.</p>
        <?php endif; ?>
    </div>
</div>
<div class="contenedor">
    <img src="../img/usuario.png" alt="Imagen">
    <a class="btn" href="<?php echo $url_base; ?>contenido/registrar.php"><button>REGISTRAR</button></a>
</div>

</div>
<br>
<?php include("../cabeceras/footer.php"); ?>
