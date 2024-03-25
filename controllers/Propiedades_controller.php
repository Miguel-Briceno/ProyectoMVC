<?php

// requiere el modelo siguiente
require_once('models/User_model.php');
require_once('models/Propiedades_model.php');

// clase accion controller que es requerida por el index del proyecto
class ControllerPropiedades{
    private $propiedad;//variable
    private $validacion;//variable
    public $informacion = [];// array con la informacion de errores y otras
    public function __construct(){    
        $this->propiedad = new Propiedad();// se crea un objeto de la instancia de la clase propiedad
        // usuario y se inicializa con varibale de la clase
        $this->validacion = new Validaciones();// se crea un objeto de la instancia de la clase Validaciones
        // usuario y se inicializa con varibale de la clase        
    }

    public function cargar($usuario){// metodo cargar     
        $resultados = $this->propiedad->get_Cargar($usuario); // cargar propiedades por usuario         
        $contador = $this->propiedad->contarPropiedades($usuario);// cuenta las propiedades por usuario
        if(isset($_COOKIE['contador'])){// con un condicional veo si la cookie existe o no, y sino se crea 
            $_COOKIE['contador']=$contador;  //la cookie almacena el valor de la funcion.
        }else{
            setcookie('contador',$contador,time() + 3600);
        }        
        require_once 'views/propiedad/propiedades.php';// llama a la vista
        exit;        
    }
    
    public function agregar(){// metodo agregar para facilitarnos el formulario
        require_once "views/propiedad/agregar.php";
    }

    public function addPropiedad(){// metodo para agregar a la bbdd una propiedad
        try{
            if(isset($_GET['accion']) && $_POST['addPropiedad']=='salvar'){                
                $correcto = $this->validacion->validarNombre($_POST['nombre']);//validaciones
                if(!$correcto){
                    $informacion[]="Debe ingresar un nombre válido";                    
                }                
                $correcto = $this->validacion->validarTamanio($_POST['tamanio']);
                if(!$correcto){
                    $informacion[]="Debe ingresar un tamanio válido";                    
                }
                $correcto = $this->validacion->validarDormitorios($_POST['dormitorios']);
                if(!$correcto){
                    $informacion[]="Debe ingresar un numero de dormitorios válido";                    
                }                
                $correcto = $this->validacion->validarBanios($_POST['banios']);
                if(!$correcto){
                    $informacion[]="Debe ingresar un numero de baños válido";                   
                }                
                $correcto = $this->validacion->validarPrecio($_POST['precio']);
                if(!$correcto){
                    $informacion[]="Debe ingresar un precio válido";                   
                }               
                $correcto = $this->validacion->validarTipo($_POST['tipo']);
                if(!$correcto){
                    $informacion[]="Debe ingresar un tipo válido";                    
                }
                $correcto = $this->validacion->validarImg($_FILES['img']);                
                if(!$correcto){                  
                    $informacion[]="Debe ingresar una imagen válido";
                }  
                $imagen = $this->propiedad->crearImagenes($_FILES['img']);              
                $correcto = $this->validacion->validarDireccion($_POST['direccion']);
                if(!$correcto){
                    $informacion[]="Debe ingresar una direccion válida";                    
                }              
                $correcto = $this->validacion->validarDescripcion($_POST['descripcion']);
                if(!$correcto){
                    $informacion[]="Debe ingresar una descripcion válida";
                } 
                if ( !empty($informacion)){// si no esta vacio llama a la vista y muestra el error
                    require_once "views/propiedad/agregar.php";
                    exit;
                }
                $idVendedor = $_SESSION['id'];
                //se crea la propiedad                
                $resultados=$this->propiedad->set_CrearPropiedad($_POST['nombre'],$_POST['tamanio'],$_POST['dormitorios'],$_POST['banios'],$_POST['precio'],$_POST['tipo'],$imagen,$_POST['direccion'],$_POST['descripcion'],$idVendedor);
                if($resultados=true){
                    //array session con la informacion para mostrar 
                    $_SESSION["agregada"] = "La propiedad ha sido agregada con exito!!!";                   
                    $this->cargar($_SESSION['usuario']);// se pueden cargar las propiedades por el id y se reutiliza el codigo
                }
            }else{$informacion []= "Datos de producto faltantes o inválidos";}
        }catch (Exception $e) { 
            throw new Exception("Error al obtener propiedades del usuario: " . $e->getMessage());                
        }

    }
    
    public function editar(){//Metodo que muestra los datos de la propiedad para ser editados
        try{            
            if(isset($_GET['accion'])&& $_GET['accion']=='editar'){
                $id = $_GET['id']; 
                // se obtiene la propiedad por el id y se pasa a la vista               
                $resultados = $this->propiedad->get_PropiedadesById($id);
                require_once "views/propiedad/editar.php";
                exit;
            }
        }
        catch (Exception $e) {
            throw new Exception("Error al editar propiedad: " . $e->getMessage());            
        }
    }
    
