<?php

$ida = $_GET['ida'];
$ida = filter_var($ida, FILTER_VALIDATE_INT);

if(!$ida) {

  header('Location: /admin/especialistas');

}

require '../../includes/config/database.php';
$db = conectarDB();

$id = (int) $_GET['id'];

$queryUpdateCita = "SELECT * FROM tbl_cita WHERE id_cita = $ida";

$selectUpdateCita = mysqli_query($db, $queryUpdateCita);

$citaFetch = mysqli_fetch_assoc($selectUpdateCita);

/* Obtener especialidad para el título */
$query1 = "SELECT * FROM tbl_especialidad WHERE id_especialidad = $id;";
$selectQuery1 = mysqli_query($db, $query1);
$resultado1 = mysqli_fetch_assoc($selectQuery1);

$especialidad = $resultado1['espad_nombre'];

/* $_POST['id'] = $_GET['id']; */

/* Obtener especialista según especialidad */
$queryEspecialista = "SELECT * FROM tbl_especialista WHERE tbl_especialidad_id_especialidad = $id;";
$resultadoQueryEspecialista = mysqli_query($db, $queryEspecialista);

$erroresAgendarCita = [];

$cit_especialidad = $citaFetch['cit_especialidad'];
$cit_fecha = $citaFetch['cit_fecha'];
$cit_hora = $citaFetch['cit_hora'];
$cit_motivoconsulta = $citaFetch['cit_motivoconsulta'];
$tbl_especialista_id_especialista = $citaFetch['tbl_especialista_id_especialista'];

if($_SERVER['REQUEST_METHOD'] === 'POST') {

  $cit_especialidad = $especialidad;
  $cit_fecha = mysqli_real_escape_string($db, $_POST['cit_fecha']);
  $cit_hora = mysqli_real_escape_string($db, $_POST['cit_hora']);
  $cit_motivoconsulta = mysqli_real_escape_string($db, $_POST['cit_motivoconsulta']);
  $tbl_especialista_id_especialista = mysqli_real_escape_string($db, $_POST['tbl_especialista_id_especialista']);

  /* La especialidad se toma del ?id= */
  /* if(!$cit_especialidad) {
    $erroresAgendarCita[] = "Es necesaria una especialidad";
  }*/ 

  /* Errores para campo: ESPECIALISTA (FOREIGN KEY) */
  if(!$tbl_especialista_id_especialista) {
    $erroresAgendarCita[] = "Es necesario un especialista";
  }

  /* La fecha se ingresa sin errores */
  if(!$cit_fecha) {
    $erroresAgendarCita[] = "Es necesario seleccionar una fecha";
  }

  /* La hora se ingresa sin errores */
  if(!$cit_hora) {
    $erroresAgendarCita[] = "Es necesario seleccionar una hora";
  }

  /* Errores para campo: MOTIVO CONSULTA */
  if(!$cit_motivoconsulta) {
    $erroresAgendarCita[] = "Es necesario un motivo de consulta";
  }
  if(strlen($cit_motivoconsulta) > 200) {
    $erroresAgendarCita[] = "El motivo de consulta supera los 200 caracteres";
  }

  /* Query de inserción de datos en la bdd */

  if(empty($erroresAgendarCita)) {

    $queryAgendarCita = "INSERT INTO tbl_cita (
      cit_especialidad,
      cit_fecha,
      cit_hora,
      cit_motivoconsulta,
      tbl_especialista_id_especialista
    ) VALUES (
      '$especialidad',
      '$cit_fecha',
      '$cit_hora',
      '$cit_motivoconsulta',
      $tbl_especialista_id_especialista
    );";

    $insertQueryAgendarCita = mysqli_query($db, $queryAgendarCita);

    if($insertQueryAgendarCita) {
      header('Location: /user?exitoGamma=1');
    }

  } /*else {
    $id = $_POST['id'];
    header('Location: /user/citas/agendar.php?id=' . $id);
  }*/

}

/* echo '<pre>';
var_dump($id);
var_dump($_GET);
var_dump($_POST);
echo '</pre>';*/


require '../../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor">

  <h2 class="tituloh2">Agendar una cita para: <?php echo $resultado1['espad_nombre']; ?></h2>

  <?php foreach($erroresAgendarCita as $errorAgendarCita) : ?>
  <div class="alerta error">
    <?php echo $errorAgendarCita; ?>
  </div>
  <?php endforeach; ?>

  <form class="formulario" method="POST">
    <fieldset>

      <legend>Rellenar los siguientes campos</legend>

      <input name="cit_especialidad" id="cit_especialidad" type="hidden" value="<?php echo $resultado1['espad_nombre']; ?>">

      <label for="tbl_especialista_id_especialista">Especialista</label>
      <select name="tbl_especialista_id_especialista" id="tbl_especialista_id_especialista">

        <option value="">--- Seleccione un especialista ---</option>

        <?php while($row = mysqli_fetch_assoc($resultadoQueryEspecialista)) : ?>
        <option <?php echo $tbl_especialista_id_especialista === $row['id_especialista'] ? 'selected' : ''; ?> value="<?php echo $row['id_especialista']; ?>"> <?php echo $row['espta_nombres'] . " " . $row['espta_appaterno'] . " " . $row['espta_apmaterno']; ?> </option>
        <?php endwhile; ?>

      </select>

      <label for="cit_fecha">Fecha de la cita</label>
      <input name="cit_fecha" id="cit_fecha" type="date" value="<?php echo $cit_fecha; ?>">

      <label for="cit_hora">Hora de la cita</label>
      <input name="cit_hora" id="cit_hora" type="time" value="<?php echo $cit_hora; ?>">

      <label for="cit_motivoconsulta">Motivo (200 caracteres como máximo)</label>
      <textarea name="cit_motivoconsulta" id="cit_motivoconsulta" placeholder="Describir el motivo de su consulta"><?php echo $cit_motivoconsulta; ?></textarea>
      
    </fieldset>


    <div class="nav-under-crud">
      <a class="btn-crud1" href="/agendar1.php">Ver especialidades</a>
      <a class="btn-crud1" href="/user">Ver mis citas agendadas</a>
      <input class="btn-crud1" type="submit" value="Agendar cita">
    </div>
    
  </form>
  
</main>

<?php
incluirTemplate('footer');
?>
