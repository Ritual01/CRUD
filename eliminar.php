<?php
require __DIR__.'/config.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') { http_response_code(405); die('Método no permitido'); }
$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
if ($id <= 0) { http_response_code(400); die('ID inválido'); }

$stmt = $mysqli->prepare("DELETE FROM contacto WHERE id=?");
$stmt->bind_param('i', $id);
$stmt->execute();
header('Location: index.php');
