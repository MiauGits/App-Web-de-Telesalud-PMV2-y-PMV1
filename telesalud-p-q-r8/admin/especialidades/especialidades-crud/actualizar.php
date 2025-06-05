<?php

/* U INICIO */
/* Sanitizar entrada GET para que sólo sean números ID */
$id = $_GET['id'];
$id = filter_var($id, FILTER_VALIDATE_INT);
/* U FIN */

if(!$id) {
  header('Location: /admin/especialidades');
}

require '../../../includes/config/database.php';
$db = conectarDB();

/* U INICIO */
/* Obtener los datos de las especialidades */
$queryUpdateEspecialidad = "SELECT * FROM tbl_especialidad WHERE id_especialidad = $id";

$selectUpdateEspecialidad = mysqli_query($db, $queryUpdateEspecialidad);

$especialidadFetch = mysqli_fetch_assoc($selectUpdateEspecialidad);
/* U FIN */

$erroresAnadirEspecialidad = [];

/* U INICIO */
/* Precargar datos de la BDD */
$espad_nombre = $especialidadFetch['espad_nombre'];
$espad_descripcion = $especialidadFetch['espad_descripcion'];
/* U FIN */

if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $espad_nombre = mysqli_real_escape_string($db, $_POST['espad_nombre']);
  $espad_descripcion = mysqli_real_escape_string($db, $_POST['espad_descripcion']);

  if(!$espad_nombre) {
    $erroresAnadirEspecialidad[] = "Es necesario un nombre";
  }
  if(strlen($espad_nombre) > 50) {
    $erroresAnadirEspecialidad[] = "El título no debe tener más de 50 caracteres";
  }
  if(!$espad_descripcion) {
    $erroresAnadirEspecialidad[] = "Es necesaria una descripción";
  }
  if(strlen($espad_descripcion) > 200) {
    $erroresAnadirEspecialidad[] = "La descripción supera los 200 caracteres";
  }

  /* U INICIO */
  /* Update la base de datos CUIDADO AÑADIR WHERE */
  if(empty($erroresAnadirEspecialidad)) {
    $queryUpdateAnadirEspecialidad = "UPDATE tbl_especialidad SET espad_nombre = '$espad_nombre', espad_descripcion = '$espad_descripcion' WHERE id_especialidad = $id;";
  /* U FIN */

    $insertQueryAnadirEspecialidad = mysqli_query($db, $queryUpdateAnadirEspecialidad);

    /* U INICIO */
    /* Cambiar emsaje feedback por el número 2 que tendrá otro texto feedback - irse al index */
    if ($insertQueryAnadirEspecialidad) {
      header('Location: /admin/especialidades?exitoAnadirEspecialidad=2');
    }
    /* U FIN */
  }
}

require '../../../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor">
  <h2 class="especialidades tituloh2">Editar especialidad</h2>
  
  <?php foreach($erroresAnadirEspecialidad as $errorAnadirEspecialidad): ?>
    <div class="alerta error">
      <?php echo $errorAnadirEspecialidad; ?>
    </div>
  <?php endforeach; ?>

  <!-- U INICIO -->
  <!-- Cambia el archivo de trabajo eliminando action -->
  <form class="formulario" method="POST">
  <!-- U FIN -->
    <fieldset>

      <legend>Rellenar los siguientes campos</legend>

      <label for="espad_nombre">Nombre</label>
      <input name="espad_nombre" id="espad_nombre" type="text" placeholder="Nombre de la especialidad" value="<?php echo $espad_nombre; ?>">

      <label for="espad_descripcion">Descripción (200 caracteres como máximo)</label>
      <textarea name="espad_descripcion" id="espad_descripcion" placeholder="De qué trata la especialidad"><?php echo $espad_descripcion; ?></textarea>
    </fieldset>

    <div class="nav-under-crud">
      <a class="btn-crud2" href="/admin/especialidades">Especialidades disponibles</a>
      <input class="btn-crud2" type="submit" value="Guardar cambios">
    </div>
    
  </form>

</main>

<?php
incluirTemplate('footer');
?>
