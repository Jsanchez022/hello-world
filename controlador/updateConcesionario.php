<?php
    include_once "../modelo/Conexion.php";
    include_once '../modelo/Concesionario.php';

    $concesionario = new Concesionario($_POST["cif"], $_POST["nombre"], $_POST["direccion"]);
    if(Conexion::updateConcesionario($concesionario)) {
        header("Location: ../index.php");
        die();
    }
?>