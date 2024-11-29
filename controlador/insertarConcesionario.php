<?php 
    include_once '../modelo/Conexion.php';
    include_once '../modelo/Concesionario.php';

    $concesionario = new concesionario($_POST['cif'], $_POST['nombre'], $_POST['direccion']);
    if(Conexion::insertconcesionario($concesionario)) {
        header("Location: ../index.php");
        die();
    } else {
        echo "Ha habido un error a la hora de insertar el concesionario";
    }
?>