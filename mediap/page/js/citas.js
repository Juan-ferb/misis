document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        selectable: true,
        select: function(info) {
            document.getElementById('selected-date').value = info.startStr;
        },
        events: function(fetchInfo, successCallback, failureCallback) {
            var professional = document.getElementById('professional').value;
            var events = {
                psicologo: [
                    { title: 'Cita Disponibilidad', start: '2024-07-22T10:00:00', end: '2024-07-22T11:00:00' },
                    { title: 'Cita Disponibilidad', start: '2024-07-22T11:00:00', end: '2024-07-22T12:00:00' }
                ],
                psicoorientador: [
                    { title: 'Cita Disponibilidad', start: '2024-07-23T14:00:00', end: '2024-07-23T15:00:00' },
                    { title: 'Cita Disponibilidad', start: '2024-07-23T15:00:00', end: '2024-07-23T16:00:00' }
                ]
            };

            if (professional) {
                successCallback(events[professional]);
            }
        }
    });

    calendar.render();
});

document.getElementById('professional').addEventListener('change', function () {
    var calendar = FullCalendar.getCalendar('calendar');
    calendar.refetchEvents();
});