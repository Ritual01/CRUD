<?php
require __DIR__.'/config.php';

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

  //Validaciones simples: solo campos vacíos
  if ($nombres === '') $errors[] = 'Nombres es obligatorio';
  if ($apaterno === '') $errors[] = 'Apellido paterno es obligatorio';
  if ($amaterno === '') $errors[] = 'Apellido materno es obligatorio';
  if ($genero === '') $errors[] = 'Género es obligatorio';
  if ($fecha_nacimiento === '') $errors[] = 'Fecha de nacimiento es obligatoria';
  if ($telefono === '') $errors[] = 'Teléfono es obligatorio';
  if ($email === '') $errors[] = 'Email es obligatorio';
  if ($linkedin === '') $errors[] = 'LinkedIn es obligatorio';

  if (!$errors) {
    $stmt = $mysqli->prepare("INSERT INTO contacto (nombres, apaterno, amaterno, genero, fecha_nacimiento, telefono, email, linkedin) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param('ssssssss', $nombres, $apaterno, $amaterno, $genero, $fecha_nacimiento, $telefono, $email, $linkedin);
    if ($stmt->execute()) {
      header('Location: index.php');
      exit;
    } else {
      $errors[] = 'Error al guardar: ' . $mysqli->error;
    }
  }
}

include __DIR__.'/header.php';
?>
<div class="card">
  <h2>Nuevo contacto</h2>
  <?php if ($errors): ?>
    <div class="notice"><?php echo implode('<br>', array_map('htmlspecialchars', $errors)); ?></div>
  <?php endif; ?>
  <form method="post" class="grid">
    <div>
      <label>Nombres</label>
      <input name="nombres" required>
    </div>
    <div>
      <label>Apellido paterno</label>
      <input name="apaterno" required>
    </div>
    <div>
      <label>Apellido materno</label>
      <input name="amaterno" required>
    </div>
    <div>
      <label>Género</label>
      <select name="genero" required>
        <option value="M">Masculino</option>
        <option value="F">Femenino</option>
      </select>
    </div>
    <div>
      <label>Fecha de nacimiento (YYYY-MM-DD)</label>
      <input name="fecha_nacimiento" placeholder="2000-12-31" required>
    </div>
    <div>
      <label>Teléfono</label>
      <input name="telefono" required>
    </div>
    <div>
      <label>Email</label>
      <input name="email" type="email" required>
    </div>
    <div>
      <label>LinkedIn (URL)</label>
      <input name="linkedin" placeholder="https://www.linkedin.com/in/usuario" required>
    </div>
    <div>
      <button class="btn primary" type="submit">Guardar</button>
      <a class="btn" href="index.php">Cancelar</a>
    </div>
  </form>
</div>
<?php include __DIR__.'/footer.php'; ?>
