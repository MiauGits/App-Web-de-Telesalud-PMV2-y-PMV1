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
        <tr><td>Próxima semana</td>   <td>Psicología, Oftalmología</td>   <td>María Luisa, Jason Eduardo</td>   <td>15:00, 17:00</td>     </tr>
        <tr><td>Dentro de dos semanas</td>   <td>Psicología, Oftalmología, Psiquiatría, Otorrinolaringología</td>   <td>María Luisa, Juan Guillermo, Bruno Andrés, Denisse Lorena</td>   <td>15:00, 17:00, 16:00</td>     </tr>
        <tr><td>En 3 semanas</td>   <td>Psicología, Oftalmología, Psiquiatría, Otorrinolaringología</td>   <td>Eliana Marisol, Jason Eduardo, Bruno Andrés, Denisse Lorena</td>   <td>15:00, 17:00, 16:00</td>     </tr>
        <tr><td>En 4 semanas</td>   <td>Psicología, Oftalmología, Psiquiatría, Otorrinolaringología</td>   <td>María Fernanda, Juan Guillermo, Bruno Andrés, Denisse Lorena</td>   <td>15:00, 17:00, 16:00</td>     </tr>
        <tr><td>En 5 semanas</td>   <td>Psicología, Oftalmología, Psiquiatría, Otorrinolaringología</td>   <td>Eliana Marisol, Jason Eduardo, Bruno Andrés, Denisse Lorena</td>   <td>15:00, 17:00, 16:00</td>     </tr>
        <tr><td>En 6 semanas</td>   <td>Psicología, Oftalmología, Psiquiatría, Otorrinolaringología</td>   <td>María Fernanda, Juan Guillermo, Bruno Andrés, Denisse Lorena</td>   <td>15:00, 17:00, 16:00</td>     </tr>
        <tr><td>En 7 semanas</td>   <td>Psicología, Oftalmología, Psiquiatría, Otorrinolaringología, Medicina interna</td>   <td>Eliana Marisol, Jason Eduardo, Bruno Andrés, Denisse Lorena, Luis Renato</td>   <td>15:00, 17:00, 16:00, 16:30</td>     </tr>
        <tr><td>En 8 semanas</td>   <td>Psicología, Oftalmología, Psiquiatría, Otorrinolaringología, Medicina interna</td>   <td>María Fernanda, Juan Guillermo, Bruno Andrés, Denisse Lorena, Luis Renato</td>   <td>15:00, 17:00, 16:00, 16:30</td>     </tr>
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
