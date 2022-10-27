<?php
$correo = $_GET["email"];
$contraseña = $_GET["password"];

echo "<h2>Informacion del usuario</h2>";
echo "Correo: ". $correo. "<br>";
echo "Contraseña: ". $contraseña. "<br>";
?>