    public function actualizar(){// metodo actualizar se reciben los datos y se validan
            if(isset($_POST['accion'])&& $_POST['accion']=='Editar'){
                $id = $_POST['id_pro'];                
                $correcto = $this->validacion->validarNombre($_POST['nombre_pro']);//validaciones
                if(!$correcto){
                    $informacion[]="Debe ingresar un nombre válido";                             
                }                
                $nombre = $_POST['nombre_pro'];
                                
                $correcto = $this->validacion->validarTamanio($_POST['tamanio_pro']);
                if(!$correcto){
                    $informacion[]="Debe ingresar un tamanio válido";
                }
                $tamanio = $_POST['tamanio_pro'];
                $correcto = $this->validacion->validarDormitorios($_POST['dormitorios_pro']);
                if(!$correcto){
                    $informacion[]="Debe ingresar un numero de dormitorios válido";                    
                }
                $dormitorios = $_POST['dormitorios_pro'];                
                $correcto = $this->validacion->validarBanios($_POST['banios_pro']);
                if(!$correcto){
                    $informacion[]="Debe ingresar un numero de baños válido";                           
                }
                $banios = $_POST['banios_pro'];                
                $correcto = $this->validacion->validarPrecio($_POST['precio_pro']);
                if(!$correcto){
                    $informacion[]="Debe ingresar un precio válido";                    
                }
                $precio = $_POST['precio_pro'];               
                $correcto = $this->validacion->validarTipo($_POST['tipo_pro']);
                if(!$correcto){
                    $informacion[]="Debe ingresar un tipo válido";
                }
                $tipo = $_POST['tipo_pro'];                
                $correcto = $this->validacion->validarImg($_FILES['img_pro']);                
                if(!$correcto){
                    $informacion[]="Debe cargar una imagen";                            
                }
                $imagen = $this->propiedad->crearImagenes($_FILES['img_pro']);
                $img = $imagen;        
                $correcto = $this->validacion->validarDireccion($_POST['direccion_pro']);
                if(!$correcto){
                    $informacion[]="Debe ingresar una direccion válida";                   
                }
                $direccion = $_POST['direccion_pro'];              
                $correcto = $this->validacion->validarDescripcion($_POST['descripcion_pro']);
                if(!$correcto){
                    $informacion[]="Debe ingresar una descripcion válida";                    
                } 
                $descripcion = $_POST['descripcion_pro'];
                $idVendedor = $_POST['id_vendedor'];  
                if (!empty($informacion)){// si no esta vacio llama a la vista y muestra el error
                $resultados = $this->propiedad->get_PropiedadesById($id);
                require_once "views/propiedad/editar.php";
                exit;
                }               
                $resultados = $this->propiedad->set_PropiedadesById($id, $nombre,$tamanio,$dormitorios,$banios, $precio,$tipo,$img,$direccion, $descripcion, $idVendedor);
                if($resultados==true){//condicional que evalua la condicion
                    //array para mostrar la informacion
                    $_SESSION["editada"] = "La propiedad ha sido editada con exito!!!";
                    $this->cargar($_SESSION['usuario']); // se carga la pagina y se llama a la vista        
                    
                }else{$informacion[]= "Datos de producto faltantes o inválidos";}
            }else{$informacion[]= "Datos de producto faltantes o inválidos";}
        
    }

    public function corroborar(){//metodo que llama la propiedad que se va a eliminar            
            if(isset($_GET['accion'])&& $_GET['accion']=='corroborar'){
                $id_pro = $_GET['id']; 
                //llama la propiedad por id de la propiedad y la muestra               
                $resultado = $this->propiedad->get_PropiedadesById($id_pro);                
                require_once 'views/propiedad/eliminar.php'; 
                exit;               
            }
    }
    
    public function eliminar(){// metodo eliminar
        try{
            if(isset($_GET['accion'])&& $_GET['accion']=='eliminar'){            
                $id = $_GET['id']; 
                //elimina la propiedad por id si se cumple con la condicion            
                $resul = $this->propiedad->delete_PropiedadesById($id);
                $_SESSION["eliminada"] = "La propiedad ha sido eliminada con exito!!!";                
                $this->cargar($_SESSION['usuario']);
            }else{$informacion[]="Datos de producto faltantes o inválidos";}
        }
        catch (Exception $e) {
            throw new Exception("Error al eliminar propiedad: " . $e->getMessage());           
        }
    }
    
    public function cerrarSession(){// metodo que nos permite cerrar la session
        session_unset(); //elimina las variables de sesión
        session_destroy();//destruye las variables de sesión
        header('Location: index.php');
        exit;
    }

    public function atras(){// metodo que nos permite ir hacia atras en las vistas de producto
        // carga los resultados de sesion del usuario con sus propiedades
        $this->cargar($_SESSION['usuario']);
    }

    public function filtrar(){//metodo para filtrar pos tres campos precio, tipo, nombre
        if($_POST['realizar']==="filtro"){
            //condicion e inicializacion de la variable filtro
            isset($_POST['filtro'])?$filtro = $_POST['filtro']:"";
            $idVendedor = $_SESSION['id'];
            // se llama a la funcion get_PropiedadesByFiltro y se pasa el filtro y el id del vendedor            
            $resultados = $this->propiedad->get_PropiedadesByFiltro($filtro,$idVendedor);
            require_once "views/propiedad/propiedades.php";
        }
    }

    public function ver(){//Metodo para Visualizar la propiedad seleccionada
        if(isset($_GET['accion'])&& $_GET['accion']=='ver'){
            $id = $_GET['id'];
            //se obtiene la propiedad por el id y se muestra          
            $resultados = $this->propiedad->get_PropiedadesById($id);
            require_once "views/propiedad/ver.php";
        }
    }

    public function no(){//Metodo para ir atras cuando no se quiere eliminar la propiedad
        $this->cargar($_SESSION['usuario']);        
    }
    

}
?>