
//Funcion para canbiar los mensajes por defecto del validation() de jquery.
$(document).ready(function () {
   $.extend(jQuery.validator.messages, {
       number: "Por favor, escribe sólo dígitos enteros.",
       digits: "Por favor, escribe sólo dígitos enteros y positivos.",
       range: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1}."),
       required: "Este campo es obligatorio.",
       remote: "Por favor, rellena este campo.",
       email: "Por favor, escribe una dirección de correo válida",
       url: "Por favor, escribe una URL válida.",
       date: "Por favor, escribe una fecha válida.",
       dateISO: "Por favor, escribe una fecha (ISO) válida.",
       creditcard: "Por favor, escribe un número de tarjeta válido.",
       equalTo: "Por favor, escribe el mismo valor de nuevo.",
       accept: "Por favor, escribe un valor con una extensión aceptada.",
       time: "Debe ingresar la hora en formato 00:00 a 23:59",
       maxlength: jQuery.validator.format("Por favor, no escribas más de {0} caracteres."),
       minlength: jQuery.validator.format("Por favor, no escribas menos de {0} caracteres."),
       rangelength: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1} caracteres."),
       range: jQuery.validator.format("Por favor, escribe un valor entre {0} y {1}."),
       max: jQuery.validator.format("Por favor, escribe un valor menor o igual a {0}."),
       min: jQuery.validator.format("Por favor, escribe un valor mayor o igual a {0}.")
   });
})