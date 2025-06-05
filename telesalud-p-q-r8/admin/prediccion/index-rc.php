<?php
require '../../includes/funciones.php';
incluirTemplate('header');
?>

<main class="contenedor">
  <h2 class="tituloh2">Sistema de predicción</h2>

  <div class="tabla-container">
    <table class="tabla-telesalud">
      <thead>
        <tr>
          <th>Periodos de pronóstico</th>
          <th>Especialidad con mayor demanda</th>
          <th>Especialista más escogido</th>
          <th>Horarios más seleccionados</th>
        </tr>
      </thead>
      <tbody>
        <tr><td>Próxima semana</td>   <td>Medicina general</td>   <td>María Fernanda</td>   <td>10:10</td>     </tr>
        <tr><td>Dentro de dos semanas</td>   <td>Medicina general, Medicina Interna</td>   <td>María Fernanda, Luis Renato</td>   <td>10:10, 09:00</td>     </tr>
        <tr><td>En 3 semanas</td>   <td>Medicina general, Medicina Interna</td>   <td>María Fernanda, Luis Renato</td>   <td>10:10, 09:00</td>     </tr>
        <tr><td>En 4 semanas</td>   <td>Medicina general, Medicina Interna</td>   <td>María Fernanda, Luis Renato</td>   <td>10:10, 09:00</td>     </tr>
        <tr><td>En 5 semanas</td>   <td>Medicina general, Medicina Interna</td>   <td>María Fernanda, Luis Renato</td>   <td>10:10, 09:00</td>     </tr>
        <tr><td>En 6 semanas</td>   <td>Medicina general, Medicina Interna</td>   <td>María Fernanda, Luis Renato</td>   <td>10:10, 09:00</td>     </tr>
        <tr><td>En 7 semanas</td>   <td>Medicina general, Medicina Interna, Rehabilitación</td>   <td>María Fernanda, Luis Renato, Ana Lucía</td>   <td>10:10, 09:00, 11:00</td>     </tr>
        <tr><td>En 8 semanas</td>   <td>Medicina general, Medicina Interna, Rehabilitación</td>   <td>María Fernanda, Luis Renato, Ana Lucía</td>   <td>10:10, 09:00, 11:00</td>     </tr>
      </tbody>
    </table>
  </div>
  
  <div class="nav-under-crud">
    <a class="btn-crud2" href="/admin">Panel general</a>
  </div>

</main>

<?php
incluirTemplate('footer');
?>
