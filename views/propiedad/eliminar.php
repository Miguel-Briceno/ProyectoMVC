<?php
    require_once "views/templates/headerPropiedad.php"; // template navUser 
?>
<section>
    <div class="contenedor">
        <div class="titulo"><!-- título y mensaje de binvenida al usuario que inicio-->
            <h2>Bienvenido<?php echo " " . $_SESSION['usuario']; ?> al panel de administración</h2>
        </div><!-- final class título-->
        <!-- formulario que aplica un filtro para ordenar las propiedades-->
        <div class="form-buscador">
            <form class="formulario-buscador" action="index.php?accion=filtrar" method="POST">
                <div>
                    <label for="filtro">Ordenar por:</label>
                    <select name="filtro" id="filtro">
                        <option value="" selected disabled>Filtrar</option>
                        <option value="nombre">Nombre</option>
                        <option value="precio">Precio</option>
                        <option value="tipo">Tipo</option>
                    </select>
                </div>
                <div><input type="hidden" name="realizar" value="filtro"></div>
                <div><input class="btn btn-ordenar" type="submit" value="Ordenar"></div>
            </form>
        </div>
        <div class="container-table"><!-- tabla que muestra las propiedades de cada vendedor una vez a iniciado 
            sesión, tambien tienes los enlaces de ver, editar o eliminar-->
            <table border="2">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Metros Cuadrados</th>
                        <th>Precio</th>
                        <th>Tipo</th>
                        <th>Dirección</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Si existen productos en la bbdd se presenta en la siguiente
            tabla, con un foreach-->
                    <?php if ($resultado) : ?>
                        <?php foreach ($resultado as $resul => $valor) : ?>
                            <tr>
                                <td><?php $valor['id'] = $id_pro;
                                    echo $id_pro; ?></td>
                                <td><?php echo $valor['nombre_pro'] ?></td>
                                <td><?php echo $valor['tamanio_pro'] ?></td>
                                <td><?php echo $valor['precio_pro'] ?></td>
                                <td><?php echo $valor['tipo_pro'] ?></td>
                                <td><?php echo $valor['direccion_pro'] ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <!-- Si no existen productos en la bbdd se muestra el mensaje -->
                    <?php else : ?>
                        <tr>
                            <td colspan="9">"No hay propiedades"</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div><!-- final class contenedor-->
    <div class="contenenedor-corroborar">
        <div class="titulo">
            <h2>¿Está seguro de eliminar la propiedad?</h2>
        </div><!-- final class título-->
        <div class="corroborar"><!-- dos formularios que permiten decidir si se elimina la 
    propiedad o no, de metodo GET-->
            <form action="index.php" method="GET">
                <div class="input-corroborar"><!-- se elimina la propiedad-->
                    <input type="hidden" name="accion" value="eliminar">
                    <input type="hidden" name="id" value="<?php echo $id_pro ?>">
                    <input class="btn btn-tabla--primario" type="submit" value="Si">
                </div>
            </form>
            <form action="index.php" method="GET">
                <div class="input-corroborar"><!-- no se elimina la propiedad y vuelve a la vista propiedad-->
                    <input type="hidden" name="accion" value="no">                    
                    <input class="btn btn-tabla--terceario" type="submit" value="No">
                </div>
            </form>
        </div><!-- final class corroborar-->
    </div><!-- final class contenedor-->
</section>

<?php
    include "views/templates/footer.php"; // template footer    
?>