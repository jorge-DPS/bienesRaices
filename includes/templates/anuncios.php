<?php
// importar la db
require __DIR__ . '/../config/database.php'; //-> __DIR__; apunta hasta el archivo actual; donde se encuentra el archivo
$db = conectarDB();

//consultar
$consulta = "SELECT * FROM propiedades LIMIT $limite";
//obtener resultado
$resPropiedad = mysqli_query($db, $consulta);


?>

<div class="contenedor-anuncios">

    <?php while ($filaPropiedad = mysqli_fetch_assoc($resPropiedad)) : ?>
        <div class="anuncio">
            <picture>
                <!-- <source srcset="build/img/anuncio3.webp" type="image/webp">
                <source srcset="build/img/anuncio3.jpg" type="image/jpge"> -->
                <img loading="lazy" src="/imagenes/<?php echo $filaPropiedad['imagen']; ?>" alt="Anuncio">
            </picture>

            <div class="contenido-anuncio">
                <h3><?php echo $filaPropiedad['titulo']; ?></h3>
                <p><?php echo $filaPropiedad['descripcion']; ?></p>
                <p class="precio"><?php echo $filaPropiedad['precio']; ?></p>

                <ul class="icono-caracteristicas">
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                        <p><?php echo $filaPropiedad['wc']; ?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                        <p><?php echo $filaPropiedad['estacionamiento']; ?></p>
                    </li>
                    <li>
                        <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                        <p><?php echo $filaPropiedad['habitaciones']; ?></p>
                    </li>
                </ul>

                <a href="anuncio.php?id=<?php echo $filaPropiedad['id']; ?>" class="boton-amarillo-block">
                    Ver Propiedad
                </a>
            </div> <!-- .contenido-anuncio -->
        </div> <!-- anuncio -->
    <?php endwhile; ?>
</div><!-- .contenedor-anuncios -->

<?php
//cerrar la conexiom
mysqli_close($db);
?>