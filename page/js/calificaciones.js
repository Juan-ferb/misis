const subjects = {
    espanol: 'Español',
    ingles: 'Inglés',
    matematicas: 'Matemáticas',
    fisica: 'Física',
    quimica: 'Química',
    sociales: 'Sociales',
    filosofia: 'Filosofía',
    tecnologia: 'Tecnología'
};

document.querySelectorAll('.subject-button').forEach(button => {
    button.addEventListener('click', () => {
        const subject = button.getAttribute('data-subject');
        loadGrades(subject);
    });
});

function loadGrades(subject) {
    const tbody = document.getElementById('gradesTableBody');
    tbody.innerHTML = `
        <tr>
            <td>${subjects[subject]}</td>
            <td>
                ${createGradeInputs(9, 'grade-input-70')}
                <div class="average-70"></div>
            </td>
            <td>
                ${createGradeInputs(1, 'grade-input-20')}
                <div class="average-20"></div>
            </td>
            <td>
                ${createGradeInputs(1, 'grade-input-10')}
                <div class="average-10"></div>
            </td>
            <td class="final-average"></td>
        </tr>
    `;

    document.querySelectorAll('.grade-input-70, .grade-input-20, .grade-input-10').forEach(input => {
        input.addEventListener('input', calculateAverages);
    });
}

function createGradeInputs(count, className) {
    let inputs = '';
    for (let i = 0; i < count; i++) {
        inputs += `<input type="number" class="grade-input ${className} form-control" min="0" max="100">`;
    }
    return inputs;
}

function calculateAverages() {
    const row = this.closest('tr');
    
    const gradeInputs70 = row.querySelectorAll('.grade-input-70');
    const average70 = calculateAverage(gradeInputs70);
    row.querySelector('.average-70').innerText = `Promedio: ${average70.toFixed(2)}`;
    
    const gradeInputs20 = row.querySelectorAll('.grade-input-20');
    const average20 = calculateAverage(gradeInputs20);
    row.querySelector('.average-20').innerText = `Promedio: ${average20.toFixed(2)}`;
    
    const gradeInputs10 = row.querySelectorAll('.grade-input-10');
    const average10 = calculateAverage(gradeInputs10);
    row.querySelector('.average-10').innerText = `Promedio: ${average10.toFixed(2)}`;

    const finalAverage = (average70 * 0.7) + (average20 * 0.2) + (average10 * 0.1);
    row.querySelector('.final-average').innerText = finalAverage.toFixed(2);
}

function calculateAverage(inputs) {
    let sum = 0;
    let count = 0;
    inputs.forEach(input => {
        const value = parseFloat(input.value);
        if (!isNaN(value)) {
            sum += value;
            count++;
        }
    });
    return count > 0 ? sum / count : 0;
}
