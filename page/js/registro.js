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