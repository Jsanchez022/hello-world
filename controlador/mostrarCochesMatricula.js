export function inicializarBuscadorCoches(cif) {
    const buscadores = document.getElementsByClassName('buscador_coches');

    if (!buscadores || buscadores.length === 0) return;

    Array.from(buscadores).forEach(buscador => {
        buscador.addEventListener('input', function () {
            const valor = buscador.value.trim();
            const tabla = buscador.closest('.detalle-coches').querySelector('tbody');
            tabla.innerHTML = ''; // Limpiar la tabla

            if (valor !== '') {
                fetch(`./controlador/obtenerJSONMatricula.php`, {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: new URLSearchParams({ buscador_coches: valor, cif }),
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            tabla.innerHTML = `<tr><td colspan="5">${data.error}</td></tr>`;
                        } else if (data.length > 0) {
                            tabla.innerHTML = data.map(coche => `
                                <tr>
                                    <td>${coche.matricula}</td>
                                    <td>${coche.marca}</td>
                                    <td>${coche.modelo}</td>
                                    <td>${coche.color}</td>
                                    <td>${coche.precio}</td>
                                    <td style="border: none;"><img src='./img/borrar.png' class='imagenesBorrarCoche' data-matricula="${coche.matricula}"></td>
                                </tr>
                            `).join('');
                        } else {
                            tabla.innerHTML = '<tr><td colspan="5">No hay coches que coincidan</td></tr>';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        tabla.innerHTML = '<tr><td colspan="5">Error al buscar coches</td></tr>';
                    });
            } else {
                fetch("./controlador/mostrarCoches.php", {
                    method: "POST",
                    headers: { "Content-Type": "application/x-www-form-urlencoded" },
                    body: new URLSearchParams({ cif, action: "generarJSON" }),
                })
                    .then(response => response.json())
                    .then(data => {
                        tabla.innerHTML = data.length > 0
                            ? data.map(coche => `
                                <tr>
                                    <td>${coche.matricula}</td>
                                    <td>${coche.marca}</td>
                                    <td>${coche.modelo}</td>
                                    <td>${coche.color}</td>
                                    <td>${coche.precio}</td>
                                    <td style="border:none"><img src='./img/borrar.png' class='imagenesBorrarCoche' data-matricula="${coche.matricula}"></td>
                                </tr>
                            `).join('')
                            : '<tr><td colspan="5">No hay coches disponibles</td></tr>';
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        tabla.innerHTML = '<tr><td colspan="5">Error al cargar coches</td></tr>';
                    });
            }
        });
    });
}
