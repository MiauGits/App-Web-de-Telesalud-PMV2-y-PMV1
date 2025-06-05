<?php

require __DIR__ . '/includes/config/database.php';
$db = conectarDB();

$queryLeerEspecialidad = "SELECT * FROM tbl_especialidad";

$selectLeerEspecialidad = mysqli_query($db, $queryLeerEspecialidad);

require 'includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor">

  <h2 class="tituloh2">Selecciona una especialidad</h2>

  <div class="especialidades-container">
  <?php while ($showEspecialidad = mysqli_fetch_assoc($selectLeerEspecialidad)) : ?>
    <a href="/user/citas/agendar.php?id=<?php echo $showEspecialidad['id_especialidad']; ?>" class="card-especialidad">
      <p class="nombre-especialidad"><?php echo $showEspecialidad['espad_nombre']; ?></p>
    </a>
  <?php endwhile; ?>
</div>

<div class="nav-under-crud">
      <a class="btn-crud1" href="/">Página principal</a>
      <a class="btn-crud1" href="/user">Ver mis citas agendadas</a>
    </div>
  
</main>

<?php
incluirTemplate('footer');
?>
