<?php
require 'includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor">
  <h2 class="tituloh2">Registrarse</h2>

  <form class="formulario margen-temporal-carajo">
    <fieldset>

      <legend>Rellenar los siguientes campos</legend>

      <label for="nombre">Nombres</label>
      <input type="text">
      
      <label for="nombre">Apellido paterno</label>
      <input type="text">
      
      <label for="nombre">Apellido materno</label>
      <input type="text">
      
      <label for="nombre">Número de teléfono</label>
      <input type="text">

      <label for="nombre">E-mail</label>
      <input type="text">

      <label for="nombre">Contraseña</label>
      <input type="text">

      <label for="nombre">Confirmar contraseña</label>
      <input type="text">
    </fieldset>

    
  </form>

  <div class="nav-under-crud">
    <a class="btn-crud1" href="/user">Volver</a>
    <input class="btn-crud1" type="submit" value="Registrarse">
  </div>
</main>

<?php
incluirTemplate('footer');
?>
