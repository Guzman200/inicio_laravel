require('./bootstrap');
require("@fortawesome/fontawesome-free/js/all");
require('./helpers');
require('./validation');

$(document).ready(() => {

    // funcion para cerrar sesion desde un data-logout
    $("[data-logout]").click(event => {
        
        event.preventDefault();

        //loaderIn();

        console.log('Cerrrando sesion...')

        axios
            .post("/api/logout")
            .then(() => {
                window.location.reload();
            })
            .catch(({ response }) => {
                console.log(response);
                //responseAxios(response);
                //loaderOut();
            });
        
    });

})