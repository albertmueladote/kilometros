$( document ).ready(function() {
	var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
	    initialView: 'multiMonthYear',
	    firstDay: 1,
	    locale: 'es',
	    views: {
	        multiMonthYear: {
	            type: 'multiMonth',
	        }
	    },
	    dateClick: function(info) {
	        var hours = prompt("Indica cuantas horas:", "0");
	        if (hours !== null && hours !== "" && !isNaN(hours)) {
	        	var events = calendar.getEvents();
                events.forEach(function(event) {
                    if (event.startStr === info.dateStr) {
                        event.remove();
                    }
                });
     			if(hours > 0) {
	        		addEvent(calendar, hours, info.dateStr);
	        	}
	        	totalHours(calendar, info.dateStr);
	        	saveHour(hours, info.dateStr);
	        } else {
	            alert("Por favor, introduce un número válido.");
	        }
	    },
	    datesSet: function(info) {
	    	loading();
	    	totalColumn();
	    	var events = calendar.getEvents();
            events.forEach(function(event) {
                totalHours(calendar, event.startStr);
            });
	    	loading();
	    }
	});
    calendar.render();
    getHours(calendar);
    $('#logout').click(function(){
        logout();
    });

    loading();
});

function addEvent(calendar, event, date)
{
	var newEvent = {
        title: event,
        start: date,
        allDay: true
    };
    calendar.addEvent(newEvent);
}

function totalColumn()
{
	$('.fc-multimonth-title').each(function(index, title) {
		//$(title).html($(title).html() + ' (Total: )');
	});
	$('.fc-multimonth-month').each(function(index, table){
		$(this).find('thead tr').each(function(index, tr){
			$(this).append('<th role="columnheader" class="fc-col-header-cell fc-day fc-day-total"><div class="fc-scrollgrid-sync-inner"><a aria-label="Total" class="fc-col-header-cell-cushion">Total</a></div></th>');
		});
		$(this).find('tbody tr').each(function(index, tr){
			$(this).append('<td class="fc-total text-center"><a class="fc-daygrid-day-total"></a></td>');
		});
	});
}

function totalHours(calendar, dateStr)
{
	var clickedDate = new Date(dateStr);
	if(clickedDate.getDay() == 0) {
		var getDay = 7
	} else {
		var getDay = clickedDate.getDay();
	}
    var startOfWeek = new Date(clickedDate.setDate(clickedDate.getDate() - getDay + 1));
    var endOfWeek = new Date(clickedDate.setDate(clickedDate.getDate() + 6));

    var startOfWeekStr = startOfWeek.toISOString().split('T')[0];
    var endOfWeekStr = endOfWeek.toISOString().split('T')[0];

    var eventsInWeek = [];
	var events = calendar.getEvents();

	var total = 0;
	var totalTd = $('td[data-date="' + dateStr + '"]').closest('tr').find('td.fc-total .fc-daygrid-day-total');
	var totalMinutes = 0;
	events.forEach(function(event) {
	    var eventDate = event.startStr;
	    if (eventDate >= startOfWeekStr && eventDate <= endOfWeekStr) {
	        var parts = event.title.split('.');
	        var hours = parseInt(parts[0], 10) || 0; // Horas
	        var minutes = parseInt(parts[1], 10) || 0; // Minutos

	        totalMinutes += hours * 60 + minutes; 
 
	         /*if(totalTd == undefined) {
	         	totalTd = $('td[data-date="' + dateStr + '"]').closest('tr').find('td.fc-total .fc-daygrid-day-total');
	         }*/
	    }
	});

	var totalHours = Math.floor(totalMinutes / 60);
    var remainingMinutes = totalMinutes % 60;
    var total = totalHours + '.' + (remainingMinutes < 10 ? '0' + remainingMinutes : remainingMinutes);

    const targetMinutes = 37.5 * 60;
    var missingMinutes = totalMinutes - targetMinutes;

    var missingHours = Math.floor(Math.abs(missingMinutes) / 60);
    var missingRemainingMinutes = Math.abs(missingMinutes) % 60;

    var missingTime = (missingMinutes < 0 ? '-' : '+') + 
        missingHours + '.' + (missingRemainingMinutes < 10 ? '0' + missingRemainingMinutes : missingRemainingMinutes);

    var missingClass = missingMinutes < 0 ? "red" : "";

    var resultHtml = '<div class="' + missingClass + '">' + total + '</div><div>' + missingTime + '</div>';
    var totalTd = $('td[data-date="' + dateStr + '"]').closest('tr').find('td.fc-total .fc-daygrid-day-total');
    $(totalTd).html(resultHtml);
}

function saveHour(hours, date)
{
	loading();
    $.ajax({
        type: 'POST',
        url: 'controllers/ajax/ajaxSaveHour.php',
        data: {date: date, hours: hours},
        headers: {
	        'X-Requested-With': 'XMLHttpRequest'
	    },
        success: function(response) {

        },
        error: function(xhr, status, error) {
            console.error('Error en la solicitud:', status, error);
        },
        complete: function(xhr, status) {
            loading();
        }
    });
}

function getHours(calendar)
{
    $.ajax({
        type: 'POST',
        url: 'controllers/ajax/ajaxGetAllHour.php',
        data: {},
        headers: {
	        'X-Requested-With': 'XMLHttpRequest'
	    },
        success: function(response) {
        	JSON.parse(response).hours.forEach(function(eventData) {
	            addEvent(calendar, eventData.hours, eventData.date);
	            totalHours(calendar, eventData.date);
	        });
        },
        error: function(xhr, status, error) {
            console.error('Error en la solicitud:', status, error);
        },
        complete: function(xhr, status) {
            
        }
    });
}
