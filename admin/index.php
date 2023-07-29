<?php

//Importar la coneccion
require '../includes/config/database.php';
$db = conectarDB(); //-> una ves que lo importamos usamos la funcion definida en database.php

//Escribir el Query}
$query = "SELECT * FROM propiedades";

//Consultar la DB
$resultadoPropiedad = mysqli_query($db, $query);


// Muestra mensaje cuando se creo el anuncio correctamente, trae en la url, el mensaje
$resultado = $_GET['resultado'] ?? null; // -> si no existe le asiga un valo null; es como el isset()

// Incluye el template del header
require '../includes/funciones.php';
incluirTemplates('header');
?>

<main class="contenedor seccion">
    <h1>Administrador de Bienes Raices</h1>
    <?php if (intval($resultado)  === 1) : ?>
        <p class="alerta exito">Anuncio creado correctamente</p>
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
                        <a href="#" class="boton-rojo-block">Eliminar</a>
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