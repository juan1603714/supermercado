// Agregar proveedor
document.getElementById("agregarProveedorForm").addEventListener("submit", function(event) {
    event.preventDefault();
    let formData = new FormData(this);
    fetch("agregar_proveedor.php", { method: "POST", body: formData })
        .then(response => response.text())
        .then(() => location.reload());
});

// Editar proveedor
function editarProveedor(id, nombre, telefono) {
    document.getElementById("editarId").value = id;
    document.getElementById("editarNombre").value = nombre;
    document.getElementById("editarTelefono").value = telefono;
    new bootstrap.Modal(document.getElementById("editarProveedorModal")).show();
}

document.getElementById("editarProveedorForm").addEventListener("submit", function(event) {
    event.preventDefault();
    let formData = new FormData();
    formData.append("id", document.getElementById("editarId").value);
    formData.append("nombre", document.getElementById("editarNombre").value);
    formData.append("telefono", document.getElementById("editarTelefono").value);
    fetch("editar_proveedor.php", { method: "POST", body: formData })
        .then(response => response.text())
        .then(() => location.reload());
});

// Eliminar proveedor
function eliminarProveedor(id) {
    if (confirm("¿Estás seguro de eliminar este proveedor?")) {
        fetch("eliminar_proveedor.php?id=" + id, { method: "GET" })
            .then(() => location.reload());
    }
}
