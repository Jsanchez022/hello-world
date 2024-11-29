<?php
include_once __DIR__ . '/../modelo/Conexion.php';

/**
 * Muestra todos los concesionarios
 * @return array Concesionarios
 */
function mostrarElementos() {
    return Conexion::selectConcesionario();
}

/**
 * Genera un JSON con los concesionarios
 * @return void
 */
function generarConcesionariosJSON() {
    echo json_encode(Conexion::selectConcesionario());
}

// Manejar la solicitud
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    switch ($action) {
        case 'generarJSON':
            generarConcesionariosJSON();
            break;
        default:
            echo json_encode(['error' => 'Acción no válida']);
            break;
    }
}
?>
