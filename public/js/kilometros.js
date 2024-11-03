function loading()
{
	$('.loading').toggle();
}

function size(param)
{
	var containerFluidMarginTop = $('.container-fluid').css('margin-top');
	var containerFluidMarginBottom = $('.container-fluid').css('margin-bottom')
	var menu = 0;
	var menuMarginTop = 0;
	if($('.createPdf').length > 0) {
		menu = $('.createPdf').height();
		menuMarginTop = $('.container-fluid').css('margin-top');
	}
	$('.container-fluid').height($(window).height() - $('.navbar').height() - $('footer').height() - parseInt(containerFluidMarginTop) - parseInt(containerFluidMarginBottom) - parseInt(menu) - parseInt(menuMarginTop) - param);
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