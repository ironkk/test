<?php


session_start();
$usuario = $_POST['usuario'];
$password = $_POST['password'];
include('util.php');
$password = encriptar($password);
$con = conexion();
$consulta = "select * from usuario where nombre_usu='$usuario' and pass_usu='$password'";
$resultado = mysqli_query($con, $consulta);
$num_filas = mysqli_num_rows($resultado);
if($num_filas==0){
    $mensaje = "No existe ese usuario con ese password<br/>";
    include('error/errorlogin.php');
}
else{
    $fila = mysqli_fetch_array($resultado);
    extract($fila);
    $_SESSION['idusuario'] = $idusuario;
    $_SESSION['nombre'] = $nombre_usu;
    $_SESSION['tipo'] = $tipo;
    switch ($tipo) {
        case 1:
        header('Location: perfil/usuario.php');
        break;
        case 2:
        header('Location: perfil/vip.php');
        break;

      default:
        echo "ERROR";
        break;
    }
}
?>

