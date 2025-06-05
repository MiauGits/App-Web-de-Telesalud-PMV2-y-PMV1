<?php

/* 1. Importación de conexión a la base de datos */
require '../../includes/config/database.php';
$db = conectarDB();

/* ========== NUEVO LEER INICIO ========== */
$queryLeerEspecialista = "SELECT * FROM tbl_especialista";
/* ========== NUEVO LEER FIN ========== */

$queryLeerEspecialidad = "SELECT * FROM tbl_especialidad"; /* Obtener el nombre de la especialidad */

/* ========== NUEVO LEER INICIO ========== */
$selectLeerEspecialista = mysqli_query($db, $queryLeerEspecialista);
/* ========== NUEVO LEER FIN ========== */

$selectLeerEspecialidad = mysqli_query($db, $queryLeerEspecialidad); /* Obtener el nombre de la especialidad */

/* ========== NUEVO LEER INICIO ========== */
$exitoBeta = $_GET['exitoBeta'] ?? null;
/* ========== NUEVO LEER FIN ========== */

/* ========== NUEVO LEER INICIO ========== */
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $id = filter_var($id, FILTER_VALIDATE_INT);

  if($id) {
    $queryEliminar = "DELETE FROM tbl_especialista WHERE id_especialista = $id";

    $resultadoQueryEliminar = mysqli_query($db, $queryEliminar);

    if($resultadoQueryEliminar) {
      header('Location: /admin/especialistas?exitoBeta=3');
    }
  }
}
/* ========== NUEVO LEER FIN ========== */

/* Inclusión de template */
require '../../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor">
  <h2 class="especialidades tituloh2">Especialistas disponibles / administrador</h2>

  <!-- ========== NUEVO LEER INICIO ========== -->
  <?php if(intval($exitoBeta) === 1) : ?>
    <p class="alerta exito">Especialista añadido correctamente</p>
  <?php elseif(intval($exitoBeta) === 2) : ?>
    <p class="alerta exito">Cambios guardados correctamente</p>
  <?php elseif(intval($exitoBeta) === 3) : ?>
    <p class="alerta exito">Especialista eliminado correctamente</p>
  <?php endif; ?>
  <!-- ========== NUEVO LEER FIN ========== -->

  <!-- ========== NUEVO LEER INICIO ========== -->
  <table class="especialidades">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nombres</th>
        <th>Apellido paterno</th>
        <th>Apellido materno</th>
        <th>E-mail</th>
        <th>Contraseña</th>
        <th>Descripción</th>
        <th>Especialidad</th>
        <th>Acciones</th>
      </tr>
    </thead>

    <!-- c(R)ud OPEN -->
    <!-- 4. Mostrando los resultados -->
    <!-- c(R)ud CLOSE -->
    <tbody>

      <?php while ($showEspecialista = mysqli_fetch_assoc($selectLeerEspecialista)) : ?>
        <tr>
          <td> <?php echo $showEspecialista['id_especialista'] ?> </td>
          <td> <?php echo $showEspecialista['espta_nombres'] ?> </td>
          <td> <?php echo $showEspecialista['espta_appaterno'] ?> </td>
          <td> <?php echo $showEspecialista['espta_apmaterno'] ?> </td>
          <td> <?php echo $showEspecialista['espta_correo'] ?> </td>
          <td> <?php echo $showEspecialista['espta_contrasena'] ?> </td>
          <td> <?php echo $showEspecialista['espta_descripcion'] ?> </td>
          <td> <?php echo $showEspecialista['tbl_especialidad_id_especialidad'] ?> </td>
          <td>
            <!-- cr(U)d OPEN -->
            <!-- 1. Preparar GET para el Update con ? -->
            <a href="/admin/especialistas/especialistas-crud/actualizar.php?id=<?php echo $showEspecialista['id_especialista'] ?>" class="btn-editar">Editar</a>

            <!-- cru(D) OPEN (parte 1/2) -->
            <form method="POST" class="w-100">
              <input type="hidden" name="id" value="<?php echo $showEspecialista['id_especialista'] ?>">

              <input type="submit" class="btn-eliminar" value="Eliminar">
            </form>
            <!-- cru(D) CLOSE -->
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
  <!-- ========== NUEVO LEER FIN ========== -->

  <div class="nav-under-crud">
    <a class="btn-crud2" href="/admin">Panel general</a>
    <a class="btn-crud2" href="/admin/especialistas/especialistas-crud/crear.php">Añadir un nuevo especialista</a>
  </div>
</main>

<?php
/* Cerrar conexión a la BDD */
mysqli_close($db);

incluirTemplate('footer');
?>
