<?php

$usuario=htmlentities($_POST["usuario"]);
$contraseña=htmlentities($_POST["contraseña"]);




$sane = "";
$forbidden_chars = array(
    "?", "[", "]", "/", "\\", "=", "<", ">", ":", ";", ",", "'", "\"", "&",
    "$", "#", "*", "(", ")" , "|", "~", "`", "!", "{", "}", "%", "+" , chr(0));
$replace_chars = array('áéíóúäëïöüàèìòùñ ','aeiouaeiouaeioun_');




session_start();
$_SESSION["usuario"]=$usuario;

include("db.php");

#$conexion = mysqli_connect("localhost", "root", "12345678", "login");
#$consulta = "SELECT id FROM EMPLOYEE WHERE usuario = '$usuario' AND contraseña = ''";

$consulta="SELECT*FROM EMPLOYEE where usuario='$usuario' and contraseña='$contraseña'";
/*$query = $db->prepare('SELECT id FROM usuarios WHERE login = ? AND passwd = ?');*/
#$resultado = $db->fetch($consulta);
$resultado=mysqli_query($conexion, $consulta);
$filas=mysqli_num_rows($resultado);

if($filas){
    header("location:home.php");

}else{
    ?>
    <?php
    include("index.php");
    ?>
    <h1 class="bad">ERROR EN LA AUTENTIFICACIÓN</h1>
    <?php
}
mysqli_free_result($resultado);
mysqli_close($conexion);