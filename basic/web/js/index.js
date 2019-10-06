$(document).ready(() => {

    //Logica para el sidenav

    $('#prueba').on('click', () => {
        $("#mySidenav").css('display', 'block');
    });
    $('#mySidenav').on('mouseleave', () => {
        $("#mySidenav").css('display', 'none');
    });

    $('.contenido').on('touchstart', function (e) {
        $("#mySidenav").css('display', 'none');
    });
});