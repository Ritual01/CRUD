<?php
require __DIR__.'/config.php';

// Búsqueda simple
$term = isset($_GET['q']) ? trim($_GET['q']) : '';
$sql = "SELECT id, nombres, apaterno, amaterno, genero, fecha_nacimiento, telefono, email, linkedin FROM contacto";
$params = [];
if ($term !== '') {
  $sql .= " WHERE nombres LIKE ? OR apaterno LIKE ? OR amaterno LIKE ? OR email LIKE ?";
  $like = "%{$term}%";
  $params = [$like,$like,$like,$like];
}
$sql .= " ORDER BY id DESC";

$stmt = $mysqli->prepare($sql);
if ($params) {
  $stmt->bind_param(str_repeat('s', count($params)), ...$params);
}
$stmt->execute();
$res = $stmt->get_result();

include __DIR__.'/header.php';
?>
<div class="card">
  <div class="topbar">
    <h1>Agenda de Contactos</h1>
    <div>
      <a class="btn primary" href="nuevo.php">+ Nuevo contacto</a>
    </div>
  </div>
  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombres</th>
        <th>Ap. Paterno</th>
        <th>Ap. Materno</th>
        <th>Género</th>
        <th>Nacimiento</th>
        <th>Teléfono</th>
        <th>Email</th>
        <th>LinkedIn</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
    <?php while($row = $res->fetch_assoc()): ?>
      <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo htmlspecialchars($row['nombres']); ?></td>
        <td><?php echo htmlspecialchars($row['apaterno']); ?></td>
        <td><?php echo htmlspecialchars($row['amaterno']); ?></td>
        <td><?php echo htmlspecialchars($row['genero']); ?></td>
        <td><?php echo htmlspecialchars($row['fecha_nacimiento']); ?></td>
        <td><?php echo htmlspecialchars($row['telefono']); ?></td>
        <td><a href="mailto:<?php echo htmlspecialchars($row['email']); ?>"><?php echo htmlspecialchars($row['email']); ?></a></td>
        <td><a href="<?php echo htmlspecialchars($row['linkedin']); ?>" target="_blank">Perfil</a></td>
        <td class="actions">
          <a class="btn" href="editar.php?id=<?php echo $row['id']; ?>">Editar</a>
          <form style="display:inline" method="post" action="eliminar.php" onsubmit="return confirm('¿Eliminar este contacto?');">
            <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
            <button class="btn warn" type="submit">Eliminar</button>
          </form>
        </td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</div>
<?php include __DIR__.'/footer.php'; ?>
