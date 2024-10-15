document.addEventListener('DOMContentLoaded', function () {
    const roleSelect = document.getElementById('role');
    const codeGroup = document.getElementById('code-group');
    const codeInput = document.getElementById('code');

    roleSelect.addEventListener('change', function(event) {
        const selectedRole = event.target.value; // Aquí usamos event.target para obtener el valor correctamente.

        // Mostrar el campo "Código" si el rol es "docente", "administrador" o "directiva"
        if (selectedRole === 'docente' || selectedRole === 'administrador' || selectedRole === 'directiva') {
            codeGroup.classList.remove('d-none');
            codeInput.setAttribute('required', 'required'); // Hacer que el código sea obligatorio
        } else {
            codeGroup.classList.add('d-none');
            codeInput.removeAttribute('required'); // Eliminar la obligatoriedad si el rol no lo requiere
            codeInput.value = ''; // Limpiar el campo de código si está oculto
        }
    });
});