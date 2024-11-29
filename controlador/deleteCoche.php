<?php
    include_once '../modelo/Conexion.php';
    include_once '../modelo/Coche.php';

    // Asegurarse de que la matrícula esté presente
    if (!isset($_POST['matricula']) || empty($_POST['matricula'])) {
        echo "Error: No se proporcionó una matrícula válida.";
        exit;
    }

    $matricula = $_POST['matricula'];

    try {
        // Crear el objeto Coche con la matrícula recibida
        $coche = new Coche($matricula, null, null, null, null, null);

        // Realizar la eliminación en la base de datos
        $resultado = Conexion::deleteCoche($coche);

        // Comprobar si la eliminación fue exitosa
        if (!$resultado) {
            echo "Error: No se pudo eliminar el coche.";  // Si no se puede eliminar el coche, mostramos este mensaje
            exit;  // Salir aquí para que no se ejecute nada más
        }
        echo "success";  // Si todo va bien, devolver solo "success"        

    } catch (Exception $e) {
        echo "Error: Hubo un problema al procesar la solicitud. Detalles: " . $e->getMessage();
    }
?>
