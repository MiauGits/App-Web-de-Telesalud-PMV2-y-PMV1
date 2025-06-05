<?php
/* Importando conexión a BD INICIO */
require '../../includes/config/database.php';
$db = conectarDB();
/* Importando conexión a BD FIN */

$idrecetab = $_GET['idrecetab'];
$idrecetab = filter_var($idrecetab, FILTER_VALIDATE_INT);

$queryObtenerReceta = "SELECT * FROM tbl_receta WHERE id_receta = $idrecetab";
$selectObtenerReceta = mysqli_query($db, $queryObtenerReceta);
$recetaFetch = mysqli_fetch_assoc($selectObtenerReceta);

$erroresFormularioReceta = [];

$receta_fecha = $recetaFetch['receta_fecha'];
$receta_hora = $recetaFetch['receta_hora'];
$receta_diagnostico = $recetaFetch['receta_diagnostico'];
$receta_observaciones = $recetaFetch['receta_observaciones'];
$receta_medicamentos = $recetaFetch['receta_medicamentos'];
$receta_indicaciones = $recetaFetch['receta_indicaciones'];

if($_SERVER['REQUEST_METHOD'] === 'POST') {
  date_default_timezone_set('America/Lima');
  $receta_fecha = date('Y-m-d'); /* Formato: 2025-06-04 */
  $receta_hora = date('H:i:s'); /* Formato: 14:23:59 */
  $receta_diagnostico = mysqli_real_escape_string($db, $_POST['receta_diagnostico']);
  $receta_observaciones = mysqli_real_escape_string($db, $_POST['receta_observaciones']);
  $receta_medicamentos = mysqli_real_escape_string($db, $_POST['receta_medicamentos']);
  $receta_indicaciones = mysqli_real_escape_string($db, $_POST['receta_indicaciones']);

  /* Errores INICIO */
  /* Errores para el diagnóstico */
  if(!$receta_diagnostico) {
    $erroresFormularioReceta[] = "Es necesario un diagnóstico";
  }
  if(strlen($receta_diagnostico) > 1000) {
    $erroresFormularioReceta[] = "El diagnóstico supera los 1000 caracteres";
  }

  /* Errores para las observaciones */
  if(!$receta_observaciones) {
    $erroresFormularioReceta[] = "Es necesaria una observación";
  }
  if(strlen($receta_observaciones) > 500) {
    $erroresFormularioReceta[] = "Las observaciones superan los 500 caracteres";
  }

  /* Errores para los medicamentos */
  if(!$receta_medicamentos) {
    $erroresFormularioReceta[] = "Es necesario un medicamento";
  }
  if(strlen($receta_medicamentos) > 200) {
    $erroresFormularioReceta[] = "Los nombres de los medicamentos superan los 200 caracteres";
  }

  /* Errores para las indicaciones */
  if(!$receta_indicaciones) {
    $erroresFormularioReceta[] = "Es necesaria una indicación";
  }
  if(strlen($receta_indicaciones) > 500) {
    $erroresFormularioReceta[] = "Las indicaciones superan los 500 caracteres";
  }
  /* Errores FIN */

  /* Inserción a la BD INICIO */
  if(empty($erroresFormularioReceta)) {
    $queryActualizarReceta = "UPDATE tbl_receta SET
      receta_diagnostico = '$receta_diagnostico',
      receta_observaciones = '$receta_observaciones',
      receta_medicamentos = '$receta_medicamentos',
      receta_indicaciones = '$receta_indicaciones'
    WHERE
      id_receta = $idrecetab;";

    $insertQueryGuardarReceta = mysqli_query($db, $queryActualizarReceta);

    /* Mensaje feedback redireccionamiento de usuario */
    if ($insertQueryGuardarReceta) {
      header('Location: /especialista/recetas/receta-vista.php?exitoDelta=2&idreceta=' . $idrecetab);
    }
  }
  /* Inserción a la BD FIN */
}

/* Header INICIO */
require '../../includes/funciones.php';
incluirTemplate('header');
/* Header FIN */
?>

<main class="contenedor">

  <h2 class="tituloh2">Editor de recetas</h2>

  <?php foreach($erroresFormularioReceta as $errorFormularioReceta): ?>
    <div class="alerta error">
      <?php echo $errorFormularioReceta; ?>
    </div>
  <?php endforeach; ?>

  <form class="formulario" method="POST">

    <fieldset>

      <legend>Rellenar la información</legend>

      <!-- PARTE 3 (en input - value)  -->
      <!-- Se guardará la info temporalmente  -->

      <label for="receta_diagnostico">Diagnóstico (1000 caracteres como máximo)</label>
      <textarea name="receta_diagnostico" id="receta_diagnostico" placeholder="Diagnóstico del paciente"><?php echo $receta_diagnostico; ?></textarea>

      <label for="receta_observaciones">Observaciones (500 caracteres como máximo)</label>
      <textarea name="receta_observaciones" id="receta_observaciones" placeholder="Qué detalle adicional se observó al paciente"><?php echo $receta_observaciones; ?></textarea>

      <label for="receta_medicamentos">Medicamentos (200 caracteres como máximo)</label>
      <textarea name="receta_medicamentos" id="receta_medicamentos" placeholder="Medicamentos que se le recetará"><?php echo $receta_medicamentos; ?></textarea>

      <label for="receta_indicaciones">Indicaciones (500 caracteres como máximo)</label>
      <textarea name="receta_indicaciones" id="receta_indicaciones" placeholder="Cantidad de medicamentos, dosis, tabletas, etc."><?php echo $receta_indicaciones; ?></textarea>
    </fieldset>

    <div class="nav-under-crud">
      <a class="btn-crud2" href="/especialista/recetas/receta-vista.php?idreceta=<?php echo $idrecetab ?>">Cancelar</a>
      <input class="btn-crud2" type="submit" value="Guardar cambios">
    </div>
    
  </form>

</main>

<?php
incluirTemplate('footer');
?>
