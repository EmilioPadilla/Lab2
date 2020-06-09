var calendar;

document.addEventListener('DOMContentLoaded', function() {
	var calendarEl = document.getElementById('calendar');

	if(window.innerWidth < 992)
		document.getElementById("calendar").style.width = "100%";
	else if(window.innerWidth >= 992)
		document.getElementById("calendar").style.width = "40%";


	calendar = new FullCalendar.Calendar(calendarEl, {
	  plugins: [ 'dayGrid', 'bootstrap', 'interaction' ],
	  themeSystem: "bootstrap",
	  aspectRatio: 1.4,
	  locale: 'es',
	  navLinks: true,
	  eventLimit: 2,
	  navLinkDayClick: function(date, jsEvent) {
		console.log('day', date.toISOString());
		console.log('coords', jsEvent.pageX, jsEvent.pageY);
	  },
	  dateClick: function(info)
	  {
		  addCalendarEvent(info);
	  }
	});

	calendar.render();
  });

document.body.onresize = function()
{
	if(window.innerWidth < 992)
		document.getElementById("calendar").style.width = "100%";
	else if(window.innerWidth >= 992)
		document.getElementById("calendar").style.width = "40%";
}

function addCalendarEvent(info){
	let title = prompt("¿Cúal es el nombre del evento?")
	let date = new Date(info.dateStr + 'T00:00:00'); // will be in local time

	if (title != null) { // valid?
	  calendar.addEvent({
		title: title,
		start: date,
		allDay: true
	  });
	  alert('Evento creado');
	} else {
	  alert('El evento debe tener un nombre');
	}
	calendar.render();
}