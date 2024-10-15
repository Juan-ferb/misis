document.addEventListener("DOMContentLoaded", function () {
    const container = document.getElementById('calificacionesGrid');
    const data = [
        ["Materia", "Notas (70%)", "Prueba de Periodo (20%)", "Evaluaciones (10%)", "Promedio Final"],
        ["Español", "", "", "", ""],
        ["Inglés", "", "", "", ""],
        ["Matemáticas", "", "", "", ""],
        ["Física", "", "", "", ""],
        ["Química", "", "", "", ""],
        ["Sociales", "", "", "", ""],
        ["Filosofía", "", "", "", ""],
        ["Tecnología", "", "", "", ""]
    ];

    const hot = new Handsontable(container, {
        data: data,
        rowHeaders: true,
        colHeaders: true,
        contextMenu: true,
        manualColumnResize: true,
        manualRowResize: true,
        className: "htCenter htMiddle",
        licenseKey: 'non-commercial-and-evaluation'
    });
});
