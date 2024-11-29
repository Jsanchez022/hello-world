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

    <title>Modificar Coche</title>
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

    <form action="../controlador/updateCoche.php" method="post">
        <div class="bg-primary text-white p-4 rounded my-4" style="width: 80%; margin: 0 auto;">
            <table style="width: 100%;">
                <tr>
                    <td style="text-align: right; width: 63%;">
                        <h1>Modificar Coche</h1>
                    </td>
                    <td style="text-align: right;">
                        <input type="submit" value="Guardar cambios" class="btn btn-info btn-lg text-white">
                    </td>
                </tr>
            </table>
        </div>

        <div class="bg-info text-white p-4 rounded my-4 mx-auto flex-column" style="width: 500px;">

            <table>
                <tr>
                    <td>
                        <label for="matricula" class="form-label fs-4">Matrícula</label>
                        <?php
                        $coches = Conexion::selectCoche();
                        echo "<select name='matricula' id='matricula' class='form-select' style='width: 75%'>";
                        foreach($coches as $coche) {
                            echo "<option value='" . htmlspecialchars($coche['matricula']) . "'>" . 
                                htmlspecialchars($coche['matricula']) . "</option>";
                        }
                        echo "</select>";
                    ?>
                    </td>
                    <td>
                        <label for="marca" class="form-label fs-4">Marca</label>
                        <input type="text" name="marca" id="marca" class="form-control" style="width: 75%;" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <br>
                        <label for="modelo" class="form-label fs-4">Modelo</label>
                        <input type="text" name="modelo" id="modelo" class="form-control" style="width: 75%;" required>
                    </td>
                    <td>
                        <br>
                        <label for="color" class="form-label fs-4">Color</label>
                        <select name="color" id="color" class="form-select" style="width: 75%;">
                            <option value="rojo">Rojo</option>
                            <option value="verde">Verde</option>
                            <option value="azul">Azul</option>
                            <option value="amarillo">Amarillo</option>
                            <option value="naranja">Naranja</option>
                            <option value="rosa">Rosa</option>
                            <option value="morado">Morado</option>
                            <option value="blanco">Blanco</option>
                            <option value="negro">Negro</option>
                            <option value="gris">Gris</option>
                            <option value="marrón">Marrón</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <br>
                        <label for="cif" class="form-label fs-4">CIF</label>
                        <?php
                            $concesionarios = Conexion::selectConcesionario();
                            echo "<select name='cif' id='cif' class='form-select' style='width: 75%;'>";
                            foreach($concesionarios as $concesionario) {
                                echo "<option value='" . htmlspecialchars($concesionario['cif']) . "'>" . 
                                    htmlspecialchars($concesionario['cif']) . "</option>";
                            }
                            echo "</select>";
                        ?>
                    </td>
                    <td>
                        <br>
                        <label for="precio" class="form-label fs-4">Precio</label>
                        <input type="number" name="precio" id="precio" class="form-control" style="width: 75%" required>
                        <div id="precioError" class="error-message" style="color: red; font-size: 0.875rem;"></div>
                    </td>
                </tr>
            </table>
        </div>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

        const precio = document.getElementById("precio");

        function clearErrorMessages() {
            document.querySelectorAll('.error-message').forEach(function(element) {
                element.textContent = "";
            });
        }

        function validateForm() {

            let isValid = true;

            clearErrorMessages();

            if (precio.value <= 0) {

                document.getElementById("precioError").textContent = "El precio debe ser mayor que 0.";
                isValid = false;

            }

            return isValid;
        }   

        precio.addEventListener("input", validateForm);

        const form = document.getElementById("formCoche");
        form.addEventListener("submit", function(event) {
            if (!validateForm()) {
                event.preventDefault();
            }
        });

    });
    </script>

</body>

</html>