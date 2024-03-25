<?php
require_once "Validaciones_model.php";
require_once "ConexionDB_model.php";
class User{// clase usuario para el login y registro 
    private $conexion;//variable de conexion
    public function __construct(){//metodo contructor 
        $this->conexion = ConexionDB::get_ObtenerConexion(); //inicializacion de la variable      
    }    
    
    public function getId($email){ // Metodo para devolver id
        try{            
            $sentencia =$this->conexion->prepare("SELECT id FROM vendedores WHERE email=?;");//consulta preparada
            $sentencia->bindParam(1, $email, PDO::PARAM_STR);// variable asignada a un marcador
            $sentencia->execute(); //ejecucion de la sentencia
            $resultados = $sentencia->fetch(PDO::FETCH_ASSOC); // resultado del registro encontrado
            return $resultados['id']; //retorno del campor id en el registro encontrado
        }catch(Exception $e){
            throw new Exception("Error al obtener el Id del usuario: " . $e->getMessage());
        }       
    }

    public function set_registrar($email,$contrasenia){ // Metodo regitrar
        try{
            $stmt = $this->conexion->prepare("INSERT INTO vendedores(email, contrasenia) VALUES(:email,:contrasenia)");
            $stmt->bindParam(":email", $email);
            $stmt->bindParam(":contrasenia", $contrasenia);
            $resultado=$stmt->execute();            
            return $resultado; //retorna el resultado           
        }catch(Exception $e){
            throw new Exception("Error al registrar usuario: " . $e->getMessage());
        }
    }

    public function comprobarUsuario($email){// Metodo comprobar usuario y recibe por parametro un $email
        try{            
            $sentencia = $this->conexion->prepare("SELECT * FROM vendedores WHERE email=:email;");
            $sentencia->bindParam(":email", $email);
            $sentencia->execute();
            $resultados = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultados;   // retorna el resultado  
            }catch(PDOException $e){
                throw new Exception("Error al comprobar usuario: " . $e->getMessage()); 
            }
    }

}
