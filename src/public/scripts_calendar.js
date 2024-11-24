let currentDate = new Date();

function updateCalendar() {
    generateCalendar(currentDate.getFullYear(), currentDate.getMonth() + 1);
}

function generateCalendar(year, month) {
    const calendarHeader = document.getElementById('current-month-year');
    const calendarBody = document.getElementById('calendar-body');
    
    // Configuración de la fecha para el primer día del mes
    const firstDay = new Date(year, month - 1, 1);
    const lastDay = new Date(year, month, 0).getDate();
    
    const monthNames = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
        "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    
    // Actualiza el encabezado del calendario
    calendarHeader.textContent = `${monthNames[month - 1]} ${year}`;
    
    let table = '<table><tr><th>Dom</th><th>Lun</th><th>Mar</th><th>Mié</th><th>Jue</th><th>Vie</th><th>Sáb</th></tr><tr>';
    
    // Añade celdas vacías para los días antes del inicio del mes
    for (let i = 0; i < firstDay.getDay(); i++) {
        table += '<td></td>';
    }

    // Bucle para generar los días del mes
    let currentDay = new Date(firstDay);
    for (let i = 1; i <= lastDay; i++) {
        if (currentDay.getDay() === 0 && i > 1) {
            table += '</tr><tr>';
        }
        const today = new Date();
        const isToday = i === today.getDate() && month === today.getMonth() + 1 && year === today.getFullYear();
        
        // Atributo data-fecha para cada celda, en formato YYYY-MM-DD
        const fecha = `${year}-${String(month).padStart(2, '0')}-${String(i).padStart(2, '0')}`;
        
        table += `<td class="${isToday ? 'today' : ''}" data-fecha="${fecha}">
                    <span class="day-number">${i}</span>
                    <span class="event-indicator"></span>
                  </td>`;
        
        currentDay.setDate(currentDay.getDate() + 1);
    }

    // Cierra la última fila si es necesario
    while (currentDay.getDay() !== 0 && currentDay.getDay() < 7) {
        table += '<td></td>';
        currentDay.setDate(currentDay.getDate() + 1);
    }
    
    table += '</tr></table>';
    calendarBody.innerHTML = table;

    // Llamada a la función de cargar eventos cada vez que se genere el calendario
    cargarEventosCalendario();

    // Agregar evento click a cada celda del calendario
    document.querySelectorAll('[data-fecha]').forEach(celda => {
        celda.addEventListener('click', () => {
            seleccionarDia(celda.getAttribute('data-fecha'));
        });
    });
}

// Función para cargar eventos en el calendario
function cargarEventosCalendario() {
    fetch('tu/controllador.php')
        .then(response => response.json())
        .then(data => {
            // Limpia los indicadores existentes
            document.querySelectorAll('.event-indicator').forEach(indicator => {
                indicator.textContent = '';
            });

            for (let fecha in data) {
                let cantidadEventos = parseInt(data[fecha]); // Asegurarse de que sea un número
                let celda = document.querySelector(`[data-fecha="${fecha}"]`);

                if (celda) {
                    let indicator = celda.querySelector('.event-indicator');
                    if (cantidadEventos === 1) {
                        indicator.textContent = '•'; // Un punto para un evento
                    } else if (cantidadEventos >= 2) {
                        indicator.textContent = '••'; // Dos puntos para dos o más eventos
                    }
                }
            }
        })
        .catch(error => console.error('Error al cargar eventos:', error));
}

// Función para seleccionar un día y mostrar los eventos en la lista
function seleccionarDia(fecha) {
    fetch(`tu/segundo/controllador.php?data=${fecha}`)
        .then(response => response.json())
        .then(data => {
            const eventListUl = document.getElementById('event-list-ul');
            eventListUl.innerHTML = ''; // Limpiar lista anterior

            if (data.length > 0) {
                data.forEach(evento => {
                    let li = document.createElement('li');
                    li.textContent = evento; // Asumiendo que el servidor devuelve un array de strings
                    eventListUl.appendChild(li);
                });
            } else {
                let li = document.createElement('li');
                li.textContent = "No hay eventos para este día";
                eventListUl.appendChild(li);
            }
        })
        .catch(error => console.error('Error al seleccionar día:', error));
}

// Event listeners para cambiar el mes
document.getElementById('prev-month').addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    updateCalendar();
});

document.getElementById('next-month').addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    updateCalendar();
});

// Inicialización del calendario
updateCalendar();