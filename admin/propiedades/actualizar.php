<?php

/** verificar si esta autenticado*/
require '../../includes/funciones.php';
$auth = estaAutenticado();
if ($auth == false) {
    header('Location: /');
}


/** Begin::Validar la URL por Id valido */
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
if (!$id) {
    header('Location: /admin');
}
// var_dump($id);
/** End::Validar la URL por Id valido */

/* Begin::conectar con la base d e datos */
require "../../includes/config/database.php";
$db = conectarDB();
/* End::conectar con la base d e datos */

// obtener los datos de la propiedad
$consultaPropiedad = "SELECT * FROM propiedades WHERE id = {$id}";
$resultadoPropiedad = mysqli_query($db, $consultaPropiedad);
$propiedad = mysqli_fetch_assoc($resultadoPropiedad);
// echo "<pre>";
// var_dump($propiedad);
// echo "</pre>";

/* Begin::Consultar a labase de dataso para obtener los vendedores */
$consultaVendedores = "SELECT * FROM vendedores";
$resultVendedores = mysqli_query($db, $consultaVendedores); //-> (conectar con la base de datos, consulta)
/* End::Consultar a labase de dataso para obtener los vendedores */

/* Begin::mensaje de errores */
$errores = [];
/* End::mensaje de errores */

/* Begin::Guardar la info llenada cuando sucede el error */
/** creamos las variables vacias, son superglobales, por mas que se recarge la pagina POST tiene la infomracion del formulario */
$titulo = $propiedad['titulo'];
$precio = $propiedad['precio'];
$descripcion = $propiedad['descripcion'];
$habitaciones = $propiedad['habitaciones'];
$wc = $propiedad['wc'];
$estacionamiento = $propiedad['estacionamiento'];
$vendedorId = $propiedad['vendedores_id'];
$imagenPropiedad = $propiedad['imagen'];
/* End::Guardar la info llenada cuando sucede el error */


/* ejecutar el código después de que el usuario envia el formulario */
if ($_SERVER['REQUEST_METHOD'] === 'POST') { //-> aqui verificamos desde la superglobal del server si es POST

    // echo "<pre>";
    // var_dump($_POST);
    // echo "</pre>";
    // echo "<pre>";
    // var_dump($_FILES);
    // echo "</pre>";

    $titulo = mysqli_real_escape_string($db, $_POST['titulo']);
    $precio = mysqli_real_escape_string($db, $_POST['precio']);
    $descripcion = mysqli_real_escape_string($db, $_POST['descripcion']);
    $habitaciones = mysqli_real_escape_string($db, $_POST['habitaciones']);
    $wc = mysqli_real_escape_string($db, $_POST['wc']);
    $estacionamiento = mysqli_real_escape_string($db, $_POST['estacionamiento']);
    $creado = date('Y/m/d');
    $vendedorId = mysqli_real_escape_string($db, $_POST['vendedor']);

    //Aasignar files hacia una variable
    $imagen = $_FILES['imagen'];

    // echo "<pre>";
    // var_dump($imagen);
    // echo "</pre>";

    // exit;

    /* validar el formulario */
    if (!$titulo) {
        $errores[] = "El titulo es obligatorio";
    }

    if (!$precio) {
        $errores[] = "El Precio es obligatorio";
    }

    if (strlen($descripcion) <= 50) {
        $errores[] = "La descripción es obligatoria y debe tener almenos 50 caracteres";
    }

    if (!$habitaciones) {
        $errores[] = "El número de habitaciones es obligatorio";
    }

    if (!$wc) {
        $errores[] = 'El número de baños es obligatorio';
    }

    if (!$estacionamiento) {
        $errores[] = 'El número de Estacionamientos es obligatorio';
    }

    if (!$vendedorId) {
        $errores[] = 'Elige un vendedor';
    }

    //validar por tamaño (1mb Mmáximo)
    $medida = 1000 * 1000;
    if ($imagen['size'] > $medida) {
        $errores[] = 'La imagen es muy pesada';
    }

    if (empty($errores)) { //-> si $errores esta vacio entonces inserta los datos
        /** SUBIDA DE ARCHIVOS */
        $carpetaImagenes = '../../imagenes/'; //-> salimos hsata la raiz del proyecto ../../
        //CREAR CARPETA
        if (!is_dir($carpetaImagenes)) { // -> verificamos la carpeta de imagenes
            mkdir($carpetaImagenes); //-> crea la carpeta
        }

        $nombreImagen = '';


        if ($imagen['name']) {
            // echo "si hay una nueva imagen";
            // Eliminar la imagen previa 
            unlink($carpetaImagenes . $propiedad['imagen']); //-> unlink; es para borrar archivos del servidor
            // Genera un nombre único para la imagen
            $extencion = explode('.', $imagen['name']); //-> aqui dividimos la cadena por cada punto encontrado; en este caso para la extencion jpg
            $nombreImagen = md5(uniqid(rand(), true)) . '.' . $extencion[count($extencion) - 1]; //-> aqui concatenamos la extencion 
            // var_dump($nombreImagen);

            // // Subir la imagen
            move_uploaded_file($imagen['tmp_name'], $carpetaImagenes . $nombreImagen);
        } else {
            $nombreImagen = $propiedad['imagen']; //-> aqui se muestra la imagen que no se actualizo;
        }



        /* Begin::insertar en la base de datos */
        $query = " UPDATE propiedades SET titulo = '$titulo', precio = $precio, imagen = '$nombreImagen', descripcion = '$descripcion', habitaciones = $habitaciones, 
        wc = $wc, estacionamiento = $estacionamiento, vendedores_id = $vendedorId WHERE id = $id";

        // echo $query;

        // echo $query; -> para probar la consulta
        $resultado = mysqli_query($db, $query);

        if ($resultado) {
            // redireccionar al usuario, una vez que el formulario se lleno correctamente
            header('Location: /admin?resultado=2');
        }
        /* End::insertar en la base de datos */
    }
}


