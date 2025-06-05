<?php

$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);

if(!$id) {

  header('Location: /admin/especialistas');

}

require '../../../includes/config/database.php';
$db = conectarDB();

/* U INICIO */
/* Obtener los datos de las especialidades */
$queryUpdateEspecialista = "SELECT * FROM tbl_especialista WHERE id_especialista = $id";

$selectUpdateEspecialista = mysqli_query($db, $queryUpdateEspecialista);

$especialistaFetch = mysqli_fetch_assoc($selectUpdateEspecialista);
/* U FIN */

$queryEspecialidades = "SELECT * FROM tbl_especialidad;";
$resultadoQueryEspecialidades = mysqli_query($db, $queryEspecialidades);

$erroresAnadirEspecialista = [];

$espta_nombres = $especialistaFetch['espta_nombres'];
$espta_appaterno = $especialistaFetch['espta_appaterno'];
$espta_apmaterno = $especialistaFetch['espta_apmaterno'];
$espta_correo = $especialistaFetch['espta_correo'];
$espta_contrasena = $especialistaFetch['espta_contrasena'];
$espta_descripcion = $especialistaFetch['espta_descripcion'];
$tbl_especialidad_id_especialidad = $especialistaFetch['tbl_especialidad_id_especialidad'];

if($_SERVER['REQUEST_METHOD'] === 'POST') {

  $espta_nombres = mysqli_real_escape_string($db, $_POST['espta_nombres']);
  $espta_appaterno = mysqli_real_escape_string($db, $_POST['espta_appaterno']);
  $espta_apmaterno = mysqli_real_escape_string($db, $_POST['espta_apmaterno']);
  $espta_correo = mysqli_real_escape_string($db, $_POST['espta_correo']);
  $espta_contrasena = mysqli_real_escape_string($db, $_POST['espta_contrasena']);
  $espta_descripcion = mysqli_real_escape_string($db, $_POST['espta_descripcion']);
  $tbl_especialidad_id_especialidad = mysqli_real_escape_string($db, $_POST['tbl_especialidad_id_especialidad']);

  /* Errores para campo: NOMBRES */
  if(!$espta_nombres) {
    $erroresAnadirEspecialista[] = "Es necesario el nombre";
  }
  if(strlen($espta_nombres) > 50) {
    $erroresAnadirEspecialista[] = "Los nombres no pueden superar los 50 caracteres";
  }

  /* Errores para campo: APELLIDO PATERNO */
  if(!$espta_appaterno) {
    $erroresAnadirEspecialista[] = "Es necesario el apellido paterno";
  }
  if(strlen($espta_appaterno) > 45) {
    $erroresAnadirEspecialista[] = "El apellido paterno no debe superar los 45 caracteres";
  }

  /* Errores para campo: APELLIDO MATERNO */
  if(!$espta_apmaterno) {
    $erroresAnadirEspecialista[] = "Es necesario el apellido materno";
  }
  if(strlen($espta_apmaterno) > 45) {
    $erroresAnadirEspecialista[] = "El apellido materno no debe superar los 45 caracteres";
  }

  /* Errores para campo: CORREO ELECTRÓNICO */
  if(!$espta_correo) {
    $erroresAnadirEspecialista[] = "Es necesario el correo";
  }
  if(strlen($espta_correo) > 45) {
    $erroresAnadirEspecialista[] = "La dirección de correo electrónico supera los 45 caracteres";
  }

  /* Errores para campo: CONTRASEÑA */
  if(!$espta_contrasena) {
    $erroresAnadirEspecialista[] = "Es necesaria una contraseña";
  }
  if(strlen($espta_contrasena) > 50) {
    $erroresAnadirEspecialista[] = "La contraseña supera los 50 caracteres";
  }
  if(strlen($espta_contrasena) < 8) {
    $erroresAnadirEspecialista[] = "La contraseña debe tener 8 caracteres como mínimo";
  }

  /* Errores para campo: DESCRIPCIÓN */
  if(!$espta_descripcion) {
    $erroresAnadirEspecialista[] = "Es necesaria una descripción";
  }
  if(strlen($espta_descripcion) > 200) {
    $erroresAnadirEspecialista[] = "La descripción supera los 200 caracteres";
  }

  /* Errores para campo: ESPECIALIDAD (FOREIGN KEY) */
  if(!$tbl_especialidad_id_especialidad) {
    $erroresAnadirEspecialista[] = "Es necesaria una especialidad";
  }

  if(empty($erroresAnadirEspecialista)) {

    $queryUpdateAnadirEspecialista = "UPDATE tbl_especialista SET
      espta_nombres = '$espta_nombres',
      espta_appaterno = '$espta_appaterno',
      espta_apmaterno = '$espta_apmaterno',
      espta_correo = '$espta_correo',
      espta_contrasena = '$espta_contrasena',
      espta_descripcion = '$espta_descripcion',
      tbl_especialidad_id_especialidad = '$tbl_especialidad_id_especialidad'
    WHERE
      id_especialista = $id;";

    $insertQueryAnadirEspecialista = mysqli_query($db, $queryUpdateAnadirEspecialista);

    if ($insertQueryAnadirEspecialista) {
      header('Location: /admin/especialistas?exitoBeta=2');
    }

  }

}

