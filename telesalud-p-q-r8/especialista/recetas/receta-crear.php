<?php
/* Importando conexión a BD INICIO */
require '../../includes/config/database.php';
$db = conectarDB();
/* Importando conexión a BD FIN */

$erroresFormularioReceta = [];

$receta_fecha = '';
$receta_hora = '';
$receta_diagnostico = '';
$receta_observaciones = '';
$receta_medicamentos = '';
$receta_indicaciones = '';

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
    /* Query de inserción de datos en la bdd */
    $queryGuardarReceta = "INSERT INTO tbl_receta (
      receta_fecha,
      receta_hora,
      receta_diagnostico,
      receta_observaciones,
      receta_medicamentos,
      receta_indicaciones
    ) VALUES (
      '$receta_fecha',
      '$receta_hora',
      '$receta_diagnostico',
      '$receta_observaciones',
      '$receta_medicamentos',
      '$receta_indicaciones'
    );";

    /* Inserción a la base de datos */
    $insertQueryGuardarReceta = mysqli_query($db, $queryGuardarReceta);

    $queryLeerReceta = "SELECT * FROM tbl_receta WHERE receta_fecha = '$receta_fecha' AND receta_hora = '$receta_hora';";
    $selectLeerReceta = mysqli_query($db, $queryLeerReceta);
    $showReceta = mysqli_fetch_assoc($selectLeerReceta);

    /*
    $queryLeerCita = "SELECT * FROM tbl_cita";
    $selectLeerCita = mysqli_query($db, $queryLeerCita);
    $showCita = mysqli_fetch_assoc($selectLeerCita);
    */

    $idcita = $_GET['idcita'];
    $idcita = filter_var($idcita, FILTER_VALIDATE_INT);

    $idreceta = $showReceta['id_receta'];

    $queryActualizarCita = "UPDATE tbl_cita SET tbl_receta_id_receta = $idreceta WHERE id_cita = $idcita;";
    $updateActualizarCita = mysqli_query($db, $queryActualizarCita);

    /* Mensaje feedback redireccionamiento de usuario */

    if ($insertQueryGuardarReceta) {
      header('Location: /especialista?exitoDelta=1');
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
      <a class="btn-crud2" href="/especialista">Administrador de citas y recetas</a>
      <input class="btn-crud2" type="submit" value="Guardar receta">
    </div>
    
  </form>

</main>

<?php
incluirTemplate('footer');
?>
