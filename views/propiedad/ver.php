<?php
    require_once "views/templates/headerPropiedad.php"; // template navUser 
?>
<section>
    <div class="contenedor">
        <div class="titulo"><!-- titulo -->
            <h2>Vista de la Propiedad</h2>
        </div><!-- final class título-->
        <?php if ($resultados) : ?><!-- resultado de la consulta y la muestra en una vista ver, y 
            devuelve la informacion en una tabla -->
            <?php foreach ($resultados as $resultado => $valor) : ?>
            <table class="vista-tabla"> 
                <div class="vista">
                    <tr>
                        <td colspan="2">
                            <div class="foto"><!--imagen de la propiedad-->
                                <?php echo '<img  src="asset/img/'.$valor["img_pro"].' " alt="foto '.$valor["nombre_pro"].' ">'?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><!-- nombre de la propiedad -->
                            <div>
                                <p>Nombre: <?php echo " " . $valor['nombre_pro'] ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><!-- descripcion de la propiedad -->
                            <div >
                                <p>Descripción: <?php echo " " . $valor['descripcion_pro'] ?></p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><!-- metros cuadrados de la propiedad -->
                                <p><?php echo $valor['tamanio_pro'] . " " ?> mts²</p>
                            </div>
                        </td>
                        <td>
                            <div><!-- precio de la propiedad -->
                                <p><?php echo $valor['precio_pro'] . " " ?> €</p>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div><!-- dormitorios de la propiedad -->
                                <p><img src="asset/img/icono_dormitorio.svg" alt="icono dormitorios"><?php echo ":  " . $valor['dormitorios_pro'] ?></p>
                            </div>
                        </td>
                        <td>
                            <div><!-- baños de la propiedad -->
                                <p><img src="asset/img/icono_wc.svg" alt="icono baños"><?php echo ":  " . $valor['banios_pro'] ?></p>
                            </div>
                        </td>
                    </tr>
                </div>
            </table>  
            <?php endforeach; ?>
            <!-- Si no existen productos en la bbdd se muestra el mensaje -->
        <?php else : ?>
            <tr>
                <td colspan="9">"No hay propiedades"</td>
            </tr>
        <?php endif; ?>
        <div class="atras"> <!-- enlace para ir atras una vez vista la propiedad -->           
            <a  href="index.php?accion=atras"><img src="asset/img/atras.png" alt="Regresar"></a>
        </div>
        </tbody>
        </table>

    </div>
    </div><!-- final class contenedor-->
</section>

<?php
    require_once "views/templates/footer.php"; // template footer    
?>