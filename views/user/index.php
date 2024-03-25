<?php
require_once "views/templates/headerUser.php"; // template navUser
?>
<div class="contenedor">
    <!-- Página index muestra la portada con un título, unas instrucciones y una imagenes sobre propiedades
    aqui el vendedor debe ingresar con su login a traves de la barra de navegación que se encuentra en el 
    header. 
-->
    <div class="titulo">
        <h2>Listado de propiedades de la Inmobiliaria MB</h2><!-- titulo-->
    </div><!-- final Clase título-->
    <div class="contenedor-parrafo">
        <p>Solo personal autorizado!!!</p><!-- indicaciones-->
        <p>Debe ingresar sus credenciales para Iniciar Sessión</p><!-- indicaciones-->
    </div><!-- final Clase contenedor-parrafo-->
    <table border="2"><!-- tabla que muestra las propiedades totales al inicio del usuario a la web-->
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Metros Cuadrados</th>
                <th>Dormitorios</th>
                <th>Servicios</th>
                <th>Precio</th>
                <th>Tipo</th>
                <th>Dirección</th>
            </tr>
        </thead>
        <tbody>
            <!-- Si existen productos en la bbdd se presenta en la siguiente
            tabla, con un foreach-->
            <?php if (!empty($resultados)) : ?>
                <?php foreach ($resultados as $resultado => $valor) : ?>
                    <tr>
                        <td><?php echo $valor['id_pro'] ?></td>
                        <td><?php echo $valor['nombre_pro'] ?></td>
                        <td><?php echo $valor['tamanio_pro'] ?></td>
                        <td><?php echo $valor['dormitorios_pro'] ?></td>
                        <td><?php echo $valor['banios_pro'] ?></td>
                        <td><?php echo $valor['precio_pro'] ?></td>
                        <td><?php echo $valor['tipo_pro'] ?></td>
                        <td><?php echo $valor['direccion_pro'] ?></td>
                    </tr>
                <?php endforeach; ?>
                <!-- Si no existen propiedades en la bbdd se muestra el mensaje -->
            <?php else : ?>
                <tr>
                    <td colspan="8">"No hay propiedades"</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>   
</div><!-- final Clase contenedor-->
<div class="ancla"><!-- ancla para ir al inicio del documento -->
    <a href="#">Ir al inicio</a>
</div>
<?php
    include "views/templates/footer.php"; //? template footer
?>