<?php

require 'includes/funciones.php';
incluirTemplates('header');
?>

<main class="contenedor seccion contenido-centrado">
    <h1>Casa en Venta frente al Bosque</h1>

    <picture>
        <source srcset="build/img/destacada.webp" type="image/webp">
        <source srcset="build/img/destacada.jpg" type="image/jpeg">
        <img loading="lazy" src="build/img/destacada.jpg" alt="Imagen de la propiedad">
    </picture>

    <div class="resumen-propiedad">
        <p class="precio">$3,000,000</p>
        <ul class="icono-caracteristicas">
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_wc.svg" alt="icono wc">
                <p>3</p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_estacionamiento.svg" alt="icono estacionamiento">
                <p>3</p>
            </li>
            <li>
                <img class="icono" loading="lazy" src="build/img/icono_dormitorio.svg" alt="icono habitaciones">
                <p>4</p>
            </li>
        </ul>
        <p>
            Mauris volutpat, ligula et hendrerit feugiat, nibh risus viverra leo, tempor dignissim ex diam eget nibh. Aliquam
            nec
            erat velit. Fusce vel dignissim velit. Morbi odio tellus, rhoncus et neque ut, rhoncus vehicula libero. Vivamus id
            metus
            placerat, fringilla libero id, consequat lacus. Pellentesque at scelerisque urna. Aliquam sed urna vel odio dapibus
            dictum. Nam at urna gravida, tristique eros id, bibendum nulla. Donec eleifend, tellus id convallis pulvinar, urna
            ipsum
            scelerisque est, at tempus velit dolor sed lacus.
        </p>
        <p>
            Curabitur tincidunt nulla eu est tincidunt faucibus. Mauris placerat gravida diam, in vulputate purus ornare
            scelerisque. Aliquam dui lectus, tempus vitae aliquet sit amet, euismod quis nibh. Fusce sit amet sem ac velit porta
            placerat in at nibh. Suspendisse potenti. Fusce quis leo semper lectus pulvinar facilisis.
        </p>
    </div>
</main>

<?php
incluirTemplates('footer')
?>