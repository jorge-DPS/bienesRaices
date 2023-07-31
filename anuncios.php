<?php

require 'includes/funciones.php';
incluirTemplates('header');
?>

<main class="contenedor seccion">
    <section class="seccion contenedor">
        <h2>Casas y Depas en Ventas</h2>

        <?php
        $limite = 10;
        include 'includes/templates/anuncios.php'
        ?>
    </section>

</main>

<?php
incluirTemplates('footer')
?>