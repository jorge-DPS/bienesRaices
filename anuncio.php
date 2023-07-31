<?php

$idPropiedad = $_GET['id'];
$idPropiedad = filter_var($idPropiedad, FILTER_VALIDATE_INT);

if (!$idPropiedad) {
    header('Location: /');
}


// importar la conexion a la base de datos
require __DIR__ . '/includes/config/database.php';
$db = conectarDB();

//consltar a la base de datos la propiedad por su id
$consultaPropiedad = "SELECT * FROM propiedades WHERE id = $idPropiedad";

// Resultado de la propiedad consultada
$resPropiedad = mysqli_query($db, $consultaPropiedad);

//validamos que exista el Id de la propiedad; puede qu eel usuario manipule el navegador y cambie el id; por uno que no existe
if ($resPropiedad->num_rows === 0) {
    header('Location: /');
}

$propiedad = mysqli_fetch_assoc($resPropiedad);


require 'includes/funciones.php';
incluirTemplates('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1><?php echo $propiedad['titulo']; ?></h1>

    <picture>
        <!-- <source srcset="build/img/destacada.webp" type="image/webp">
        <source srcset="build/img/destacada.jpg" type="image/jpeg"> -->
        <img loading="lazy" src="/imagenes/<?php echo $propiedad['imagen']; ?>" alt="Imagen de la propiedad">
    </picture>

    <div class="resumen-propiedad">
        <p class="precio"><?php echo $propiedad['precio']; ?></p>
        <ul class="icono-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                <p><?php echo $propiedad['wc']; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                <p><?php echo $propiedad['estacionamiento']; ?></p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                <p><?php echo $propiedad['habitaciones']; ?></p>
            </li>
        </ul>
        <p>
            <?php echo $propiedad['descripcion']; ?>
        </p>

    </div>
</main>

<?php

mysqli_close($db);
incluirTemplates('footer');
?>