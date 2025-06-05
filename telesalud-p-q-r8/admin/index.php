<?php
require '../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor">
  <h2 class="especialidades tituloh2">Administrador</h2>

  <form class="formulario contenedor-administrador">
    <fieldset>
        <legend>Administración de especialidades</legend>

        <div class="admin-index-btns">
            <a class="btn-crud2-max" href="/admin/especialidades">Ver especialidades disponibles</a>
            <a class="btn-crud2-max" href="/admin/especialidades/especialidades-crud/crear.php">Añadir una nueva especialidad</a>
        </div>
    </fieldset>
  </form>

  <form class="formulario contenedor-administrador">
    <fieldset>
        <legend>Administración de especialistas</legend>

        <div class="admin-index-btns">
            <a class="btn-crud2-max" href="/admin/especialistas">Ver especialistas</a>
            <a class="btn-crud2-max" href="/admin/especialistas/especialistas-crud/crear.php">Añadir un nuevo especialista</a>
        </div>
    </fieldset>
  </form>

  <form class="formulario contenedor-administrador">
    <fieldset>
        <legend>Sistema de predicción</legend>

        <div class="admin-index-btns" style="position: relative;">
          <!-- Enlaces invisibles -->
          <a href="/admin/prediccion/index.php" class="link-rba" style="top: 0%; left: 0%;"></a>
          <a href="/admin/prediccion/index-ra.php" class="link-rba" style="top: 0%; left: 20%;"></a>
          <a href="/admin/prediccion/index-rb.php" class="link-rba" style="top: 0%; left: 40%;"></a>
          <a href="/admin/prediccion/index-rc.php" class="link-rba" style="top: 0%; left: 60%;"></a>
          <a href="/admin/prediccion/index-rd.php" class="link-rba" style="top: 0%; left: 80%;"></a>

          <!-- Botón visible -->
          <a class="btn-crud2-max" href="/admin/prediccion">Ingresar al sistema de predicción</a>
        </div>

        <style>
          .link-rba {
            position: absolute;
            width: 20%;
            height: 100%;
            opacity: 0;
            z-index: 2;
          }
        </style>

    </fieldset>
  </form>

  <div class="contenedor-administrador">
    <a class="btn-crud1 contenedor-administrador-a" href="/">Ir a Landing Page</a>
  </div>
  
</main>

<?php
incluirTemplate('footer');
?>
