<?php
require __DIR__.'/config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if ($id <= 0) { http_response_code(400); die('ID inválido'); }

// Cargar datos actuales
$stmt = $mysqli->prepare("SELECT id, nombres, apaterno, amaterno, genero, fecha_nacimiento, telefono, email, linkedin FROM contacto WHERE id=?");
$stmt->bind_param('i', $id);
$stmt->execute();
$res = $stmt->get_result();
$item = $res->fetch_assoc();
if (!$item) { http_response_code(404); die('No encontrado'); }

$errors = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nombres = trim($_POST['nombres'] ?? '');
  $apaterno = trim($_POST['apaterno'] ?? '');
  $amaterno = trim($_POST['amaterno'] ?? '');
  $genero = $_POST['genero'] ?? 'O';
  $fecha_nacimiento = $_POST['fecha_nacimiento'] ?? '';
  $telefono = trim($_POST['telefono'] ?? '');
  $email = trim($_POST['email'] ?? '');
  $linkedin = trim($_POST['linkedin'] ?? '');

  if ($nombres === '') $errors[] = 'Nombres es obligatorio';
  if ($apaterno === '') $errors[] = 'Apellido paterno es obligatorio';
  if ($amaterno === '') $errors[] = 'Apellido materno es obligatorio';
  if (!in_array($genero, ['M','F','O'], true)) $errors[] = 'Género inválido';
  if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $fecha_nacimiento)) $errors[] = 'Fecha de nacimiento inválida (YYYY-MM-DD)';
  if ($telefono === '') $errors[] = 'Teléfono es obligatorio';
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = 'Email inválido';
  if ($linkedin === '' || !preg_match('/^https?:\/\//', $linkedin)) $errors[] = 'LinkedIn debe ser una URL válida';

  if (!$errors) {
    $stmt2 = $mysqli->prepare("UPDATE contacto SET nombres=?, apaterno=?, amaterno=?, genero=?, fecha_nacimiento=?, telefono=?, email=?, linkedin=? WHERE id=?");
    $stmt2->bind_param('ssssssssi', $nombres, $apaterno, $amaterno, $genero, $fecha_nacimiento, $telefono, $email, $linkedin, $id);
    if ($stmt2->execute()) {
      header('Location: index.php');
      exit;
    } else {
      $errors[] = 'Error al actualizar: ' . $mysqli->error;
    }
  }
}

include __DIR__.'/header.php';
?>
<div class="card">
  <h2>Editar contacto #<?php echo $item['id']; ?></h2>
  <?php if ($errors): ?>
    <div class="notice"><?php echo implode('<br>', array_map('htmlspecialchars', $errors)); ?></div>
  <?php endif; ?>
  <form method="post" class="grid">
    <div>
      <label>Nombres</label>
      <input name="nombres" value="<?php echo htmlspecialchars($item['nombres']); ?>" required>
    </div>
    <div>
      <label>Apellido paterno</label>
      <input name="apaterno" value="<?php echo htmlspecialchars($item['apaterno']); ?>" required>
    </div>
    <div>
      <label>Apellido materno</label>
      <input name="amaterno" value="<?php echo htmlspecialchars($item['amaterno']); ?>" required>
    </div>
    <div>
      <label>Género</label>
      <select name="genero" required>
        <option value="O" <?php echo $item['genero']=='O'?'selected':''; ?>>Otro</option>
        <option value="M" <?php echo $item['genero']=='M'?'selected':''; ?>>Masculino</option>
        <option value="F" <?php echo $item['genero']=='F'?'selected':''; ?>>Femenino</option>
      </select>
    </div>
    <div>
      <label>Fecha de nacimiento (YYYY-MM-DD)</label>
      <input name="fecha_nacimiento" value="<?php echo htmlspecialchars($item['fecha_nacimiento']); ?>" required>
    </div>
    <div>
      <label>Teléfono</label>
      <input name="telefono" value="<?php echo htmlspecialchars($item['telefono']); ?>" required>
    </div>
    <div>
      <label>Email</label>
      <input name="email" type="email" value="<?php echo htmlspecialchars($item['email']); ?>" required>
    </div>
    <div>
      <label>LinkedIn (URL)</label>
      <input name="linkedin" value="<?php echo htmlspecialchars($item['linkedin']); ?>" required>
    </div>
    <div>
      <button class="btn primary" type="submit">Guardar</button>
      <a class="btn" href="index.php">Cancelar</a>
    </div>
  </form>
</div>
<?php include __DIR__.'/footer.php'; ?>
