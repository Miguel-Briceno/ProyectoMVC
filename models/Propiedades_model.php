<?php
require_once 'models/ConexionDB_model.php'; // requiere la conexión a la bbdd
class Propiedad // clase propiedad
{ 
    private $conexion; //Variable conexion
    public function __construct(){// metodo constructor
        $this->conexion = ConexionDB::get_ObtenerConexion(); //inicializacion de la variable           
    }
        
    public function get_Propiedades(){// metodo para obtener los productos de la base de datos
        try{
            $stmt = $this->conexion->prepare('SELECT * FROM propiedades');
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);            
            return $resultados;            
        }catch(PDOException $e){
            throw new Exception("Error al obtener propiedades: " . $e->getMessage());                     
        }   
    }
    
    public function get_Cargar($email){// metodo para caragar la informacion de productos del vendedor
        try{       // se hace asi la consulta para no pedir todos los resultados y que traiga los resultados del vendedor     
            $stmt = $this->conexion->prepare('SELECT propiedades.id_pro, propiedades.nombre_pro, 
            propiedades.tamanio_pro, propiedades.dormitorios_pro, propiedades.banios_pro, 
            propiedades.precio_pro, propiedades.tipo_pro, propiedades.img_pro, 
            propiedades.direccion_pro,
            propiedades.descripcion_pro FROM propiedades 
                                    INNER JOIN vendedores
                                    ON propiedades.id_vendedor = vendedores.id    
                                    WHERE vendedores.email = :email');
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);            
            return $resultados;
            
        }catch(PDOException $e){
            throw new Exception("Error al cargar propiedades: " . $e->getMessage());
        }   
    }

    public function set_CrearPropiedad($nombre, $tamanio, $dormitorios, $banios, $precio, $tipo, $imagen, $direccion, $descripcion, $idVendedor){//crea una propiedad con los datos pasados
        try{
        $stmt = $this->conexion->prepare("INSERT INTO propiedades(nombre_pro, tamanio_pro, dormitorios_pro, banios_pro, precio_pro, tipo_pro, img_pro, direccion_pro, descripcion_pro, id_vendedor) 
        VALUES(:nombre_pro,:tamanio_pro,:dormitorios_pro,:banios_pro,:precio_pro,:tipo_pro,:img_pro,:direccion_pro,:descripcion_pro,:id_vendedor)");
        $stmt->bindParam(":nombre_pro", $nombre);
        $stmt->bindParam(":tamanio_pro", $tamanio);
        $stmt->bindParam(":dormitorios_pro", $dormitorios);
        $stmt->bindParam(":banios_pro", $banios);
        $stmt->bindParam(":precio_pro", $precio);
        $stmt->bindParam(":tipo_pro", $tipo);
        $stmt->bindParam(":img_pro", $imagen);
        $stmt->bindParam(":direccion_pro", $direccion);
        $stmt->bindParam(":descripcion_pro", $descripcion);
        $stmt->bindParam(":id_vendedor", $idVendedor);
        $resultado=$stmt->execute();            
        return $resultado;             
        }catch(PDOException $e){
            throw new Exception("Error al crear propiedad: " . $e->getMessage());
        }
    }

    public function get_PropiedadesById($id){ // obtienes las propiedades por id
        try{
            $stmt = $this->conexion->prepare("SELECT * FROM propiedades WHERE id_pro=:id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return  $resultados;
        }catch(PDOException $e){
            throw new Exception("Error al obtener propiedad: " . $e->getMessage());            
        }
    }

    public function set_PropiedadesById($id, $nombre,$tamanio,$dormitorios,$banios, $precio,$tipo,$img,$direccion, $descripcion, $idVendedor){//Modifica una propiedad por su id        
        try{
            $stmt = $this->conexion->prepare("UPDATE propiedades SET nombre_pro=:nombre_pro,tamanio_pro=:tamanio_pro, dormitorios_pro=:dormitorios_pro,
                                    banios_pro=:banios_pro, precio_pro=:precio_pro,tipo_pro=:tipo_pro, img_pro=:img_pro, direccion_pro=:direccion_pro,descripcion_pro=:descripcion_pro,id_vendedor=:id_vendedor WHERE id_pro=:id");
            $stmt->bindParam(":id", $id);
            $stmt->bindParam(":nombre_pro", $nombre);
            $stmt->bindParam(":tamanio_pro", $tamanio);
            $stmt->bindParam(":dormitorios_pro", $dormitorios);
            $stmt->bindParam(":banios_pro", $banios);
            $stmt->bindParam(":precio_pro", $precio);
            $stmt->bindParam(":tipo_pro", $tipo);
            $stmt->bindParam(":img_pro", $img);
            $stmt->bindParam(":direccion_pro", $direccion);
            $stmt->bindParam(":descripcion_pro", $descripcion);
            $stmt->bindParam(":id_vendedor", $idVendedor);
            $resul=$stmt->execute();
            return $resul;            
        }catch(PDOException $e){
            throw new Exception("Error al actualizar propiedad: " . $e->getMessage());           
        }
    }

    public function delete_PropiedadesById($id){  //borra una propiedad por el id 
        try{
            $stmt = $this->conexion->prepare("DELETE FROM propiedades WHERE id_pro=:id");
            $stmt->bindParam(":id", $id);
            $stmt->execute();            
        }catch(PDOException $e){
            throw new Exception("Error al eliminar propiedad: " . $e->getMessage());           
        }
    }

    public function get_PropiedadesByFiltro($filtro,$idVendedor){// Ordena las propiedades por el filtro
        try{
            if($filtro==="precio"){// condicional que permite escoger la select para cada filtro
                $sql = "SELECT * FROM propiedades WHERE id_vendedor=:id_vendedor ORDER BY precio_pro";
            }
            elseif ($filtro=="nombre"){
                $sql = "SELECT * FROM propiedades WHERE id_vendedor=:id_vendedor ORDER BY nombre_pro";
            }else{
                $sql = "SELECT * FROM propiedades WHERE id_vendedor=:id_vendedor ORDER BY tipo_pro";
            }            
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id_vendedor', $idVendedor);            
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return  $resultados;
        }catch(PDOException $e){
            throw new Exception("Error al obtener propiedad: " . $e->getMessage());            
        }
    }

    public function crearImagenes($img){ // metodo para crear los nombres de las imagenes que se almacenan en la base de datos
        $carpeta = 'asset/img/';
        $imagen = md5(uniqid(rand())).'.jpg';
        move_uploaded_file($img['tmp_name'], $carpeta.$imagen);
        return $imagen;    
    }

    public function contarPropiedades($email){//metodo para poder contar las propiedades por usuario
        try{
            $stmt = $this->conexion->prepare("SELECT COUNT(*) FROM propiedades INNER JOIN vendedores ON 
                                        propiedades.id_vendedor = vendedores.id WHERE vendedores.email = :email");
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $resultados = $stmt->fetchColumn();
            return $resultados;
        }catch(PDOException $e){
            throw new Exception("Error al contar propiedades: " . $e->getMessage());            
        }
    }
    
}

?>