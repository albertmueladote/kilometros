$( document ).ready(function() {
    $('button.pdf').click(function(){
        pdf();
    });
    size(106);
    $('#logout').click(function(){
        logout();
    });
    loading();
});

function pdf()
{
    loading();
    var htmlContent = $('.container-fluid').html();
    var urlObj = new URL(window.location.href);
    $.ajax({
        url: 'controllers/ajaxPdf.php',
        type: 'POST',
        data: { html: htmlContent, id: urlObj.searchParams.get('id') },
            'X-Requested-With': 'XMLHttpRequest'
        },
        success: function(response) {
            response = JSON.parse(response);
            console.log('Respuesta del servidor:', response);
            window.open(response.path, '_blank');
        },
        error: function(xhr, status, error) {
            console.error('Error en la solicitud:', error);
        },
        complete: function(xhr, status) {
            loading();
        }
    });
}