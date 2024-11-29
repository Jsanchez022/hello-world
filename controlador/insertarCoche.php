<?php 
    include_once '../modelo/Conexion.php';
    include_once '../modelo/Coche.php';

    $coche = new Coche($_POST['matricula'], $_POST['marca'], $_POST['modelo'], $_POST['color'], $_POST['cif'], $_POST['precio']);

    if(Conexion::insertCoche($coche)) {
        echo "Se ha insertado bien el coche";
        header("Location: ../index.php");
        die();
    }
?>