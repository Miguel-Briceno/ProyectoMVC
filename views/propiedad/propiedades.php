<?php
    require_once "views/templates/headerPropiedad.php";// template navUser 
?>

<section>
    <div class="contenedor">
        <div class="titulo"><!-- título y mensaje de binvenida al usuario que inicio-->
            <h2>Bienvenido<?php echo " ".$_SESSION['usuario']; ?> al panel de administración</h2>
        </div><!-- final class título-->
        <!-- formulario que aplica un filtro para ordenar las propiedades-->
            <div class="form-buscador">
                <form class="formulario-buscador" action="index.php?accion=filtrar" method="POST">
                    <div >
                        <label for="filtro">Ordenar por:</label>
                        <select name="filtro" id="filtro"><!-- opciones del filtro-->
                            <option value="" selected disabled>Filtrar</option>
                            <option value="nombre">Nombre(alfabetico)</option>
                            <option value="precio">Precio(menor a mayor)</option>
                            <option value="tipo">Tipo</option>
                        </select>
                    </div>
                    <div><input type="hidden" name="realizar" value="filtro"></div>
                    <div><input class="btn btn-ordenar" type="submit" value="Ordenar"></div>
                </form>
            </div>            
            <div class="container-table"><!-- enlace boton que sirve para redirigir a la vista de agregar
            propiedad-->
            <a class="btn btn--primario" href="index.php?accion=agregar">Agregar</a>
            <table border="2"><!-- tabla que muestra las propiedades de cada vendedor una vez a iniciado 
            sesión, tambien tienes los enlaces de ver, editar o eliminar-->
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Metros Cuadrados</th>                        
                        <th>Precio</th>
                        <th>Tipo</th>
                        <th>Dirección</th>
                        <th>***Acciones***</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Si existen productos en la bbdd se presenta en la siguiente
            tabla, con un foreach-->
                    <?php if ($resultados) : ?>
                        <?php foreach ($resultados as $resultado => $valor) : ?>
                            <tr>
                                <td><?php echo $valor['id_pro'] ?></td>
                                <td><?php echo $valor['nombre_pro'] ?></td>
                                <td><?php echo $valor['tamanio_pro'] ?></td>                                
                                <td><?php echo $valor['precio_pro'] ?></td>
                                <td><?php echo $valor['tipo_pro'] ?></td>                                
                                <td><?php echo $valor['direccion_pro'] ?></td>                                
                                <td class="input-tabla"><!-- enlaces que llevan a las diferentes vistas-->
                                    <a class="btn btn-tabla btn-tabla--primario" href="index.php?accion=ver&id=<?php echo $valor['id_pro'] ?>">Ver</a>
                                    <a class="btn btn-tabla btn-tabla--secundario" href="index.php?accion=editar&id=<?php echo $valor['id_pro'] ?>">Editar</a>
                                    <a class="btn btn-tabla btn-tabla--terceario" href="index.php?accion=corroborar&id=<?php echo $valor['id_pro'] ?>">Eliminar</a>
                                </td>
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
        <div class="registrado"><!-- a continuacion tenemos condicionales que muestran si una propiedad
    ha sido agregada, editada o eliminada con exito-->
            <p class="registrado"><?php echo ($_GET['accion']=='eliminar')? $_SESSION['eliminada']: ""; ?></p>
            <p class="registrado"><?php echo ($_GET['accion']=='addPropiedad')? $_SESSION['agregada']: ""; ?></p>
            <p class="registrado"><?php echo ($_GET['accion']=='actualizar')? $_SESSION['editada']: ""; ?></p>
        </div>
        <div class="cookies"><!-- parrafo que muestra el contador de las propiedades que existen por 
        vendedor a traves de un cookie-->    
        <?php echo '<p class="contador">El número de propiedades agregadas es: ' . (isset($_COOKIE["contador"]) ? $_COOKIE["contador"] : "0") . '</p>'; ?>
    </div>       
    </div><!-- final class contenedor-->
</section>

<?php
    require_once "views/templates/footer.php"; //? template footer    
?>