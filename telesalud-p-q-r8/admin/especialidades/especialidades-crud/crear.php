<?php
/* Conexión a la base de datos */
require '../../../includes/config/database.php';
$db = conectarDB();

/* PARTE 2: Mensajes de errores */
/* Arreglo para mensajes de errores: Validador */
$erroresAnadirEspecialidad = [];
/* PARTE 2: Mensajes de errores FIN */

/* PARTE 3: cuardar información temporalmente */
/* Declaración de variables vacías */
$espad_nombre = '';
$espad_descripcion = '';

/* Método POST para el envío de datos */
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  $espad_nombre = mysqli_real_escape_string($db, $_POST['espad_nombre']);
  $espad_descripcion = mysqli_real_escape_string($db, $_POST['espad_descripcion']);

  /* PARTE 2 INICIO */
  /* Arreglo con mensajes de erorres */
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

  /* Revisar si el arreglo de errores está vacío para insertar en la BDD */

  /* PARTE 1 */
  if(empty($erroresAnadirEspecialidad)) {
    /* Query de inserción de datos en la bdd */
    $queryAnadirEspecialidad = "INSERT INTO tbl_especialidad (espad_nombre, espad_descripcion) VALUES ('$espad_nombre', '$espad_descripcion');";

    /* Inserción a la base de datos */
    $insertQueryAnadirEspecialidad = mysqli_query($db, $queryAnadirEspecialidad);

    /* Mensaje feedback redireccionamiento de usuario */
    if ($insertQueryAnadirEspecialidad) {
      header('Location: /admin/especialidades?exitoAnadirEspecialidad=1');
    }
  }
  /* PARTE 1 FIN */

  /* PARTE 2 FIN */
}

/* Templates */
require '../../../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor">
  <h2 class="especialidades tituloh2">Añadir especialidad</h2>
  
  <!-- PARTE 2 -->
  <!-- Mostrar errores gráficamente en la vista web -->
  <!-- foreach(plural as singular) -->
  <?php foreach($erroresAnadirEspecialidad as $errorAnadirEspecialidad): ?>
    <div class="alerta error">
      <?php echo $errorAnadirEspecialidad; ?>
    </div>
  <?php endforeach; ?>
  <!-- PARTE 2 FIN -->

  <form class="formulario" method="POST" action="/admin/especialidades/especialidades-crud/crear.php">
    <fieldset>

      <legend>Rellenar los siguientes campos</legend>

      <!-- PARTE 3 (en input - value)  -->
      <!-- Se cuardará la info temporalmente  -->
      <label for="espad_nombre">Nombre</label>
      <input name="espad_nombre" id="espad_nombre" type="text" placeholder="Nombre de la especialidad" value="<?php echo $espad_nombre; ?>">

      <label for="espad_descripcion">Descripción (200 caracteres como máximo)</label>
      <textarea name="espad_descripcion" id="espad_descripcion" placeholder="De qué trata la especialidad"><?php echo $espad_descripcion; ?></textarea>
    </fieldset>

    <div class="nav-under-crud">
      <a class="btn-crud2" href="/admin/especialidades">Especialidades disponibles</a>
      <input class="btn-crud2" type="submit" value="Añadir especialidad">
    </div>
    
  </form>

</main>

<?php
incluirTemplate('footer');
?>
