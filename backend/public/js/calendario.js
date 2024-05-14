document.addEventListener('DOMContentLoaded', function () {
    const calendar = document.getElementById('calendar');
    const eventForm = document.getElementById('add-event-form');

    // Cargar eventos existentes desde la base de datos (puedes usar AJAX aquí)

    eventForm.addEventListener('submit', function (e) {
        e.preventDefault();

        // Obtener los valores del formulario
        const eventName = document.getElementById('event-name').value;
        const eventDescription = document.getElementById('event-description').value;
        const eventDate = document.getElementById('event-date').value;
        const eventLocation = document.getElementById('event-location').value;

        // Enviar datos al servidor (puedes usar AJAX aquí)
        fetch('guardar_evento.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                nombre: eventName,
                descripcion: eventDescription,
                fecha: eventDate,
                lugar: eventLocation
            })
        })
        .then(response => {
            if (response.ok) {
                alert('Evento agregado correctamente');
                // Aquí puedes recargar los eventos del calendario
            } else {
                throw new Error('Error al agregar el evento');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ocurrió un error al agregar el evento');
        });
    });
});
