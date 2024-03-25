<?php
    require_once "views/templates/headerUser.php"; // template header
?>
<div class="contenedor">
<!--  Muestra la informacion de errores que trae el array con un foreach que lo recorre-->
<div class="contenedorError">
    <?php if (isset($informacion)) : ?>
        <?php foreach ($informacion as $res) : ?>
            <p class="error"><?php echo $res; ?> </p>
        <?php endforeach; ?>
    <?php endif; ?>
</div><!-- final Clase errores-->
<div class="titulo"><!-- titulo -->
    <h2>Registro Vendedores</h2>
</div><!-- final Clase título -->
<div class="contenedor-form">
    <!-- //  Formulario de registro, metodo POST envia los valores del formulario y con la url envia 
    informacion al index para que solicite al controlador el metodo indicado
-->
    <form class="formulario" action="index.php?accion=registrar" method="POST">
        <div class="contenedor-input">
            <label class="label" for="email">Correo Electronico:</label>
            <input class="input" type="email" name="email" id="email" placeholder="Escribe tu correo electrónico" required>
        </div>
        <div class="contenedor-input">
            <label class="label" for="contrasenia">Contraseña:</label>
            <input class="input" type="password" name="contrasenia" id="contrasenia" placeholder="Escribe tu contraseña" required>
        </div>
        <div class="contenedor-input">
            <label class="label" for="conContrasenia">Confirmar contraseña:</label>
            <input class="input" type="password" name="conContrasenia" id="conContrasenia" placeholder="Confirma tu contraseña" required>
        </div>
        <input class="btn btn--primario" type="submit" value="Registrar" name="registrar">
    </form>
</div><!-- fin clase contenedor-formulario -->
<div><!-- enlace que lleva a la vista de login -->
    <p>Si ya estás registrado pulsa <a href="index.php?accion=inicioSession"><b>Aqui.</b></a></p>
</div><!-- fin clase contenedor-enlace -->
<!-- bloque de codigo que muestra por pantalla cuando el usuario ha sido registrado con exito -->
<?php if (!empty($usuarioRegistrado)) : ?>
    <div class="registrado">
        <p class="registrado"><?php echo $usuarioRegistrado ?></p>
    </div>
<?php endif; ?>
</div><!-- fin clase contenedor-->
<?php
    include "views/templates/footer.php"; // template footer
?>