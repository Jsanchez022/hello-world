import { configurarBotonesBorrar } from './borrarConcesionario.js';

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('buscador').addEventListener('input', function () {
        const buscador = this.value;

        if (buscador.trim() !== '') {
            fetch(`./controlador/obtenerJSONCif.php?buscador=${encodeURIComponent(buscador)}`)
                .then(response => response.json())
                .then(data => {
                    const tabla = document.querySelector('#concesionarios tbody');
                    tabla.innerHTML = '';

                    if (data.error) {
                        tabla.innerHTML = `<tr><td colspan="4">${data.error}</td></tr>`;
                    } else if (data.length > 0) {
                        data.forEach(concesionario => {
                            const fila = `
                                <tr id='fila_${concesionario.cif}'>
                                    <td style='border: solid 1px'>${concesionario.cif}</td>
                                    <td style='border: solid 1px'>${concesionario.nombre}</td>
                                    <td style='border: solid 1px'>${concesionario.direccion}</td>
                                    <td style='border: solid 1px; text-align:center'>
                                    <input type='hidden' name='cif' value='${concesionario.cif}'>
                                    <button type='submit' class='btn-desplegar btn btn-primary' data-cif='${concesionario.cif}'>Desplegar</button>    
                                    </td>
                                    <td style='text-align: center; border: none;'>
                                    <img src="./img/borrar.png" class="imagenesBorrarConcesionario" data-cif="${concesionario.cif}">
                                    </td>
                                </tr>
                            `;
                            tabla.innerHTML += fila;
                        });

                        // Llama a la función para configurar eventos de borrado
                        configurarBotonesBorrar();
                    } else {
                        tabla.innerHTML = '<tr><td colspan="4" style="border: solid 1px">No hay concesionarios que coincidan</td></tr>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    const tabla = document.querySelector('#concesionarios tbody');
                    tabla.innerHTML = '<tr><td colspan="4" style="border: solid 1px">Error al buscar concesionarios</td></tr>';
                });
        } else {
            fetch('./controlador/mostrarConcesionarios.php?action=generarJSON')
                .then(response => response.json())
                .then(data => {
                    const tabla = document.querySelector('#concesionarios tbody');
                    tabla.innerHTML = '';

                    if (data.error) {
                        tabla.innerHTML = `<tr><td colspan="4">${data.error}</td></tr>`;
                    } else if (data.length > 0) {
                        data.forEach(concesionario => {
                            const fila = `
                                <tr id='fila_${concesionario.cif}'>
                                    <td style="border: solid 1px">${concesionario.cif}</td>
                                    <td style="border: solid 1px">${concesionario.nombre}</td>
                                    <td style="border: solid 1px">${concesionario.direccion}</td>
                                    <td style="border: solid 1px; text-align:center;">
                                    <input type='hidden' name='cif' value='${concesionario.cif}'>
                                    <button type='submit' class='btn-desplegar btn btn-primary' data-cif='${concesionario.cif}'>Desplegar</button>    
                                    </td>
                                    <td style='text-align: center; border: none;'>
                                    <img src="./img/borrar.png" class="imagenesBorrarConcesionario" data-cif="${concesionario.cif}">
                                    </td>
                                </tr>
                            `;
                            tabla.innerHTML += fila;
                        });

                        // Llama a la función para configurar eventos de borrado
                        configurarBotonesBorrar();
                    } else {
                        tabla.innerHTML = '<tr><td colspan="5" style="border: solid 1px">No hay concesionarios disponibles</td></tr>';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    const tabla = document.querySelector('#concesionarios tbody');
                    tabla.innerHTML = '<tr><td colspan="4" style="border: solid 1px">Error al cargar concesionarios</td></tr>';
                });
        }
    });
});
