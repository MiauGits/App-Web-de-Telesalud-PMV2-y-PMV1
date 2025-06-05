<?php
/* c(R)ud OPEN */
/* 1. Importación de conexión a la base de datos */
require '../../includes/config/database.php';
$db = conectarDB();

/* 2. Escribir el query */
$queryLeerEspecialidad = "SELECT * FROM tbl_especialidad";

/* 3. Consulta a la BDD */
$selectLeerEspecialidad = mysqli_query($db, $queryLeerEspecialidad);


/* c(R)ud CLOSE */

/* Mensaje condicional si se ha añadido una nueva especialidad */
$exitoAnadirEspecialidad = $_GET['exitoAnadirEspecialidad'] ?? null;

/* cru(D) OPEN (parte 2/2) */
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $id = filter_var($id, FILTER_VALIDATE_INT);

  if($id) {
    $queryEliminar = "DELETE FROM tbl_especialidad WHERE id_especialidad = $id";

    $resultadoQueryEliminar = mysqli_query($db, $queryEliminar);

    if($resultadoQueryEliminar) {
      header('Location: /admin/especialidades?exitoAnadirEspecialidad=3');
    }
  }
}
/* cru(D) CLOSE */

/* Inclusión de template */
require '../../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor">
  <h2 class="especialidades tituloh2">Especialidades disponibles / administrador</h2>

  <?php if(intval($exitoAnadirEspecialidad) === 1) : ?>
    <p class="alerta exito">Especialidad añadida correctamente</p>
  <?php elseif(intval($exitoAnadirEspecialidad) === 2) : ?>
    <p class="alerta exito">Cambios guardados correctamente</p>
  <?php elseif(intval($exitoAnadirEspecialidad) === 3) : ?>
    <p class="alerta exito">Especialidad eliminada correctamente</p>
  <?php endif; ?>

  <table class="especialidades">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Acciones</th>
      </tr>
    </thead>

    <!-- c(R)ud OPEN -->
    <!-- 4. Mostrando los resultados -->
    <!-- c(R)ud CLOSE -->
    <tbody>

      <?php while ($showEspecialidad = mysqli_fetch_assoc($selectLeerEspecialidad)) : ?>
        <tr>
          <td> <?php echo $showEspecialidad['id_especialidad'] ?> </td>
          <td> <?php echo $showEspecialidad['espad_nombre'] ?> </td>
          <td> <?php echo $showEspecialidad['espad_descripcion'] ?> </td>
          <td>
            <!-- cr(U)d OPEN -->
            <!-- 1. Preparar GET para el Update con ? -->
            <a href="/admin/especialidades/especialidades-crud/actualizar.php?id=<?php echo $showEspecialidad['id_especialidad'] ?>" class="btn-editar">Editar</a>

            <!-- cru(D) OPEN (parte 1/2) -->
            <form method="POST" class="w-100">
              <input type="hidden" name="id" value="<?php echo $showEspecialidad['id_especialidad'] ?>">

              <input type="submit" class="btn-eliminar" value="Eliminar">
            </form>
            <!-- cru(D) CLOSE -->
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>

  <div class="nav-under-crud">
    <a class="btn-crud2" href="/admin">Panel general</a>
    <a class="btn-crud2" href="/admin/especialidades/especialidades-crud/crear.php">Añadir una nueva especialidad</a>
  </div>
</main>

<?php
/* c(R)ud OPEN */
/* 5. Cerrar conexión a la BDD */
mysqli_close($db);
/* c(R)ud CLOSE */
incluirTemplate('footer');
?>
