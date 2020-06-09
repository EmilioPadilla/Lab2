var agenda;

document.addEventListener('DOMContentLoaded', function() {
	var calendarEl = document.getElementById('agenda');

	if(window.innerWidth < 992)
		document.getElementById("agenda").style.width = "100%";
	else if(window.innerWidth >= 992)
		document.getElementById("agenda").style.width = "100%";


	agenda = new FullCalendar.Calendar(calendarEl, {
	  plugins: ['dayGrid', 'bootstrap', 'interaction' ],
	  defaultView: 'dayGridDay',
	  themeSystem: "bootstrap",
	  aspectRatio: 1.4,
	  locale: 'es',
	  navLinks: true,
	  navLinkDayClick: function(date, jsEvent) {
		console.log('day', date.toISOString());
		console.log('coords', jsEvent.pageX, jsEvent.pageY);
	  },
	  dateClick: function(info)
	  {
		  addCalendarEvent(info);
	  }
	});

	agenda.render();
  });

document.body.onresize = function()
{
	if(window.innerWidth < 992)
		document.getElementById("agenda").style.width = "100%";
	else if(window.innerWidth >= 992)
		document.getElementById("agenda").style.width = "100%";
}

function addCalendarEvent(info){
	let title = prompt("¿Qué actividad deseas agregar?")
	let date = new Date(info.dateStr + 'T00:00:00'); // will be in local time

	if (title != null) { // valid?
	  agenda.addEvent({
		title: title,
		start: date,
		allDay: true
	  });
	  alert('Tarea creada de manera exitosa.');
	} else {
	  alert('La tarea debe tener un nombre.');
	}
	agenda.render();
}