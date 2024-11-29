<?php 
    include_once '../modelo/Conexion.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- JavaScript de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <title>Modificar Concesionario</title>
</head>

<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">Inicio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="altaCoches.php">Nuevo Coche</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="altaConcesionarios.php">Nuevo Concesionario</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="modificarCoche.php">Modificar Coche</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="modificarConcesionario.php">Modificar Concesionario</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <form action="../controlador/updateConcesionario.php" method="post">
        <div class="bg-primary text-white p-4 rounded my-4" style="width: 80%; margin: 0 auto;">
            <table style="width: 100%;">
                <tr>
                    <td style="text-align: right; width: 70%;">
                        <h1>Modificar Concesionario</h1>
                    </td>
                    <td style="text-align: right;">
                        <input type="submit" value="Guardar cambios" class="btn btn-info btn-lg text-white">
                    </td>
                </tr>
            </table>
        </div>

        <div class="bg-info text-white p-4 rounded my-4 mx-auto flex-column" style="width: 500px;">


            <div style="display: flex; align-items: center; gap: 10px;">
            <label for="cif" class="form-label fs-4">Cif</label>
            <?php
                $concesionarios = Conexion::selectConcesionario();
                echo "<select name='cif' id='cif' class='form-select' style='width:50%;'>";
                foreach($concesionarios as $concesionario) {
                    echo "<option value='" . htmlspecialchars($concesionario['cif']) . "'>" . 
                        htmlspecialchars($concesionario['cif']) . "</option>";
                }
                echo "</select>";
            ?>
            </div>

            <br>

            <div style="display: flex; align-items: center; gap: 10px;">
                <label for="nombre" class="form-label fs-4">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="form-control" style="width: 50%;" required>
            </div>

            <br>

            <div style="display: flex; align-items: center; gap: 10px;">
                <label for="direccion" class="form-label fs-4">Direccion</label>
                <input type="text" name="direccion" id="direccion" class="form-control" style="width: 50%;" required>
            </div>

        </div>
    </form>
</body>

</html>