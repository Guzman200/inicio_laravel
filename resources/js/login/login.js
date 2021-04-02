import Swal from "sweetalert2";
import {  loaderIn, loaderOut, responseAxios, sweetDelete, datatablesJSON, sweetInfo } from "./../helpers.js";


$(document).ready(() => {

    /**==================================== LOGIN========================================= */
    let formLogin = $("#form-login");

    // envio de login
    formLogin.on("submit", event => {

        event.preventDefault();

        // validacion de formulario
        if (!formLogin.valid()) {
            return false;
        }

        let form = new FormData(event.target);

        loaderIn();
        // peticion para csrf-cookie - solo al iniciar sesión
        axios
            .get("/sanctum/csrf-cookie")
            .then(() => {
                // inicio de sesion
                axios
                    .post("/api/login", form)
                    .then((res) => {
                        console.log(res)
                        window.location.reload();
                    })
                    .catch(({ response }) => {
                        console.log(response);
                        responseAxios(response);
                        loaderOut();
                    });
            })
            .catch(() => {
                loaderOut();
            });
    });

    // validaciones del formulario login
    formLogin.validate({
        rules: {

            email: {
                required: true,
                minlength: 5,
                maxlength: 255,
            },

            password: {
                required: true,
                minlength: 5
            },

        },

        messages: {
            
        },
    });

});