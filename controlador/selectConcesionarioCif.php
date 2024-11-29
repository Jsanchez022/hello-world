<?php
    include_once '../modelo/Conexion.php';

    $cif = $_POST['buscador'];

    $datos = Conexion::selectConcesionarioPorCif($cif);
?>