document.getElementById('role').addEventListener('change', function () {
    var role = this.value;
    var codeGroup = document.getElementById('code-group');
    if (role === 'estudiante' || role === 'docente' || role === 'administrador' || role === 'directiva') {
        codeGroup.classList.remove('d-none');
        document.getElementById('code').required = true;
    } else {
        codeGroup.classList.add('d-none');
        document.getElementById('code').required = false;
    }
});

const form = document.getElementById("userForm");

form.addEventListener("submit", function (e){
    e.preventDefault();

    const formData = new FormData(form);

    fetch("../php/create.php", {
        method: "POST",
        body: formData,
    })
    .then(response => response.text())
    .then(data => {
        console.log("Usuario registrado", data);
        form.reset();
    })
    .catch(error => console.error("Error al registrar usuario:", error))
});