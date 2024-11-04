function loading()
{
	$('.loading').toggle();
}

function logout()
{
	loading();
    var user = $('#username').val();
    var password = $('#password').val();
    $.ajax({
        type: 'POST',
        url: 'controllers/ajax/ajaxLogout.php',
        data: { },
        headers: {
	        'X-Requested-With': 'XMLHttpRequest'
	    },
        success: function(response) {
            window.location.href = '/login';
        },
        error: function(xhr, status, error) {
            console.error('Error en la solicitud:', status, error);
        },
        complete: function(xhr, status) {
            loading();
        }
    });
}