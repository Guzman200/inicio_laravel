import $ from "jquery";
import Swal from "sweetalert2";
//const moment = require("moment");
//moment.locale("es");

// seccion de loader
const loader = $("#loader");

const loaderIn = () => {
  loader.css("display", "flex");
};

const loaderOut = () => {
  loader.fadeOut();
};

// manejo de errores del servidor mediante ajax
/**
 * Maneja los errores generados medante peticiones ajax
 * @param {Response} response
 */
const responseAxios = response => {
  console.log(response);
  let message = "Error interno, intentelo más tarde";
  let typeMessage = "error";
  let title = "";
  let timer = 0;

  if (response != undefined) {
    let { status, data } = response;

    switch (status) {
      case 200:
        {
          title = data.title || "";
          message = data.message || "";
          timer = data.timer || 0;
          typeMessage = "success";
        }
        break;
      case 201:
        {
          title = data.title || "";
          message = data.message || "";
          timer = data.timer || 0;
          typeMessage = "success";
        }
        break;
      case 404:

        {
          let errors = data.errors || {};
          let sizeErrors = Object.keys(errors).length;

          title = data.title || "Verifique su información";
          message = "El recurso no se encontro";
          typeMessage = data.icon || "warning";

          for (var [key, value] of Object.entries(errors)) {
            switch (key) {
              case "title":
                title = value[0];

                break;
              case "icon":
                typeMessage = value[0];
                break;

              default:
                message += sizeErrors > 1 ? `${value[0]}<br />` : value[0];
            }
          }
        }

        break;
      case 422:
        {
          let errors = data.errors || {};
          let sizeErrors = Object.keys(errors).length;

          title = data.title || "Verifique su información";
          message = sizeErrors > 0 ? "" : data.message || "";
          typeMessage = data.icon || "warning";

          for (var [key, value] of Object.entries(errors)) {
            switch (key) {
              case "title":
                title = value[0];

                break;
              case "icon":
                typeMessage = value[0];
                break;

              default:
                message += sizeErrors > 1 ? `${value[0]}<br />` : value[0];
            }
          }
        }
        break;
    }
  }
  sweetInfo(title, message, typeMessage, timer);
};

/**
 * @param {string} title
 * @param {string} text
 * @param {string} icon success default
 * @param {number} timer 0 default
 */
const sweetInfo = (title = "", text = "", icon = "success", timer = 0) => {
  Swal.fire({
    title,
    html: text,
    icon,
    confirmButtonText: "Aceptar",
    focusConfirm: true,
    timer: timer,
    timerProgressBar: timer != 0,
  });
};

/**
 *
 * @param {string} title titulo modal
 * @param {string} text texto del modal
 * @param {callback} callback función callback si se da en eliminar al botón
 */
const sweetDelete = (title, html, callback, icon = "warning", confirmButtonText = "Eliminar") => {
  Swal.fire({
    title,
    html,
    icon,
    showCancelButton: true,
    confirmButtonText,
    customClass: {
      confirmButton: "btn btn-danger",
      cancelButton: "btn btn-default",
    },
  }).then(result => {
    if (result.isConfirmed) {
      callback();
    }
  });
};

/**
 * limpiar validaciones de formulario
 *
 * @param {string|object} form "id" | "#id" | elementJQuery
 */
const resetForm = form => {
  let formReset;

  // se verifica si se recibio un string o un formulario
  if (typeof form == "string") {
    if (form.includes("#")) {
      formReset = $(form);
    } else {
      formReset = $("#" + form);
    }
  } else {
    formReset = form;
  }
  //se reinician los valores del formulario
  formReset[0].reset();
  //se eliminan las clases de las validaciones
  resetOnlyValidation(form);
};

/**
 * se elimina solo las validaciones generadas por el validador
 *
 * @param {formJquery} formJS
 */
const resetOnlyValidation = form => {
  $(".is-invalid, .is-valid", form).removeClass("is-invalid is-valid");
  $(".invalid-feedback", form).remove();
  $('[name="type_identification_id"]:first-child', form).click();
};

/**
 * eliminar validación del un elemento
 * @param {string|ObjectJQuery} "id" || "#id" || jqueryElement
 */
const resetOnlyElement = elmt => {
  let element = elmt;

  if (typeof elmt == "string") {
    if (elmt.includes("#")) {
      element = $(elmt);
    } else {
      element = $("#" + elmt);
    }
  }

  element.removeClass("is-valid is-invalid");
  element
    .parent()
    .siblings(".invalid-feedback")
    .remove();
};


// Traduccion de datatables
const datatablesJSON = {
  "decimal": "",
  "emptyTable": "No hay información",
  "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
  "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
  "infoFiltered": "(Filtrado de _MAX_ total entradas)",
  "infoPostFix": "",
  "thousands": ",",
  //"lengthMenu": "Mostrar _MENU_ Entradas",
  "loadingRecords": "Cargando...",
  "processing": "Procesando...",
  "search": "Buscar:",
  "zeroRecords": "Sin resultados encontrados", 
  "paginate": {
      "first": "«",
      "last": "»",
      "next": "»",
      "previous": "«"
  }
}

// exportacion de funciones
export {
  loaderIn,
  loaderOut,
  responseAxios,
  sweetInfo,
  sweetDelete,
  resetForm,
  resetOnlyValidation,
  resetOnlyElement,
  //moment,
  Swal,
  datatablesJSON
};
