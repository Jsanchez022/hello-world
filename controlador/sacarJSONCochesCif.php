<?php
include_once '../modelo/Conexion.php';
header('Content-Type: application/json; charset=utf-8');

// Validamos la entrada
if (!isset($_POST['cif']) || empty($_POST['cif'])) {
    echo json_encode(['error' => 'El CIF del concesionario no está presente o es inválido.']);
    exit;
}

$cif = $_POST['cif'];

try {
    // Realizamos la consulta directamente con el CIF
    $datos = Conexion::selectCochePorCif($cif);

    if ($datos) {
        // Devolvemos los datos en formato JSON
        echo json_encode($datos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    } else {
        // Si no hay datos, devolvemos un mensaje adecuado
        echo json_encode(['error' => 'No se encontraron coches para el CIF proporcionado.']);
    }
} catch (Exception $e) {
    echo json_encode(['error' => 'Hubo un problema al procesar la solicitud. Detalles del error: ' . $e->getMessage()]);
}
?>
