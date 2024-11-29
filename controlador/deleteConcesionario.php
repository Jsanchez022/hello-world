<?php 
    include_once "../modelo/Conexion.php";
    include_once "../modelo/Concesionario.php";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['cif']) && !empty($_POST['cif'])) {
            $cif = $_POST['cif'];
    
            $concesionario = new Concesionario($cif, null, null);
            // Lógica para eliminar el concesionario
            $resultado = Conexion::deleteConcesionario($concesionario);
    
            if ($resultado) {
                echo "success";
            } else {
                echo "error";
            }
        } else {
            echo "error";
        }
    }

?>