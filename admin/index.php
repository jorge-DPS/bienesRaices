<?php



require '../includes/funciones.php';
$auth = estaAutenticado();
if (!$auth) {
    // si auth es false entonces redirigomos al usuario
    header('Location: /');
}

//Importar la coneccion
require '../includes/config/database.php';
$db = conectarDB(); //-> una ves que lo importamos usamos la funcion definida en database.php

//Escribir el Query}
$query = "SELECT * FROM propiedades";

//Consultar la DB
$resultadoPropiedad = mysqli_query($db, $query);


// Muestra mensaje cuando se creo el anuncio correctamente, trae en la url, el mensaje
$resultado = $_GET['resultado'] ?? null; // -> si no existe le asiga un valo null; es como el isset()

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idPropeidad = $_POST['id'];
    $idPropeidad = filter_var($idPropeidad, FILTER_VALIDATE_INT);

    if ($idPropeidad) {
        // Eliminar archivo
        $consultaPropiedad = "SELECT imagen FROM propiedades WHERE id = $idPropeidad";

        $resPropiedad = mysqli_query($db, $consultaPropiedad);
        $imgPropiedad = mysqli_fetch_assoc($resPropiedad); // -> aqui se trae solo la imagen de la db

        unlink('../imagenes/' . $imgPropiedad['imagen']);


        // Elminiar propiedad
        $consulta = "DELETE FROM propiedades WHERE id = $idPropeidad";
        $resultado = mysqli_query($db, $consulta);
        if ($resultado) {
            header('Location: /admin?resultado=3');
        }
    }
}

// Incluye el template del header
incluirTemplates('header');
?>

<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>
    <?php if (intval($resultado)  === 1) : ?>
        <p class="alerta exito">Anuncio Creado Correctamente</p>
    <?php elseif (intval($resultado)  === 2) : ?>
        <p class="alerta exito">Anuncio Actualizado Correctamente</p>
    <?php elseif (intval($resultado)  === 3) : ?>
        <p class="alerta exito">Anuncio Elminado Correctamente</p>
    <?php endif; ?>



    <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva Propiedad</a>

    <table class="propiedades">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tieulo</th>
                <th>Imagen</th>
                <th>Precio</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody> <!-- Mosrtar los resultados de la base de datos de la tabla de propiedades -->

            <?php while ($fila = mysqli_fetch_assoc($resultadoPropiedad)) : ?>

                <tr>
                    <td> <?php echo $fila['id']; ?> </td>
                    <td><?php echo $fila['titulo']; ?></td>
                    <td> <img src="/imagenes/<?php echo $fila['imagen']; ?>" alt="Imagen" class="imagen-tabla"></td>
                    <td>$<?php echo $fila['precio']; ?></td>
                    <td>
                        <form method="POST" class="w-100">
                            <input type="hidden" name="id" value="<?php echo $fila['id']; ?>">
                            <input type="submit" class="boton-rojo-block" value="Eliminar">

                        </form>
                        <a href="../admin/propiedades/actualizar.php?id=<?php echo $fila['id']; ?>" class="boton-amarillo-block">Actualizar</a>
                    </td>
                </tr>

            <?php endwhile; ?>

        </tbody>
    </table>
</main>

<?php

// cerrar la conexion (opcional)
mysqli_close($db);
incluirTemplates('footer')
?>