incluirTemplates('header');
?>

<main class="contenedor seccion">
    <h1>Actualizar propiedad</h1>
    <a href="/admin" class="boton boton-verde">Volver</a>

    <?php foreach ($errores as $item) : ?>
        <div class="alerta error">
            <?php echo $item; ?>
        </div>
    <?php endforeach; ?>

    <form class="formulario" method="POST" enctype="multipart/form-data">
        <fieldset>

            <legend>Información General</legend>

            <label for="titulo">Titulo</label>
            <input type="text" id="titulo" name="titulo" placeholder="Titulo Propiedad" value="<?php echo $titulo; ?>">

            <label for="precio">Precio</label>
            <input type="number" id="precio" name="precio" placeholder="Precio Propiedad" value="<?php echo $precio; ?>">

            <label for=" imagen">Imagen</label>
            <input type="file" id="imagen" accept="image/jpeg, image/png" name="imagen">

            <img src="/imagenes/<?php echo $imagenPropiedad; ?>" alt="Iamgen propiedad" class="imagen-small">

            <label for="descripcion">Descripcion</label>
            <textarea id="descripcion" name="descripcion" type="text"><?php echo $descripcion; ?></textarea>
        </fieldset>

        <fieldset>
            <legend>Información de la propíedad</legend>
            <label for="habitaciones">Habitaciones:</label>
            <input type="number" id="habitaciones" name="habitaciones" placeholder="Ej: 3" min="1" max="9" value="<?php echo $habitaciones; ?>">

            <label for="wc">Baños:</label>
            <input type="number" id="wc" name="wc" placeholder="Ej: 3" value="<?php echo $wc; ?>">

            <label for="estacionamiento">Estacionamiento:</label>
            <input type="number" id="estacionamiento" name="estacionamiento" placeholder="Ej: 3" value="<?php echo $estacionamiento; ?>">

        </fieldset>

        <fieldset>
            <legend>Vendedor</legend>
            <select name="vendedor">
                <option value="">-- Seleccione --</option>
                <?php while ($fila = mysqli_fetch_assoc($resultVendedores)) : ?>
                    <option <?php echo $vendedorId === $fila['id'] ? 'selected' : ''; ?> value="<?php echo $fila['id']; ?>">
                        <?php echo $fila['nombre'] . " " . $fila['apellido']; ?>
                    </option>
                <?php endwhile; ?>
            </select>
        </fieldset>

        <input type="submit" value="Actualizar propiedad" class="boton boton-verde">
    </form>

</main>

<?php
incluirTemplates('footer')
?>