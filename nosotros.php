<?php

require 'includes/funciones.php';
incluirTemplates('header');
?>

<main class="contenedor seccion">
    <h1>Conoce sobre Nosotros</h1>

    <div class="contenido-nosotros">
        <div class="imagen">
            <picture>
                <source srcset="build/img/nosotros.webp" type="image/webp">
                <source srcset="build/img/nosotros.jpg" type="image/jpeg">
                <img loading="lazy" src="build/img/nosotros.jpg" alt="sobre nosotros">
            </picture>
        </div>

        <div class="texto-nosotros">
            <!-- blockquote; se utiliza para citas  -->
            <blockquote>
                25 años de experiencia
            </blockquote>

            <p>
                Mauris volutpat, ligula et hendrerit feugiat, nibh risus viverra leo, tempor dignissim ex diam eget nibh. Aliquam nec
                erat velit. Fusce vel dignissim velit. Morbi odio tellus, rhoncus et neque ut, rhoncus vehicula libero. Vivamus id metus
                placerat, fringilla libero id, consequat lacus. Pellentesque at scelerisque urna. Aliquam sed urna vel odio dapibus
                dictum. Nam at urna gravida, tristique eros id, bibendum nulla. Donec eleifend, tellus id convallis pulvinar, urna ipsum
                scelerisque est, at tempus velit dolor sed lacus.
            </p>
            <p>
                Curabitur tincidunt nulla eu est tincidunt faucibus. Mauris placerat gravida diam, in vulputate purus ornare
                scelerisque. Aliquam dui lectus, tempus vitae aliquet sit amet, euismod quis nibh. Fusce sit amet sem ac velit porta
                placerat in at nibh. Suspendisse potenti. Fusce quis leo semper lectus pulvinar facilisis.
            </p>
        </div>
    </div>
</main>

<section class="contenedor seccion">
    <h1>Más sobre nosotros</h1>

    <div class="iconos-nosotros">
        <div class="icono">
            <img src="build/img/icono1.svg" alt="Icono seguridad" loading="lazy">
            <h3>Seguridad</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur repellendus blanditiis obcaecati
                harum quos libero, quo nobis sapiente debitis sunt eos similique dolor, quis fugiat. Quasi deserunt
                excepturi nemo iure.</p>
        </div>
        <div class="icono">
            <img src="build/img/icono2.svg" alt="Icono Precio" loading="lazy">
            <h3>Precio</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur repellendus blanditiis obcaecati
                harum quos libero, quo nobis sapiente debitis sunt eos similique dolor, quis fugiat. Quasi deserunt
                excepturi nemo iure.</p>
        </div>
        <div class="icono">
            <img src="build/img/icono3.svg" alt="Icono Tiempo" loading="lazy">
            <h3>Timepo</h3>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur repellendus blanditiis obcaecati
                harum quos libero, quo nobis sapiente debitis sunt eos similique dolor, quis fugiat. Quasi deserunt
                excepturi nemo iure.</p>
        </div>
    </div>
</section>

<?php
incluirTemplates('footer')
?>