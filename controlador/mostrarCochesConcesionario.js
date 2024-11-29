import {
    inicializarBuscadorCoches
} from './mostrarCochesMatricula.js';

document.addEventListener("DOMContentLoaded", function () {

    inicializarBuscadorCoches();

    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("btn-desplegar")) {
            const boton = e.target;
            const fila = boton.closest("tr"); // Obtener la fila actual
            const cif = boton.getAttribute("data-cif"); // Obtener el CIF del concesionario

            if (!cif || !/^\w+$/.test(cif)) {
                alert("CIF inválido.");
                return;
            }

            const siguienteFila = fila.nextElementSibling;
            if (siguienteFila && siguienteFila.classList.contains("detalle-coches")) {
                siguienteFila.remove(); // Eliminar si ya existe una tabla desplegada
                return;
            }

            // Realizar la solicitud fetch para obtener los coches del concesionario
            fetch("./controlador/sacarJSONCochesCif.php", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded",
                    },
                    body: new URLSearchParams({
                        cif: cif
                    }),
                })
                .then(response => response.json())
                .then(datosCoche => {
                    if (datosCoche.error) {
                        console.error("Error recibido del servidor:", datosCoche.error);
                        //Mostrar alert no coches
                        document.getElementById("noCoches").classList.remove("d-none");
                        return;
                    }

                    // Esconder alert no coches
                    document.getElementById("noCoches").classList.add("d-none");

                    // Crear la fila con la tabla embebida
                    const nuevaFila = document.createElement("tr");
                    nuevaFila.classList.add("detalle-coches"); // Clase para identificar esta fila
                    nuevaFila.innerHTML = `
                        <td colspan="4">
                            <table class="table" style="border: none;">
                                <thead class="table-info">
                                <br>
                                    <form>
                                        <div class="row g-3 align-items-center">
                                            <div class="col-auto">
                                                <label class="col-form-label" for="buscador">Buscador coche: </label>
                                            </div>
                                            <div class="col-auto">
                                                <input type="text" name="buscador_coches" id="buscador_coches" class="form-control buscador_coches"
                                                    aria-describedby="buscarpormatricula">
                                            </div>
                                            <div class="col-auto">
                                                <span id="buscarpormatricula" class="form-text">Introduce una matricula</span>
                                            </div>
                                        </div>
                                    </form>
                                    <br>
                                    <br>
                                    <tr>
                                        <th>Matrícula</th>
                                        <th>Marca</th>
                                        <th>Modelo</th>
                                        <th>Color</th>
                                        <th>Precio</th>
                                        <th style="border: none;" hidden></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${datosCoche.length > 0 ? 
                                        datosCoche
                                            .map(coche => ` 
                                                <tr>
                                                    <td>${coche.matricula}</td>
                                                    <td>${coche.marca}</td>
                                                    <td>${coche.modelo}</td>
                                                    <td>${coche.color}</td>
                                                    <td>${coche.precio}</td>
                                                    <td style="border:none; text-align: center;">
                                                    <img src='./img/borrar.png' class='imagenesBorrarCoche' data-matricula="${coche.matricula}">
                                                    </td>
                                                </tr>
                                            `)
                                            .join("") : 
                                        `<tr><td colspan="6">No hay coches disponibles.</td></tr>`}
                                </tbody>
                            </table>
                        </td>
                    `;

                    // Insertar la nueva fila debajo de la fila actual
                    fila.parentNode.insertBefore(nuevaFila, fila.nextSibling);

                    inicializarBuscadorCoches(cif);

                    // Si no hay coches, ocultar el encabezado de la tabla de coches
                    const tablaCoches = nuevaFila.querySelector("table");
                    if (tablaCoches && tablaCoches.querySelector("tbody").children.length === 0) {
                        const thead = tablaCoches.querySelector("thead");
                        if (thead) {
                            thead.style.display = "none"; // Ocultar la fila de encabezados si no hay coches
                        }
                    }
                })
                .catch(error => console.error("Error al obtener datos:", error));
        }
    });

    // Escuchar eventos de clic en las imágenes de borrar coches
    document.addEventListener("click", function (e) {
        if (e.target.classList.contains("imagenesBorrarCoche")) {
            const matricula = e.target.getAttribute("data-matricula"); // Obtener la matrícula del coche
            const fila = e.target.closest("tr"); // Obtener la fila del coche
            const tablaCoches = fila.closest("table"); // Obtener la tabla de coches
            const tdTablaCoches = tablaCoches.parentNode;

            // Confirmar eliminación
            if (confirm("¿Estás seguro de que deseas eliminar este coche?")) {
                // Realizar la solicitud fetch para eliminar el coche de la base de datos
                fetch("./controlador/deleteCoche.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                        },
                        body: new URLSearchParams({
                            matricula: matricula
                        }), // Enviar la matrícula del coche
                    })
                    .then(response => response.text())
                    .then(data => {
                        if (data.trim() === "success") {
                            fila.remove(); // Eliminar la fila de la tabla
                            alert("Se ha eliminado el coche con éxito.");
                            if (tablaCoches.querySelector("tbody").children.length === 0) {
                                tdTablaCoches.style.display = "none"; // Ocultar el encabezado si no hay coches
                            }
                        } else {
                            alert("Error al eliminar el coche: " + data); // Mostrar el error detallado si no es "success"
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                        alert("Hubo un problema al eliminar el coche.");
                    });
            }
        }
    });
});