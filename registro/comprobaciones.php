<?php

function comprobarNombreUsuario($nombreUsuario){ 
    
//Comprobaciones del nombre de usuario

    include_once('../util.php');
    $con = conexion();
    //Comprobar si ya existe usuario en la base de datos
    $consulta = "select nombre_usu from usuario where nombre_usu = '$nombreUsuario'";
    $resultado = mysqli_query($con, $consulta);
    if ($resultado->num_rows >= 1){
        $correcto = false;
        echo "Este nombre de usuario ya existe.";
    } else {
        $correcto = true;
        //Min y max de caracteres
        if(strlen($nombreUsuario) < 9999){
            $correcto = true;
        }
        else{
            $correcto = false;
            $mensaje = "El nombre de usuario no cumple los requisitos de longitud.</br>";
            include('../error/error.php');
        }
        //Palabras ofensivas
    }
    mysqli_close($con);
    return $correcto;  //devuelve el boolean de si las comprobaciones son correctas o no.
}
function comprobarPassword($password, $passwordConfirmacion){ //Comprobaciones del password
    //Los dos campos de passwords deben ser iguales
    if($password == $passwordConfirmacion){
        $correcto = true;
        //Min y max de caracteres
        if(strlen($password) < 30 && strlen($password) > 4)
            $correcto = true;
        else{
            $correcto = false;
            $mensaje = "El password no cumple los requisitos de longitud.</br>";
            include('../error/error.php');
        }
    }
    else{
        $correcto = false;
        $mensaje = "Los passwords no coinciden.</br>";
        include('../error/error.php');
    }
    return $correcto;  //devuelve el boolean de si las comprobaciones son correctas o no.
}
function comprobarEmail($email){ //Comprobaciones del email
    // require_once("conexion.php");
    include_once('../util.php');
    $con = conexion();
    //Que no este ya registrado en la base de datos
    $consulta = "select email from usuario where nombre_usu = '$email'";
    $resultado = mysqli_query($con, $consulta);
    if ($resultado->num_rows >= 1) {
        $correcto = false;
        $mensaje = "Este email ya esta registrado. </br>";
        include('../error/error.php');
    } else {
        $correcto = true;
        //Comprobar que tenga el formato correcto
    }
    return $correcto;  //devuelve el boolean de si las comprobaciones son correctas o no.
}
function comprobarTelefono($telefono){ //Comprobaciones del telefono
    //$con = mysqli_connect("localhost", "root", "", "easygig") or die("No se ha podido conectar con la base de datos.");
    //Comprobar que solo sean numeros
    if (!ctype_digit($telefono)){
        if(empty($telefono))
            $correcto = true;
        else{
            $correcto = false;
            $mensaje = "El telefono contiene caracteres no numericos.";
            include('../error/error.php');
        }
    }else
        $correcto = true;
    return $correcto;  //devuelve el boolean de si las comprobaciones son correctas o no.
}

?>