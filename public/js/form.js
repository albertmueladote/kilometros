$( document ).ready(function() {
    $('.new_row button').click(function(){
        addRow();
    })
    $('.save button').click(function(){
        const ask = confirm('¿Estás seguro de que quieres guardar?');
        if (ask) {
            save();
        }
    })
    addRow();
    $('.day input[type="date"]').change(updateDates);
    $('#logout').click(function(){
        logout();
    });
    loading();
});

function addRow()
{
    var newRowId = getNewRowId();
    var row = '<tr class="value value_' + newRowId + '"><td class="day"><input type="date" name="day_' + newRowId + '"></td><td class="long"><input type="text" name="long_' + newRowId + '"></td><td class="distance"><input type="text" name="distance_' + getNewRowId() + '"></td><td class="remove"><button type="button" class="btn btn-outline-danger"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16"><path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"></path><path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"></path></svg></button></td></tr>';
    $('table .options').before(row);
    eventsRow(newRowId);
}

function eventsRow(newRowId)
{
    $('tr.value_' + newRowId + ' .remove button').click(function(){
        if($('tr.value').length > 1) {
            const ask = confirm('¿Estás seguro de que quieres eliminar esta fila?');
            if (ask) {
                $('table .value_' + newRowId).remove();
                updateTotal();
            }
        }
    });
    $('tr.value_' + newRowId + ' .day input').change(updateDates);
    $('tr.value_' + newRowId + ' .distance input').on('input', function() {
        updateTotal();
    });
}

function updateTotal()
{
    var total = 0;
    $('.distance input').each(function() {
        var value = parseFloat($(this).val());
        if (!isNaN(value)) {
            total += value;
        }
    });
    $('.total input').val(total.toFixed(2));
}

function updateDates()
{
    var dates = $('.day input[type="date"]').map(function() {
        return $(this).val();
    }).get();
    
    dates = dates.filter(function(date) {
        return date !== "";
    });
    
    if (dates.length === 0) {
        $('input[name="date_from"]').val('');
        $('input[name="date_to"]').val('');
        return;
    }

    var minDate = new Date(Math.min.apply(null, dates.map(function(date) {
        return new Date(date);
    })));
    var maxDate = new Date(Math.max.apply(null, dates.map(function(date) {
        return new Date(date);
    })));

    var formatDate = function(date) {
        var day = ("0" + date.getDate()).slice(-2);
        var month = ("0" + (date.getMonth() + 1)).slice(-2);
        var year = date.getFullYear();
        return year + '-' + month + '-' + day;
    };

    $('input[name="date_from"]').val(formatDate(minDate));
    $('input[name="date_to"]').val(formatDate(maxDate));
}

function getNewRowId()
{
    var new_tr = $('tr.value').length + 1;
    while(true)
    {
        if($('tr.value_' + new_tr).length == 0)
        {
            return new_tr;
        }
        new_tr++;
    }
}

function save()
{
    loading();
    var rows = [];
    $('tr.value').each(function() {
        var dateVal = $(this).find('td.day input').val();
        var longVal = $(this).find('td.long input').val();
        var distanceVal = $(this).find('td.distance input').val();

        dateVal = dateVal.split('-');
        dateVal = dateVal[2] + '-' + dateVal[1] + '-' + dateVal[0];

        if (dateVal && longVal && distanceVal) {
            $(this).find('input').removeClass('error');
            var row = {
                date: dateVal,
                long: longVal,
                distance: distanceVal
            };
            rows.push(row);
        } else {
            $(this).find('input').addClass('error');
        }
    });
    var total = $('.total input').val();
    var from = $('input[name="date_from"]').val();
    from = from.split('-');
    from = from[2] + '-' + from[1] + '-' + from[0];
    var to = $('input[name="date_to"]').val()
    to = to.split('-');
    to = to[2] + '-' + to[1] + '-' + to[0];
    $.ajax({
        url: 'controllers/ajax/ajaxSaveExcel.php',
        type: 'POST',
        data: { data: JSON.stringify(rows), total: total, from: from, to: to},
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        success: function(response) {
            response = JSON.parse(response);
            if(response.result)
            {
                window.open('/pdf?id=' + response.id, '_blank');
            } else {
                console.log(response.err);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error en la solicitud:', error);
        },
        complete: function(xhr, status) {
            loading();
        }
    });
}