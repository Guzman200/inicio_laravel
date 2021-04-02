require("jquery-validation");
// configuracion de validaciones para bootstrap 4.5
$.validator.setDefaults({
  debug: true,
  success: "is-valid",
  errorClass: "is-invalid",
  validClass: "is-valid",
  errorPlacement: function(error, element) {
    if (element.parent().hasClass("has-float-label")) {
      $("div.invalid-feedback", element.parent().parent()).remove();
      element.parent().after($("<div />", { class: "invalid-feedback text-right d-block", text: error.text() }));
    } else {
      $("div.invalid-feedback", element.parent()).remove();
      element.after($("<div />", { class: "invalid-feedback text-right", text: error.text() }));
    }
  },
  onkeyup: function(element) {
    $(element).valid();
  },
  onfocusout: function(element) {
    $(element).valid();
  },
});

$.extend(jQuery.validator.messages, {
  required: "Requerido.",
  remote: "Ingresa este campo.",
  email: "Verifica el formato de email. ej. example@mail.com",
  url: "Ingresa una URL válida.",
  date: "Ingresa una fecha válida.",
  dateISO: "Ingresa una fecha (ISO) válida.",
  number: "Ingrese solo números.",
  digits: "Ingrese solo dígitos.",
  creditcard: "Ingresa un número de tarjeta válido.",
  equalTo: "Ingresa el mismo valor de nuevo.",
  accept: "Ingresa un valor con una extensión aceptada.",
  minlength: $.validator.format("Ingresa minimo {0} caracteres"),
  maxlength: $.validator.format("Ingresa máximo {0} caracteres"),
  rangelength: $.validator.format("Ingresa un valor entre {0} y {1} caracteres."),
  range: $.validator.format("Ingresa un valor entre {0} y {1}."),
  max: $.validator.format("Ingresa un valor menor o igual a {0}."),
  min: $.validator.format("Ingresa un valor mayor o igual a {0}."),
});

/**  VALIDACIONES PERSONALIZADAS */

// $.validator.addMethod(
//   "required",
//   function(value, element) {
//     return String(value).trim().length > 0;
//   },
//   "Campo requerido",
// );


// validacion de letras con espacios
$.validator.addMethod(
  "letras",
  function(value, element) {
    return this.optional(element) || /^[a-zA-Z ]+$/.test(value);
  },
  "Solo se aceptan letras y espacios",
);

// validacion de letras y numeros sin espacios
$.validator.addMethod(
  "word",
  function(value, element) {
    return this.optional(element) || /^[a-zA-Z0-9]+$/.test(value);
  },
  "Solo se aceptan números y/o letras",
);

// validacion de letras y numeros con espacios
$.validator.addMethod(
  "words",
  function(value, element) {
    return this.optional(element) || /^[a-zA-Z0-9 ]+$/.test(value);
  },
  "Solo se aceptan espacios, números y/o letras",
);

// validacion de letras y numeros con espacios
$.validator.addMethod(
  "alphabet",
  function(value, element) {
    return this.optional(element) || /^[a-zA-ZñáéíóúÑÁÉÍÓÚ ]+$/.test(value);
  },
  "Solo se aceptan espacios y letras",
);

// valida correo
$.validator.addMethod(
  "correo",
  function(value, element) {
    return this.optional(element) || /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value);
  },
  "Verifica el formato de email. ej. example@mail.com",
);

$.validator.addMethod(
  "email",
  function(value, element) {
    return this.optional(element) || /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(value);
  },
  "Verifica el formato de email. ej. example@mail.com",
);

// valida numero de caracteres
$.validator.addMethod(
  "size",
  function(value, element, params) {
    return this.optional(element) || value.length == params;
  },
  $.validator.format("Se necesitan {0} caracteres"),
);

// validacion de regex o expresión regular
$.validator.addMethod(
  "regex",
  function(value, element, params) {
    let regex = new RegExp(params.replace(/\//g, ""));
    return this.optional(element) || regex.test(value);
  },
  "Formato incorrecto",
);

$("#loader").click();
