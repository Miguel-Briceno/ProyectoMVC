<?php
class Validaciones{// class validaciones
    
    public function validarEmail($email){// metodo para validar email
            $email = trim($email);//  elimina espacios en blanco al principio y al final
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);//  Elimina carácteres no permitidos
            $resultado = filter_var($email, FILTER_VALIDATE_EMAIL);//  Valida e-mail
            return $resultado;
    }
    
    public function validarContrasenia($contrasenia){// metodo para validar contraseña
        try { 
            $informacion=[];
            $contrasenia = trim($contrasenia);// elimina espacios en blanco
            if (strlen($contrasenia) < 8 || strlen($contrasenia) > 16) {// comprueba que la contraseña tenga al menos 8 caracteres
                $informacion[]="La contraseña debe tener más de 7 carácteres y debe tener menos de 16";
            }
            if (!preg_match('/^(?=.*[A-Z]).+$/', $contrasenia)) {// comprueba que la contraseña tenga al menos una letra mayúscula
                $informacion[]="La contraseña debe tener al menos una letra mayúscula";
            }
            if (!preg_match('/^(?=.*[a-z]).+$/', $contrasenia)) {//comprueba que la contraseña tenga al menos una letra minúscula
                $informacion[]="La contraseña debe tener al menos una letra minúscula";
            }
            if (!preg_match('/^(?=.*[0-9]).+$/', $contrasenia)) {//  comprueba que la contraseña tenga al menos un número
                $informacion[]="La contraseña debe tener al menos un número";
            }
            if (!preg_match('/^(?=.*[\W_]).+$/', $contrasenia)) {//  comprueba que la contraseña tenga al menos un carácter especial
                $informacion[]="La contraseña debe tener al menos un carácter especial";
            }
            if (!empty($informacion)) {
                return $informacion;
            }
            return true;
        } catch (ErrorException $e) {
            echo "Error en la validación de la contraseña: " . $e->getMessage();
        }
    }
    
    public function contraseniaCorrecta($contrasenia, $contrasenaDB){//  funccion contraseña correcta
        $passVerificado = password_verify($contrasenia, $contrasenaDB);
        if ($passVerificado) {
            return true;
        }
    }

    public function validarNombre($nombre){//validar normbre propiedad
        if(isset($nombre) && !empty($nombre) && strlen($nombre)>=3 && strlen($nombre)<=45 && is_string($nombre)){
            return true;
        }else{
            return false;
        }
    }

    public function validarTamanio($tamanio){//validar tamanio propiedad
        if(isset($tamanio) && !empty($tamanio) && $tamanio>=1 && $tamanio<=10000 && is_numeric($tamanio)){
            return true;
        }else{
            return false;
        }
    }

    public function validarDormitorios($dormitorios){//validar $dormitorios propiedad
        if(isset($dormitorios) && !empty($dormitorios) &&  $dormitorios>0 &&  $dormitorios<=10 && is_numeric($dormitorios)){
            return true;
        }else{
            return false;
        }
    }

    public function validarBanios($banios){//validar baños propiedad
        if(isset($banios) && !empty($banios) && $banios>0  && $banios<=10 && is_numeric($banios)){
            return true;
        }else{
            return false;
        }
    }

    public function validarPrecio($precio){//validar precio propiedad
        if(isset($precio) && !empty($precio) && $precio>1 && is_numeric($precio)&& $precio < 100000000){
            return true;
        }else{
            return false;
        }
    }

    public function validarTipo($tipo){//validar tipo propiedad
        if(isset($tipo) && !empty($tipo) && is_string($tipo)){
            return true;
        }else{
            return false;
        }
    }

    public function validarImg($img){//validar img propiedad
        if(isset($img['name']) && !empty($img['name']) ){
            return true;
        }else{
            return false;
        }
    }

    public  function validarDireccion($direccion){//validar direccion propiedad
        if(isset($direccion) && !empty($direccion) && strlen($direccion)>=3 && strlen($direccion)<=100 && is_string($direccion)){
            return true;
        }else{
            return false;
        }
    }

    public  function validarDescripcion($descripcion){//validar descripcion propiedad
        if(isset($descripcion) && !empty($descripcion) && strlen($descripcion)>=10 && strlen($descripcion)<=300 && is_string($descripcion)){
            return true;
        }else{
            return false;
        }
    }
    
}
?>