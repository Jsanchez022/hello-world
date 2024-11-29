
export function configurarBotonesBorrar() {
    const deleteButtons = document.querySelectorAll(".imagenesBorrarConcesionario");

    deleteButtons.forEach(button => {
        button.addEventListener("click", manejarClickBorrar);
    });
}

function manejarClickBorrar(event) {
    const button = event.currentTarget;
    const cif = button.getAttribute("data-cif");

    if (confirm("¿Estás seguro de que deseas eliminar este concesionario?")) {
        fetch('./controlador/deleteConcesionario.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: new URLSearchParams({ cif }).toString()
        })
        .then(response => response.text())
        .then(data => {
            if (data === "success") {
                const row = document.getElementById(`fila_${cif}`);
                if (row) {
                    row.remove();
                    alert("Concesionario eliminado correctamente.");
                }
            } else {
                alert("Error al eliminar el concesionario.");
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("Hubo un problema con la solicitud.");
        });
    }
}
