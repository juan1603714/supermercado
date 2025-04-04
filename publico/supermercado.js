document.getElementById("editarPerfil").addEventListener("click", function() {
    document.getElementById("nombre").removeAttribute("disabled");
    document.getElementById("correo").removeAttribute("disabled");
    this.classList.add("d-none");
    document.getElementById("guardarPerfil").classList.remove("d-none");
});

document.getElementById("perfilForm").addEventListener("submit", function(event) {
    event.preventDefault();

    let formData = new FormData();
    formData.append("usuario_id", usuarioId); // Define usuarioId en el servidor
    formData.append("nombre", document.getElementById("nombre").value);
    formData.append("correo", document.getElementById("correo").value);

    fetch("actualizar_perfil.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        window.location.reload();
    })
    .catch(error => console.error("Error:", error));
});
