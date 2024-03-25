<!-- Se hace el requerimiento de el template header-->
<?php
require_once "views/templates/headerPropiedad.php"; // template navUser 
?>
<div class="contenedor">
    <div class="titulo">
        <h2>Modificar una Propiedad</h2><!-- Titulo-->
    </div>
    <div class="contenedorError">
        <!--  Muestra la informacion de errores que trae el array con un foreach que lo recorre-->
        <?php if (isset($informacion)) : ?>
            <?php foreach ($informacion as $res) : ?>
                <p class="error"><?php echo $res; ?> </p>
            <?php endforeach; ?>
        <?php endif; ?>
    </div><!-- final Clase errores-->
    <!-- formulario -->
    <div class="contenedor-form">
        <!--  Muestra la informacion en una tabla si hay resultados y a la vez es un formulario que envia
los datos que se estan modificando, los datos se muestran a traves de un foreach-->
        <?php if (!empty($resultados)) : ?>
            <?php foreach ($resultados as $resultado => $valor) : ?>
                <form action="index.php?accion=actualizar" method="POST" enctype="multipart/form-data">
                    <div class="contenedor-input">
                        <label for="id">Id:</label>
                        <input type="text" name="id_pro" id="id" value="<?= $valor['id_pro'] ?>" readonly>
                    </div>
                    <div class="contenedor-input">
                        <label for="nombre_pro">Nombre:</label>
                        <input type="text" name="nombre_pro" id="nombre_pro" value="<?= $valor['nombre_pro'] ?>" requiered>
                    </div>
                    <div class="contenedor-input">
                        <label for="tamanio_pro">Tamaño:</label>
                        <input type="number" name="tamanio_pro" id="tamanio_pro" value="<?= $valor['tamanio_pro'] ?>" requiered>
                    </div>
                    <div class="contenedor-input">
                        <label for="dormitorios_pro">Dormitorios:</label>
                        <input type="number" name="dormitorios_pro" id="dormitorios_pro" value="<?= $valor['dormitorios_pro'] ?>" requiered>
                    </div>
                    <div class="contenedor-input">
                        <label for="banios_pro">Baños:</label>
                        <input type="number" name="banios_pro" id="banios_pro" value="<?= $valor['banios_pro'] ?>" requiered>
                    </div>
                    <div class="contenedor-input">
                        <label for="precio_pro">Precio:</label>
                        <input type="number" name="precio_pro" id="precio_pro" value="<?= $valor['precio_pro'] ?>" requiered>
                    </div>
                    <div class="contenedor-input">
                        <label for="tipo_pro">Tipo:</label>
                        <?php if ($_valor['tipo_pro'] = 'chalet') : ?>
                            <select name="tipo_pro" id="tipo_pro">
                                <option value="chalet" selected requiered>Chalet</option>
                            <?php else : ?>
                                <option value="Piso" selected requiered>Piso</option>
                            </select>
                        <?php endif; ?>
                    </div><br><br>
                    <div class="contenedor-input">
                        <div class="imagen"><label for="img_pro"><?php echo '<img  src="asset/img/' . $valor["img_pro"] . ' " alt="foto ' . $valor["nombre_pro"] . ' ">' ?></label></div>
                        <input type="file" name="img_pro" id="img_pro" value="<?php $valor["nombre_pro"]; ?>" requiered>
                    </div>
                    <div class="contenedor-input">
                        <label for="direccion">Dirección:</label>
                        <input type="text" name="direccion_pro" id="direccion" value="<?= $valor['direccion_pro'] ?>" requiered>
                    </div>
                    <div class="contenedor-input">
                        <label for="descripcion">Descripción:</label>
                        <textarea name="descripcion_pro" id="descripcion" cols="30" rows="10"><?= $valor['descripcion_pro'] ?></textarea>
                    </div>
                    <div class="contenedor-input">
                        <label for="idvendedor">Id Vendedor:</label>
                        <input type="number" name="id_vendedor" id="idvendedor" value="<?= $valor['id_vendedor'] ?>" readonly>
                    </div>
                    <div class="contenedor-input">
                        <input class="btn btn-tabla btn-tabla--secundario" type="submit" name="accion" value="Editar">

                    </div>
                    <div class="atras"><!-- enlace para ir atras una vez vista la propiedad -->
                        <a href="index.php?accion=atras"><img src="asset/img/atras.png" alt="Regresar"></a>
                    </div>
                </form>
            <?php endforeach; ?>
            <!-- Si no existen productos en la bbdd se muestra el mensaje -->
        <?php else : ?>
            <tr><!--  si no hay informacion muestra este resultado-->
                <td colspan="6">"No hay propiedades"</td>
            </tr>
        <?php endif; ?>
    </div>
</div><!-- final class contenedor-->
<!-- Se hace el requerimiento de el template footer-->
<?php require_once 'views/templates/footer.php'; ?>