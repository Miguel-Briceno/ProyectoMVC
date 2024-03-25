<?php

require_once "views/templates/headerUser.php"; //? template navUser
?>
<div class="contenedor">
 <!-- //  Formulario de registro, metodo POST envia los valores del formulario y con la url envia 
    informacion al index para que solicite al controlador el metodo indicado
-->
<div class="contenedorError"><!--  Muestra la informacion de errores que trae el array con un foreach que lo recorre-->
    <?php if (isset($informacion)): ?>
        <?php foreach ($informacion as $res): ?>
            <p class="error"><?php echo $res; ?> </p>
        <?php endforeach; ?>
    <?php endif; ?>
</div><!-- final Clase errores-->
<div class="titulo">
    <h2>Login Vendedores</h2> <!-- titulo-->
</div><!-- final Clase título -->
<div class="contenedor-form">
     <!-- //  Formulario de login, metodo POST envia los valores del formulario y con la url envia 
    informacion al index para que solicite al controlador el metodo indicado
    -->
    <form class="formulario" action="index.php?accion=login" method="POST" >
        <div class="contenedor-input">
            <label class="label" for="email">Correo Electronico:</label><!-- email-->
            <input class="input" type="email" name="email" id="email" placeholder="Escribe tu correo electrónico" maxlength="45" required>
        </div>
        <div class="contenedor-input">
            <label class="label" for="contrasenia">Contraseña:</label><!-- password-->
            <input class="input" type="password" name="contrasenia" id="contrasenia" placeholder="Escribe tu contrasenia"  required>
        </div>
        <input type="hidden" name="inicioSession">
        <input class="btn btn--primario" type="submit" value="Logín">
    </form>
</div><!-- final Clase contenedor-form -->
<div><!-- enlace que lleva a la vista de registro -->
    <p>Si aun no estás registrado pulsa <a href="index.php?accion=registro"><b>Aqui.</b></a></p>
</div><!-- fin clase contenedor-enlace -->
</div><!-- fin clase contenedor-->
<?php
    include "views/templates/footer.php"; //? template footer
?>