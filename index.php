<?php
    include_once './controlador/mostrarConcesionarios.php';

    $concesionarios = mostrarElementos();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="./vista/index.css">

    <title>Concesionario</title>
</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Inicio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="./vista/altaCoches.php">Nuevo Coche</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./vista/altaConcesionarios.php">Nuevo Concesionario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./vista/modificarCoche.php">Modificar Coche</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./vista/modificarConcesionario.php">Modificar Concesionario</a>
                    </li>
                    <li>
                        <div class="alert alert-danger d-flex align-items-center d-none" role="alert" id="noCoches" style="position: absolute;">
                            <svg class="bi flex-shrink-0 me-2 d-none" role="img" aria-label="Danger:">
                                <use xlink:href="#exclamation-triangle-fill" /></svg>
                            <div>
                                No existen coches para este concesionario
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>



    <div class="bg-primary text-white p-4 rounded my-4" style="width: 80%; margin: 0 auto; text-align: center;">
        <h1>Concesionario</h1>
    </div>


    <div class="container">
        <form>
            <div class="row g-3 align-items-center">
                <div class="col-auto">
                    <label class="col-form-label" for="buscador">Buscador concesionario: </label>
                </div>
                <div class="col-auto">
                    <input type="text" name="buscador" id="buscador" class="form-control"
                        aria-describedby="buscarporcif">
                </div>
                <div class="col-auto">
                    <span id="buscarporcif" class="form-text">Introduce un CIF</span>
                </div>
            </div>
        </form>

        <br>

        <table class="table table-borderless" id="concesionarios" style="border: none; ">
            <thead class="table-primary">
                <tr>
                    <th>CIF</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th style="text-align: center;">Ver datos</th>
                    <th style="border-top: none; border-right: none;" hidden></th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Mostrar los concesionarios en la tabla
                if (!empty($concesionarios)) {
                    foreach ($concesionarios as $concesionario) {
                        echo "<tr id='fila_" . htmlspecialchars($concesionario['cif']) . "'>";
                        echo "<td style='border: solid 1px'>" . htmlspecialchars($concesionario['cif']) . "</td>";
                        echo "<td style='border: solid 1px'>" . htmlspecialchars($concesionario['nombre']) . "</td>";
                        echo "<td style='border: solid 1px'>" . htmlspecialchars($concesionario['direccion']) . "</td>";
                        echo "<td style='border: solid 1px; text-align: center'>";
                        echo "<button class='btn-desplegar btn btn-primary' data-cif='" . htmlspecialchars($concesionario['cif']) . "'>Desplegar</button>";
                        echo "</td>";
                        echo "<td style='text-align: center; border: none;'>";
                        echo "<img src='./img/borrar.png' class='imagenesBorrarConcesionario' data-cif='" . htmlspecialchars($concesionario['cif']) . "'>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No hay concesionarios disponibles</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script type="module" src="./controlador/mostrarCochesConcesionario.js"></script>
    <script type="module" src="./controlador/mostrarCochesMatricula.js"></script>
    <script type="module" src="./controlador/mostrarConcesionariosCif.js"></script>

    <script type="module">
        import { configurarBotonesBorrar } from './controlador/borrarConcesionario.js';
        document.addEventListener('DOMContentLoaded', function () {
            // Configura los eventos de los botones al cargar la página
            configurarBotonesBorrar();
        });

    </script>

</body>

</html>