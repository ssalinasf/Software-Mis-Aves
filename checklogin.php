<?php
session_start();
require_once("db_const.php");
$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
}

$rut = $_POST['rut'];
$password = $_POST['password'];

$sql = "SELECT * from usuario WHERE usu_rut LIKE '{$rut}' AND usu_contra LIKE '{$password}' LIMIT 1";
//$sql = "SELECT * FROM $tbl_name WHERE nombre_usuario = '$rut'";;
$result = $conexion->query($sql);
if ($result->num_rows > 0) {

    $row = $result->fetch_array(MYSQLI_ASSOC);
    $_SESSION['loggedin'] = true;
    $_SESSION['rut'] = $rut;
    $_SESSION['username'] = $row['usu_nombre'];
    $_SESSION['cargo'] = $row['usu_cargo'];
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
    echo $_SESSION['username'];
    header('Location: index.php');
 } else {
   echo "rut o Password estan incorrectos.";

   echo "<br><a href='login.php'>Volver a Intentarlo</a>";
 }
 mysqli_close($conexion);
 ?>
