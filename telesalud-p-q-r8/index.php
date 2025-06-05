<?php
require 'includes/funciones.php';
incluirTemplate('header');
?>

  <main>
    <div class="contenedor cont-hero">
      <div class="slider-frame">
        <img class="img-banner" src="/src/img/hero1.jpg" alt="imagen banner">
      </div>
    </div>
    <div class="contenedor">
      <h2 class="especialidades">Especialidades</h2>

      <div class="cont-especialidades">
        <div class="especialidad-box">
          <a href="/views/especialidad1-medicina-general.php">
            <img class="img-especialidad" src="/src/img/a01-medicina-general.jpg" alt="imagen de especialidad">
            <h3>Medicina general</h3>
          </a>
          
        </div>
        <div class="especialidad-box">
          <a href="/views/especialidad2-pediatria.php">
            <img class="img-especialidad" src="/src/img/a02-pediatria.jpg" alt="imagen de especialidad">
            <h3>Pediatría</h3>
          </a>
          
        </div>
        <div class="especialidad-box">
          <a href="/views/especialidad3-ginecologia-y-obstetricia.php">
            <img class="img-especialidad" src="/src/img/a03-ginecologia-y-obstetricia.jpg" alt="imagen de especialidad">
            <h3>Ginecología y obstetricia</h3>
          </a>
          
        </div>
        <div class="especialidad-box">
          <a href="/views/especialidad4-medicina-interna.php">
            <img class="img-especialidad" src="/src/img/a04-medicina-interna.jpg" alt="imagen de especialidad">
            <h3>Medicina interna</h3>
          </a>
          
        </div>
        <div class="especialidad-box">
          <a href="#">
            <img class="img-especialidad" src="/src/img/a05-otorrinolaringologia.jpg" alt="imagen de especialidad">
            <h3>Otorrinolaringología</h3>
          </a>
          
        </div>
        <div class="especialidad-box">
          <a href="#">
            <img class="img-especialidad" src="/src/img/a06-oftalmologia.jpg" alt="imagen de especialidad">
            <h3>Oftalmología</h3>
          </a>
          
        </div>
        <div class="especialidad-box">
          <a href="#">
            <img class="img-especialidad" src="/src/img/a07-odontologia.jpg" alt="imagen de especialidad">
            <h3>Odontología</h3>
          </a>
          
        </div>
        <div class="especialidad-box">
          <a href="#">
            <img class="img-especialidad" src="/src/img/a08-psicologia.jpg" alt="imagen de especialidad">
            <h3>Psicología</h3>
          </a>
          
        </div>
        <div class="especialidad-box">
          <a href="#">
            <img class="img-especialidad" src="/src/img/a09-psiquiatria.jpg" alt="imagen de especialidad">
            <h3>Psiquiatría</h3>
          </a>
          
        </div>
        <div class="especialidad-box">
          <a href="#">
            <img class="img-especialidad" src="/src/img/a10-rehabilitacion.jpg" alt="imagen de especialidad">
            <h3>Rehabilitación</h3>
          </a>
          
        </div>
        <div class="especialidad-box">
          <a href="#">
            <img class="img-especialidad" src="/src/img/a11-enfermeria-especializada.jpg" alt="imagen de especialidad">
            <h3>Enfermería especializada</h3>
          </a>
          
        </div>
        <div class="especialidad-box">
          <a href="#">
            <img class="img-especialidad" src="/src/img/a12-traumatologia.jpg" alt="imagen de especialidad">
            <h3>Traumatología</h3>
          </a>
          
        </div>
      </div>

      <a class="btn-crud1" href="/agendar1.php">Agendar una cita</a>

    </div>
    <div class="contenedor">
      <h2 class="tu-salud">Tu salud, nuestra prioridad</h2>
      <div class="cont-fraccional">
        <div>
          <img class="img-fracional" src="/src/img/b1-acceso-a-la-salud-sin-barreras.jpg" alt="imagen de acceso a la salud sin barreras">
          <h3 class="text-aling-center margin-5rem-0">Acceso a la salud sin barreras</h3>
          <p class="text-aling-center">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo accusamus quo, delectus voluptate, libero sapiente velit obcaecati blanditiis quas eligendi magni sit debitis assumenda aliquam ea voluptatem tenetur, quis recusandae?
          </p>
        </div>
        <div>
          <img class="img-fracional" src="/src/img/b2-atencion-oportuna-y-confiable.jpg" alt="imagen de acceso a la salud sin barreras">
          <h3 class="text-aling-center margin-5rem-0">Acceso a la salud sin barreras</h3>
          <p class="text-aling-center">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo accusamus quo, delectus voluptate, libero sapiente velit obcaecati blanditiis quas eligendi magni sit debitis assumenda aliquam ea voluptatem tenetur, quis recusandae?
          </p>
        </div>
        <div>
          <img class="img-fracional" src="/src/img/b3-compromiso-con-tu-bienestar.jpg" alt="imagen de acceso a la salud sin barreras">
          <h3 class="text-aling-center margin-5rem-0">Acceso a la salud sin barreras</h3>
          <p class="text-aling-center">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Illo accusamus quo, delectus voluptate, libero sapiente velit obcaecati blanditiis quas eligendi magni sit debitis assumenda aliquam ea voluptatem tenetur, quis recusandae?
          </p>
        </div>
      </div>
    </div>
  </main>

<?php
incluirTemplate('footer');
?>
