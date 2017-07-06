<?php
session_start();
$tipo = $_GET['tipo'];
include 'comprobaciones.php';
include_once('../util.php');
$con = conexion();
switch ($tipo) {
  case '1':
    registrarUsuario($con);
    break;
  case '2':
    registrarVip($con);
    break;
  default:
    echo "Error";
    break;
}
function registrarUsuario($con){
  $nuser = $_POST['nombreUsu'];
  $npassword = $_POST['password'];
  $npasswordConfirmacion = $_POST['passwordConfirmacion'];
  $nnombre = $_POST['nombre'];
  $napellidos = $_POST['apellidos'];
  $nciudad = $_POST['ciudad'];
  $nemail = $_POST['email'];
  $ntelefono = $_POST['telefono'];
  $nsexo = $_POST['sexo'];
  $nfechaNacimiento = $_POST['fechaNacimiento'];
  
  //añadir campo para pagar
  
  if(comprobarNombreUsuario($nuser) & comprobarPassword($npassword, $npasswordConfirmacion) & comprobarEmail($nemail) & comprobarTelefono($ntelefono)){
      // Ciframos la contraseña
      //$npassword = crypt($npassword);
      $npassword = encriptar($npassword);
      $insert = "insert into usuario (nombre_usu, pass_usu, email, tipo, ciudad, telefono, nombre)
              values ('$nuser', '$npassword', '$nemail', 1, $nciudad, '$ntelefono', '$nnombre')";
          
     
          }
      
      else{
          echo mysqli_error($con);
      }
      $consulta = "select idusuario from usuario where nombre_usu='$nuser'";
      $resultado = mysqli_query($con, $consulta);
      $num_filas = mysqli_num_rows($resultado);
      if($num_filas==0)
          echo "No existe ese usuario con ese password<br/>";
      else{
          $fila = mysqli_fetch_array($resultado);
          extract($fila);
          $_SESSION['idusuario'] = $idusuario;
          $_SESSION['nombre'] = $nuser;
          $_SESSION['tipo'] = 1;
        }
      echo "</br><a href='../perfil/usuario.php'>Ir a tu perfil</a>";
  
   if(mysqli_query($con, $sql)){
              echo"Usuario $nuser dado de alta";
          }
  else{
      echo "</br><a href='registrarUsuario.php'>Volver a la pagina de registro.</a>";
  }
}

function registrarVip($con){
   $nuser = $_POST['nombreUsu'];
  $npassword = $_POST['password'];
  $npasswordConfirmacion = $_POST['passwordConfirmacion'];
  $nnombre = $_POST['nombre'];
  $napellidos = $_POST['apellidos'];
  $nciudad = $_POST['ciudad'];
  $nemail = $_POST['email'];
  $ntelefono = $_POST['telefono'];
  $nsexo = $_POST['sexo'];
  $nfechaNacimiento = $_POST['fechaNacimiento'];
  
  if(comprobarNombreUsuario($nuser) & comprobarPassword($npassword, $npasswordConfirmacion) & comprobarEmail($nemail) & comprobarTelefono($ntelefono)){
      // Ciframos la contraseña
      //$npassword = crypt($npassword);
      $npassword = encriptar($npassword);
      $insert = "insert into usuario (nombre_usu, pass_usu, email, tipo, ciudad, telefono, nombre)
              values ('$nuser', '$npassword', '$nemail', 1, $nciudad, '$ntelefono', '$nnombre')";
          
     
          }
      
      else{
          echo mysqli_error($con);
      }
      
      }
       $consulta = "select idusuario from usuario where nombre_usu='$nuser'";
      $resultado = mysqli_query($con, $consulta);
      $num_filas = mysqli_num_rows($resultado);
      if($num_filas==0)
          echo "No existe ese usuario con ese password<br/>";
      else{
          $fila = mysqli_fetch_array($resultado);
          extract($fila);
          $_SESSION['idusuario'] = $idusuario;
          $_SESSION['nombre'] = $nuser;
          $_SESSION['tipo'] = 1;
        }
      echo "</br><a href='../perfil/usuario.php'>Ir a tu perfil</a>";
  
   if(mysqli_query($con, $sql)){
              echo"Usuario $nuser dado de alta";
          }
  else{
      echo "</br><a href='registrarUsuario.php'>Volver a la pagina de registro.</a>";
  
  }
mysqli_close($con);