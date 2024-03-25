<?php
require_once "views/templates/headerPropiedad.php"; // template navUser 
?>
<div class="contenedor">
    <div class="contenedorError">
        <!--  Muestra la informacion de errores que trae el array con un foreach que lo recorre-->
        <?php if (isset($informacion)) : ?>
            <?php foreach ($informacion as $res) : ?>
                <p class="error"><?php echo $res; ?> </p>
            <?php endforeach; ?>
        <?php endif; ?>
    </div><!-- final Clase errores-->
    <!--  Muestra un formulario para recavar la informacion que se va enviar para registrar una nueva propiedad
en los formularios se hacen las validaciones en el front end-->
    <div class="contenedor-form">
        <form action="index.php?accion=addPropiedad" method="POST" enctype="multipart/form-data">
            <div class="titulo">
                <h2>Agregar Propiedad</h2>
            </div>
            <div class="contenedor-input">
                <label for="nombre">Nombre: </label><br />
                <input type="text" name="nombre" id="nombre" placeholder="Nombre de la propiedad" minlength="3" maxlength="45" required><br />
            </div>
            <div class="contenedor-input">
                <label for="tamanio">Metros Cuadrados: </label><br />
                <input type="number" name="tamanio" id="tamanio" placeholder="Metros Cuadrados" min="0" max="10000" required><br />
            </div>
            <div class="contenedor-input">
                <label for="dormitorios">Dormitorios: </label><br />
                <input type="number" name="dormitorios" id="dormitorios" placeholder="Nº de dormitorios" min="1" max="10" required><br />
            </div>
            <div class="contenedor-input">
                <label for="banios">Servicios: </label><br />
                <input type="number" name="banios" id="banios" placeholder="Nº de servicios" min="1" max="10" required><br />
            </div>
            <div class="contenedor-input">
                <label for="precio">Precio: </label><br />
                <input type="number" name="precio" id="precio" placeholder="Escribe el precio de la propiedad" min="0" max="100000000" required><br />
            </div>
            <div class="contenedor-input">
                <label for="tipo">Propiedad:</label><br />
                <select name="tipo" id="tipo" required>
                    <option value="" selected disabled>Seleccione</option>
                    <option value="chalet">Chalet</option>
                    <option value="piso">Piso</option>
                </select><br />
            </div>
            <div class="contenedor-input">
                <label for="img">Imagen:</label><br />
                <input type="file" name="img" id="img" alt="foto propiedad" required><br />
            </div>
            <div class="contenedor-input">
                <label for="direccion">Dirección: </label><br />
                <input type="text" name="direccion" id="direccion" placeholder="Dirección de la propiedad" minlength="5" maxlength="100" required><br />
            </div>
            <div class="contenedor-input">
                <label for="descripcion">Descripción: </label><br />
                <textarea name="descripcion" id="descripcion" cols="46" rows="4" placeholder="Descripción de la propiedad" minlength="10" maxlength="300" required></textarea><br />
            </div>
                <input class="btn btn--primario" type="submit" value="Agregar" name="agregar">
                <input type="hidden" name="addPropiedad" value="salvar">
            </div>
        </form>
    <div class="atras"><!-- enlace para ir atras una vez vista la propiedad -->
        <a href="index.php?accion=atras"><img src="asset/img/atras.png" alt="Regresar"></a>
    </div>
</div>
</div><!-- final class contenedor-->
<?php
require_once "views/templates/footer.php"; //? template footer    
?>