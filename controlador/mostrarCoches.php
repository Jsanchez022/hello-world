<?php 
include_once __DIR__ . '/../modelo/Conexion.php';

/**
 * Genera un JSON con los coches filtrados por CIF
 * @param string|null $cif
 * @return void
 */
function generarCochesJSON($cif) {
    if ($cif) {
        // Obtener los coches del concesionario con el CIF proporcionado
        echo json_encode(Conexion::selectCochePorCif($cif));
    } else {
        echo json_encode(['error' => 'CIF no proporcionado']);
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? null;
    $cif = $_POST['cif'] ?? null;

    switch ($action) {
        case 'generarJSON':
            generarCochesJSON($cif);
            break;
        default:
            echo json_encode(['error' => 'Acción no válida']);
            break;
    }
} else {
    echo json_encode(['error' => 'Método no permitido']);
}
?>
