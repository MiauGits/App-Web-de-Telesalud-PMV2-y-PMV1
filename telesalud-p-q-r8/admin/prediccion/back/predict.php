<?php


function predecirEspecialidad() {
    $especialidades = ['Medicina General', 'Pediatría', 'Ginecología', 'Cardiología', 'Dermatología'];
    return $especialidades[array_rand($especialidades)];
}

// Función que simula una predicción aleatoria para especialistas
function predecirEspecialista() {
    $especialistas = ['Dra. Pérez', 'Dr. Gómez', 'Dra. Torres', 'Dr. Ramírez', 'Dra. Chávez'];
    return $especialistas[array_rand($especialistas)];
}

// Función que simula una predicción aleatoria para horarios
function predecirHorario() {
    $horarios = ['08:00 - 09:00', '10:00 - 11:00', '14:00 - 15:00', '16:00 - 17:00'];
    return $horarios[array_rand($horarios)];
}

// Creamos un arreglo de 8 semanas
$semanas = [
    "Próxima semana",
    "Dentro de dos semanas",
    "En 3 semanas",
    "En 4 semanas",
    "En 5 semanas",
    "En 6 semanas",
    "En 7 semanas",
    "En 8 semanas"
];

// Variables que almacenarán los resultados finales
$resultados = []; // Aquí almacenamos todo estructurado por semana

foreach ($semanas as $indice => $nombreSemana) {
    // Llamamos a nuestras funciones para obtener predicciones
    $especialidad = predecirEspecialidad();
    $especialista = predecirEspecialista();
    $horario = predecirHorario();

    // Guardamos cada resultado en un arreglo asociativo por semana
    $resultados[$indice] = [
        "semana" => $nombreSemana,
        "especialidad" => $especialidad,
        "especialista" => $especialista,
        "horario" => $horario
    ];

    // Además, podrías guardar cada dato en variables individuales si lo deseas
    ${"especialidad_semana_" . ($indice + 1)} = $especialidad;
    ${"especialista_semana_" . ($indice + 1)} = $especialista;
    ${"horario_semana_" . ($indice + 1)} = $horario;
}

// Simulamos mostrar los resultados como si fueran enviados al frontend
// En el sistema real, aquí podrías enviar esto como JSON, insertar en una base de datos o llenar una tabla HTML
echo "<pre>";
echo "=== RESULTADOS SIMULADOS DE PREDICCIÓN ===\n";
foreach ($resultados as $res) {
    echo "Semana: " . $res['semana'] . "\n";
    echo " - Especialidad: " . $res['especialidad'] . "\n";
    echo " - Especialista: " . $res['especialista'] . "\n";
    echo " - Horario: " . $res['horario'] . "\n\n";
}
echo "</pre>";
?>
