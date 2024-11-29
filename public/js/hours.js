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
	        	totalWeekHours(calendar, info.dateStr);
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
                totalWeekHours(calendar, event.startStr);
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

function totalWeekHours(calendar, dateStr)
{
	var clickedDate = new Date(dateStr);
	if(clickedDate.getDay() == 0) {
		var getDay = 7
	} else {
		var getDay = clickedDate.getDay();
	}
    var startOfWeek = new Date(clickedDate.setDate(clickedDate.getDate() - getDay + 1));
    var endOfWeek = new Date(clickedDate.setDate(clickedDate.getDate() + 6));

    var startOfWeekStr = formatDateLocal(startOfWeek);
    var endOfWeekStr = formatDateLocal(endOfWeek);

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

    var missingClass = missingMinutes < 0 ? "red" : "green";

    var resultHtml = '<div class="fc-daygrid-day-frame"><div class="mt-2 text-center">' + total + '</div><div class="fc-daygrid-day-events ' + missingClass + '"><div class="fc-event-main"><div class="fc-event-main-frame"><div class="fc-event-title fc-sticky">' + missingTime + '</div></div></div></div></div>'
    var totalTd = $('td[data-date="' + endOfWeekStr + '"]').closest('tr').find('td.fc-total .fc-daygrid-day-total');
    $('td[data-date="' + startOfWeekStr + '"]').closest('tr').find('td.fc-total .fc-daygrid-day-total').html('');
    $(totalTd).html(resultHtml);
    totalMonthHours(calendar, dateStr);
}

function totalMonthHours(calendar, dateStr)
{
	var clickedDate = new Date(dateStr);

    var startOfMonth = new Date(clickedDate.getFullYear(), clickedDate.getMonth(), 1);
    var endOfMonth = new Date(clickedDate.getFullYear(), clickedDate.getMonth() + 1, 0);

    var startOfMonthStr = formatDateLocal(startOfMonth);
    var endOfMonthStr = formatDateLocal(endOfMonth);

    var totalMinutes = 0;

    var events = calendar.getEvents();
    events.forEach(function (event) {
        var eventDate = event.startStr;

        if (eventDate >= startOfMonthStr && eventDate <= endOfMonthStr) {
            var parts = event.title.split('.');
            var hours = parseInt(parts[0], 10) || 0; // Horas
            var minutes = parseInt(parts[1], 10) || 0; // Minutos

            totalMinutes += hours * 60 + minutes;
        }
    });

    var totalHours = Math.floor(totalMinutes / 60);
    var remainingMinutes = totalMinutes % 60;

    var total = totalHours + '.' + (remainingMinutes < 10 ? '0' + remainingMinutes : remainingMinutes);

    if($('td[data-date="' + startOfMonthStr + '"]').closest('.fc-multimonth-month').find('.total-hours').length == 0) {
    	$('td[data-date="' + startOfMonthStr + '"]').closest('.fc-multimonth-month').find('.fc-multimonth-header .fc-multimonth-title').after("<div class='total-hours'>(" + total + ")</div>");
    } else {
    	$('td[data-date="' + startOfMonthStr + '"]').closest('.fc-multimonth-month').find('.total-hours').html("(" + total + ")");
    }
}

function formatDateLocal(date) {
    var year = date.getFullYear();
    var month = (date.getMonth() + 1).toString().padStart(2, '0'); // Mes empieza en 0
    var day = date.getDate().toString().padStart(2, '0');
    return `${year}-${month}-${day}`;
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
	            totalWeekHours(calendar, eventData.date);
	        });
        },
        error: function(xhr, status, error) {
            console.error('Error en la solicitud:', status, error);
        },
        complete: function(xhr, status) {
            
        }
    });
}
