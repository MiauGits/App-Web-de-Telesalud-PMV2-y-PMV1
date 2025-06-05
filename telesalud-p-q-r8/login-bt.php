<?php
require 'includes/funciones.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Roboto&display=swap" rel="stylesheet">
  <link rel="icon" href="/src/img/1-25_icon-icons.com_65706.png" type="image/png">
  <link rel="stylesheet" href="/css/normalize.css">
  <link rel="stylesheet" href="/css/app.css">
  <title>Telesalud</title>
</head>
<body>
  <header class="bg-header">
    <div class="contenedor main-header">
      <div class="logo-cont-general">
        <a class="logo-link" href="/">
          <img class="logo" src="/src/img/1-25_icon-icons.com_65706.png" alt="logo de tlesalud">
        </a>
      </div>
      <div>
        <h1 class="title-header">Red de telesalud - Jauja</h1>
      </div>
        <div class="links-header">

        </div>
    </div>
  </header>


<main class="contenedor">
  <h2 class="tituloh2">Iniciar sesión</h2>

  <form class="formulario margen-temporal-carajo">
    <fieldset>

      <legend>Ingresar sus datos</legend>

      <label for="nombre">Correo</label>
      <input type="text">
      
      <label for="nombre">Contraseña</label>
      <input type="text">
    </fieldset>

    
  </form>

  <div class="nav-under-crud">
    <a class="btn-crud1" href="/">Iniciar sesión</a>
  </div>
</main>

<?php
incluirTemplate('footer');
?>
