<?php
/* Importando conexión a BD INICIO */
require '../../includes/config/database.php';
$db = conectarDB();
/* Importando conexión a BD FIN */

$idreceta = $_GET['idreceta'];
$idreceta = filter_var($idreceta, FILTER_VALIDATE_INT);

$queryLeerReceta = "SELECT * FROM tbl_receta WHERE id_receta = $idreceta;";
$selectLeerReceta = mysqli_query($db, $queryLeerReceta);
$showReceta = mysqli_fetch_assoc($selectLeerReceta);

$exitoGamma = $_GET['exitoGamma'] ?? null;
$exitoDelta = $_GET['exitoDelta'] ?? null;

/* cru(D) OPEN (parte 2/2) */
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'];
  $id = filter_var($id, FILTER_VALIDATE_INT);

  if($id) {
    $queryLeerCita = "SELECT * FROM tbl_cita WHERE tbl_receta_id_receta = $id";
    $selectLeerCita = mysqli_query($db, $queryLeerCita);
    $showCita = mysqli_fetch_assoc($selectLeerCita);
    $queryActualizarIDa1 = "UPDATE tbl_cita SET tbl_receta_id_receta = 1 WHERE tbl_receta_id_receta = $id;";
    $queryFetch = mysqli_query($db, $queryActualizarIDa1);


    $queryEliminar = "DELETE FROM tbl_receta WHERE id_receta = $id";

    $resultadoQueryEliminar = mysqli_query($db, $queryEliminar);


    if($resultadoQueryEliminar) {
      header('Location: /especialista?exitoDelta=3');
    }
  }
}
/* cru(D) CLOSE */

/* Header INICIO */
require '../../includes/funciones.php';
incluirTemplate('header');
/* Header FIN */
?>

<main class="contenedor">
  <h2 class="tituloh2">Administrar recetas</h2>

  <?php if(intval($exitoGamma) === 1) : ?>
    <p class="alerta exito">Cita agendada correctamente</p>
  <?php elseif(intval($exitoGamma) === 2) : ?>
    <p class="alerta exito">Cita reprogramada correctamente</p>
  <?php elseif(intval($exitoGamma) === 3) : ?>
    <p class="alerta exito">Cita cancelada correctamente</p>
  <?php elseif(intval($exitoDelta) === 1) : ?>
    <p class="alerta exito">Receta creada correctamente</p>
  <?php elseif(intval($exitoDelta) === 2) : ?>
    <p class="alerta exito">Receta actualizada correctamente</p>
  <?php endif; ?>

  <div class="contenedor-administrador">

    <h3>Fecha: </h3>
    <h4 class="margin-bottom-treerem"><?php echo $showReceta['receta_fecha'] ?></h4>

    <h3>Hora: </h3>
    <h4 class="margin-bottom-treerem"><?php echo $showReceta['receta_hora'] ?></h4>

    <h3>Diagnóstico: </h3>
    <h4 class="margin-bottom-treerem"><?php echo $showReceta['receta_diagnostico'] ?></h4>

    <h3>Observaciones: </h3>
    <h4 class="margin-bottom-treerem"><?php echo $showReceta['receta_observaciones'] ?></h4>
    
    <h3>Medicamentos: </h3>
    <h4 class="margin-bottom-treerem"><?php echo $showReceta['receta_medicamentos'] ?></h4>

    <h3>Indicaciones: </h3>
    <h4 class="margin-bottom-treerem"><?php echo $showReceta['receta_indicaciones'] ?></h4>

  </div>

  <div class="nav-under-crud">
    <a class="btn-crud1" href="/especialista">Ver citas agendadas</a>

    <div>
<form method="POST">
      <input type="hidden" name="id" value="<?php echo $showReceta['id_receta'] ?>">

      <input type="submit" class="btn-eliminar" value="Eliminar esta receta">
    </form>
    <!-- cru(D) FIN -->

    <a href="/especialista/recetas/receta-editar.php?idrecetab=<?php echo $idreceta ?>" class="btn-crud1">Editar esta receta</a>
    </div>
    <!-- cru(D) INICIO -->
    
  </div>
  
</main>

<?php
incluirTemplate('footer');
?>
