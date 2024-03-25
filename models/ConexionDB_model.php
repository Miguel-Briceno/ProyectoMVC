<?php
require_once 'config/DBconfig.php';
class ConexionDB{// la clase de conexion a la base de datos
    private static $conexion; // atributo de la clase   
    
    public function __construct(){}// metodo contructor de la clase no se puede iterar

    public static function get_ObtenerConexion(){// metodo de la clase para conectarse
        //asignacion de variables
        $host = HOST;
        $user = USER;
        $password = PASSWORD;
        $dbname = DBNAME;        
        try {// Metodo try cacth para tratar las distintas exepciones
            // variable conexion que guarda el nuevo obejo de conexion a la base datos
            self::$conexion = new PDO('mysql:host=' . $host . '; dbname=' . $dbname, $user, $password);
            // configuracion de los valores de los atributos para el manejo de errores 
            self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // desactiva la emulacion de preparacion de consultas los errores son capturados
            // por el bloque cacth
            self::$conexion->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        } catch (PDOException $e) {
            throw new Exception("Error al conectar a la base de datos: " . $e->getMessage());
        }
        return self::$conexion;
    }
    
    public static function cerrarConexion(){// metodo de la clase para cerrar la conexion
        self::$conexion = null;
    }
    
    public function __destruct(){//metodo para cerrar la conexion cuando el objeto ya no este usando la bbdd
        self::cerrarConexion();
    }
}
?>