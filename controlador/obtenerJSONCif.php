<?php
include_once __DIR__ . '/../modelo/Conexion.php';
include_once __DIR__ . '/../modelo/Concesionario.php';

header('Content-Type: application/json');

if (isset($_GET['buscador'])) {
    $cifBuscado = trim($_GET['buscador']);

    try {
        // Crear un objeto Concesionario con el CIF buscado
        $concesionario = new Concesionario($cifBuscado, null, null);

        // Usar la función selectConcesionarioPorCif para obtener resultados
        $resultados = Conexion::selectConcesionarioPorCif($concesionario);

        // Verificar si hay resultados
        if (!empty($resultados)) {
            echo json_encode($resultados);
        } else {
            echo json_encode(['error' => 'No se encontraron concesionarios con ese CIF']);
        }
    } catch (Exception $e) {
        echo json_encode(['error' => 'Error al buscar el concesionario: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['error' => 'Parámetro buscador no proporcionado']);
}
?>