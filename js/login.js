$( document ).ready(function() {
    $('#login').click(function(event){
        event.preventDefault();
        login();
    });
    size(36);
    loading();
});

function login()
{
    loading();
    var user = $('#username').val();
    var password = $('#password').val();
    $.ajax({
        type: 'POST',
        url: 'controllers/ajaxLogin.php',
        data: { user: user, password: password },
        success: function(response) {
            console.log('Respuesta del servidor:', response);
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