$( document ).ready(function() {
    size(36);
    $('.remove button').click(function(){
        const ask = confirm('¿Estás seguro de que quieres eliminar el fichero?');
        if (ask) {
            remove($(this).closest('div').data('id'));
        }
    });
    $('#logout').click(function(){
        logout();
    });
    loading();
});

function remove(id)
{
    loading();
    $.ajax({
        url: 'controllers/ajax/ajaxRemove.php',
        type: 'POST',
        data: { id: id },
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        },
        success: function(response) {
            response = JSON.parse(response);
            $('.file_content.data-' + id).remove();
        },
        error: function(xhr, status, error) {
            console.error('Error en la solicitud:', error);
        },
        complete: function(xhr, status) {
            loading();
        }
    });
}