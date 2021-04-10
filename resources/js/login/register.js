import Swal from "sweetalert2";
import { loaderIn, loaderOut, responseAxios, sweetDelete, datatablesJSON, sweetInfo } from "./../helpers.js";

$(document).ready(() => {

    let formRegistro = $("#form-registro");


    // abre el modal de registro y reinicia todos los valores y validaciones
    $("[data-openRegister]").click(event => {

    });

    // envio de registro
    formRegistro.on("submit", event => {

        event.preventDefault();

        // validacion de formulario
        if (!formRegistro.valid()) {
            return false;
        }
        //var recaptcha = grecaptcha.getResponse();
        //if (recaptcha.length == 0) {
           // sweetInfo("Recaptacha obligatorio", "", "warning", 3000);
            //return false;
        //}
        

        let form = new FormData(event.target);

        loaderIn();
        axios
            .post("/api/register", form)
            .then(response => {
                console.log(response)
                window.location.reload();
                //modalRegistro.modal("hide");
                //responseAxios(response);
            })
            .catch(({ response }) => {
                console.log(response)
                //grecaptcha.reset();
                responseAxios(response);
            })
            .then(() => {
                loaderOut();
            });
    });

    // validaciones modal registro
    formRegistro.validate({
        rules: {
            name: {
                required: true,
                //alphabet: true,
                minlength: 5,
                maxlength: 255,
            },
            nombre_usuario : {
                required: true,
                minlength: 5,
                maxlength: 255,
            },

            email: {
                required: true,
                minlength: 2,
                maxlength: 255,
            },

            password: {
                required: true,
                minlength: 5
            },

            password_confirmation : {
                equalTo : password
            }
        },

        messages: {
            password_confirmation : {
                equalTo : 'Las contraseñas no coinciden'
            }
        },
    });


});