require '../../../includes/funciones.php';
incluirTemplate('header');

?>

<main class="contenedor">
  <h2 class="especialidades tituloh2">Añadir especialista</h2>

  <?php foreach($erroresAnadirEspecialista as $errorAnadirEspecialista) : ?>
  <div class="alerta error">
    <?php echo $errorAnadirEspecialista; ?>
  </div>
  <?php endforeach; ?>

  <form class="formulario" method="POST">

    <fieldset>

      <legend>Rellenar los siguientes campos</legend>

      <label for="espta_nombres">Nombres</label>
      <input name="espta_nombres" id="espta_nombres" type="text" placeholder="Nombres del especialista" value="<?php echo $espta_nombres; ?>">

      <label for="espta_appaterno">Apellido paterno</label>
      <input name="espta_appaterno" id="espta_appaterno" type="text" placeholder="Apellido paterno del especialista" value="<?php echo $espta_appaterno; ?>">

      <label for="espta_apmaterno">Apellido materno</label>
      <input name="espta_apmaterno" id="espta_apmaterno" type="text" placeholder="Apellido materno del especialista" value="<?php echo $espta_apmaterno; ?>">

      <label for="espta_correo">E-mail</label>
      <input name="espta_correo" id="espta_correo" type="email" placeholder="E-mail del especialista" value="<?php echo $espta_correo; ?>">

      <label for="espta_contrasena">Contraseña</label>
      <input name="espta_contrasena" id="espta_contrasena" type="password" placeholder="Ingresar contraseña segura" value="<?php echo $espta_contrasena; ?>">

      <label for="espta_descripcion">Descripción (200 caracteres como máximo)</label>
      <textarea name="espta_descripcion" id="espta_descripcion" placeholder="Diplomas, títulos, reconocimientos, medallas, etc."><?php echo $espta_descripcion; ?></textarea>

      <select name="tbl_especialidad_id_especialidad" id="tbl_especialidad_id_especialidad">

        <option value="">--- Seleccionar especialidad ---</option>

        <?php while($row = mysqli_fetch_assoc($resultadoQueryEspecialidades)) : ?>
        <option <?php echo $tbl_especialidad_id_especialidad === $row['id_especialidad'] ? 'selected' : ''; ?> value="<?php echo $row['id_especialidad']; ?>"> <?php echo $row['espad_nombre']; ?> </option>
        <?php endwhile; ?>
  
      </select>

    </fieldset>

    <div class="nav-under-crud">

      <a class="btn-crud2" href="/admin/especialistas">Especialistas disponibles</a>
      <input class="btn-crud2" type="submit" value="Guardar cambios">

    </div>

  </form>

</main>

<?php
incluirTemplate('footer');
?>
