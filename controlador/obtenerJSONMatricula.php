<?php
include_once __DIR__ . '/../modelo/Conexion.php';
include_once __DIR__ . '/../modelo/Coche.php';

// Configurar el encabezado para devolver JSON
header('Content-Type: application/json');

// Capturar errores para evitar que interfieran con la salida JSON
try {
    if (isset($_POST['buscador_coches'], $_POST['cif'])) {
        $matriculaBuscada = trim($_POST['buscador_coches']);
        $cif = trim($_POST['cif']);

        $coche = new Coche($matriculaBuscada, null, null, null, $cif, null);
        $resultados = Conexion::selectCochePorMatricula($coche);

        if (!empty($resultados)) {
            echo json_encode($resultados);
        } else {
            echo json_encode(['error' => 'No se encontraron coches con esa matrícula']);
        }
    } else {
        echo json_encode(['error' => 'Parámetros buscador_coches o cif no proporcionados']);
    }
} catch (Exception $e) {
    echo json_encode(['error' => 'Error al buscar el coche: ' . $e->getMessage()]);
}
