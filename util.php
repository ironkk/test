<?php

function encriptar($npassword){
  $salt      = 'a';
  $hashed    = hash('sha256', $npassword . $salt);
  return $hashed;
}
function conexion(){
    $con = mysqli_connect("localhost", "root", "", "easygig") or die("No se ha podido conectar con la base de datos.");
    return $con;
}
function cerrarSesion(){
  session_destroy;
}
?>