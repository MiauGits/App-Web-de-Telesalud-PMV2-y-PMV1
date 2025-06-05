<?php

/* 1. Importación de conexión a la base de datos */
require '../includes/config/database.php';
$db = conectarDB();

$queryLeerCita = "SELECT * FROM tbl_cita";

$selectLeerCita = mysqli_query($db, $queryLeerCita);


$queryLeerReceta = "SELECT * FROM tbl_receta;";

$selectLeerReceta = mysqli_query($db, $queryLeerReceta);

$showReceta = mysqli_fetch_assoc($selectLeerReceta);



$exitoGamma = $_GET['exitoGamma'] ?? null;
$exitoDelta = $_GET['exitoDelta'] ?? null;

/* ========== NUEVO LEER INICIO ========== */
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $id = filter_var($id, FILTER_VALIDATE_INT);

  if($id) {
    $queryEliminar = "DELETE FROM tbl_cita WHERE id_cita = $id";

    $resultadoQueryEliminar = mysqli_query($db, $queryEliminar);

    if($resultadoQueryEliminar) {
      header('Location: /especialista?exitoGamma=3');
    }
  }
}
/* ========== NUEVO LEER FIN ========== */

/* Inclusión de template */
require '../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor">
  <h2 class="especialidades tituloh2">Administrador de citas y recetas - Especialista</h2>

  <!-- ========== NUEVO LEER INICIO ========== -->
  <?php if(intval($exitoGamma) === 1) : ?>
    <p class="alerta exito">Cita agendada correctamente</p>
  <?php elseif(intval($exitoGamma) === 2) : ?>
    <p class="alerta exito">Cita reprogramada correctamente</p>
  <?php elseif(intval($exitoGamma) === 3) : ?>
    <p class="alerta exito">Cita cancelada correctamente</p>
  <?php elseif(intval($exitoDelta) === 1) : ?>
    <p class="alerta exito">Receta creada correctamente</p>
  <?php elseif(intval($exitoDelta) === 3) : ?>
    <p class="alerta exito">Receta eliminada correctamente</p>
  <?php endif; ?>
  <!-- ========== NUEVO LEER FIN ========== -->

  <!-- ========== NUEVO LEER INICIO ========== -->
  <table class="especialidades">
    <thead>
      <tr>
        <th>ID</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Motivo de consulta</th>
        <th>Especialista</th>
        <th>Receta</th>
        <th>Acciones</th>
      </tr>
    </thead>

    <!-- c(R)ud OPEN -->
    <!-- 4. Mostrando los resultados -->
    <!-- c(R)ud CLOSE -->
    <tbody>

      <?php while ($showCita = mysqli_fetch_assoc($selectLeerCita)) : ?>
        <tr>
          <td> <?php echo $showCita['id_cita'] ?> </td>
          <td> <?php echo $showCita['cit_fecha'] ?> </td>
          <td> <?php echo $showCita['cit_hora'] ?> </td>
          <td> <?php echo $showCita['cit_motivoconsulta'] ?> </td>
          <td> <?php echo $showCita['tbl_especialista_id_especialista'] ?> </td>
          <td> <!-- Botón de ver receta INICIO -->
            <?php
            if ($showCita['tbl_receta_id_receta'] == 1) { ?>
              <p>Esta cita no tiene receta</p>
              <a href="/especialista/recetas/receta-crear.php?idcita=<?php echo $showCita['id_cita'] ?>" class="btn-crear">Crear receta</a>
            <?php } else { ?>
              <a href="/especialista/recetas/receta-vista.php?idreceta=<?php echo $showCita['tbl_receta_id_receta'] ?>" class="btn-ver">Ver receta</a>
            <?php }
            ?>
          </td> <!-- Botón de ver receta  FIN -->
          <td>
            <!-- cr(U)d OPEN -->
            <!-- 1. Preparar GET para el Update con ? -->
            <a href="/user/citas/modificar.php?ida=<?php echo $showCita['id_cita'] ?>" class="btn-editar">Reprogramar cita</a>

            <!-- cru(D) OPEN (parte 1/2) -->
            <form method="POST" class="w-100">
              <input type="hidden" name="id" value="<?php echo $showCita['id_cita'] ?>">

              <input type="submit" class="btn-eliminar" value="Eliminar cita">
            </form>
            <!-- cru(D) CLOSE -->
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
  <!-- ========== NUEVO LEER FIN ========== -->

  <div class="margin-bottom-treerem">
  </div>
</main>

<?php
/* Cerrar conexión a la BDD */
mysqli_close($db);

incluirTemplate('footer');
?>
