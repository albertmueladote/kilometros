$( document ).ready(function() {
    $('#login').click(function(event){
        event.preventDefault();
        login();
    });

    loading();
});

function login()
{
    loading();
    var user = $('#username').val();
    var password = $('#password').val();
    $.ajax({
        type: 'POST',
        url: 'controllers/ajax/ajaxLogin.php',
        data: { user: user, password: password },
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        success: function(response) {
            window.location.href = '/';
        },
        error: function(xhr, status, error) {
            console.error('Error en la solicitud:', status, error);
        },
        complete: function(xhr, status) {
            loading();
        }
    });
}