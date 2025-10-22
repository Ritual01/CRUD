<?php
define('DB_HOST', '172.30.15.41');   
define('DB_USER', 'admin');       
define('DB_PASS', 'contrasena1');           
define('DB_NAME', 'agenda');    

$mysqli = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($mysqli->connect_errno) {
  http_response_code(500);
  die("Error de conexión a la base de datos: " . $mysqli->connect_error);
}
$mysqli->set_charset('utf8mb4');
?>
