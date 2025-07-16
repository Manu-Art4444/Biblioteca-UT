// function lista() {
//     $.ajax({
//         url: "lista.php",
//         type: "POST",
//         dataType: 'html',
//         data: {},
//         success: function(data) {
//             $("#list").hide();
//             $("#list").html(data);
//             $("#list").fadeIn("slow");
//         },
//         error: function(xhr, status) {
//             swal("Error de llamada AJAX", xhr.responseText, "error");
//         }
//     });
// }
// lista();
// $("#frmAlta").submit(function(e) {
//     e.preventDefault();
//         var id_modulo = $("#id_modulo").val();
//         var id_clasificacion = $("#id_clasificacion").val();
//         var titulo = $("#titulo").val();
//         var autores = $("#autores").val();
//         var editorial_libro = $("#editorial_libro").val();
//         var anio_publicacion = $("#anio_publicacion").val();
//         var lugar_publicacion = $("#lugar_publicacion").val();
//         var isbn = $("#isbn").val();
//         var edicion = $("#edicion").val();
//         var condicion_libro = $("#condicion_libro").val();
//         var numero_identificacion = $("#numero_identificacion").val();
//         var observaciones = $("#observaciones").val();
        
//         $.ajax({
//             url: "guardar.php",
//             type: "POST",
//             dataType: 'html',
//             data: {
//                 id_modulo: id_modulo,
//                 id_clasificacion: id_clasificacion,
//                 titulo: titulo,
//                 autores: autores,
//                 editorial_libro: editorial_libro,
//                 anio_publicacion: anio_publicacion,
//                 lugar_publicacion: lugar_publicacion,
//                 isbn: isbn,
//                 edicion: edicion,
//                 condicion_libro: condicion_libro,
//                 numero_identificacion: numero_identificacion,
//                 observaciones: observaciones,
//             },
//             success: function(data) {
//                 if (data.trim() == "exito") {
//                     $("#modulo").val("");
//                     $("#clasificacion").val("");
//                     alertify.success("Libro guardado");
//                     $("#perfil").focus();
//                     lista();
//                 } else {
//                     alertify.error("Error al guardar");
//                 }
//             },
//             error: function(xhr, status) {
//                 swal("Error de llamada AJAX", xhr.responseText, "error");
//             }
//         });
    
// });

// function abrirMEditar(id) {
//     $.ajax({
//         url: "datosLibro.php",
//         type: "POST",
//         dataType: 'json',
//         encode: true,
//         data: {
//             id: id
//         },
//         success: function(data) {
//             $("#txtId").val(id);

//             $("#e_modulo").val(data[0].id_modulo).trigger("change");
//             $("#e_clasificacion").val(data[0].id_clasificacion).trigger("change");
//             $("#e_titulo").val(data[0].titulo);
//             $("#e_autores").val(data[0].autores);
//             $("#e_editorial_libro").val(data[0].editorial_libro);
//             $("#e_anio_publicacion").val(data[0].anio_publicacion);
//             $("#e_lugar_publicacion").val(data[0].lugar_publicacion);
//             $("#e_isbn").val(data[0].isbn);
//             $("#e_edicion").val(data[0].edicion);
//             $("#e_condicion_libro").val(data[0].condicion_libro);
//             $("#e_numero_identificacion").val(data[0].numero_identificacion);
//             $("#e_observaciones").val(data[0].observaciones);

//             hvFInpS('#frmEditar', '#btnSubEdit');
//             $("#mEditar").modal("show");
//         },
//         error: function(xhr, status) {
//             swal("Error de llamada AJAX", xhr.responseText, "error");
//         }
//     });
// }
// function abrirMVer(id) {
//     $.ajax({
//         url: "datosLibro.php",
//         type: "POST",
//         dataType: 'json',
//         encode: true,
//         data: {
//             id: id
//         },
//         success: function(data) {
//             $("#v_modulo").val(data[0].id_modulo).trigger("change");
//             $("#v_clasificacion").val(data[0].id_clasificacion).trigger("change");
//             $("#v_titulo").val(data[0].titulo);
//             $("#v_autores").val(data[0].autores);
//             $("#v_editorial_libro").val(data[0].editorial_libro);
//             $("#v_anio_publicacion").val(data[0].anio_publicacion);
//             $("#v_lugar_publicacion").val(data[0].lugar_publicacion);
//             $("#v_isbn").val(data[0].isbn);
//             $("#v_edicion").val(data[0].edicion);
//             $("#v_condicion_libro").val(data[0].condicion_libro);
//             $("#v_numero_identificacion").val(data[0].numero_identificacion);
//             $("#v_observaciones").val(data[0].observaciones);
//             $("#mVer").modal("show");
//         },
//         error: function(xhr, status) {
//             swal("Error de llamada AJAX", xhr.responseText, "error");
//         }
//     });
// }
// $(".modal").on("shown.bs.modal", function(e) {
//     $(this).find('input, textarea, select').filter(":visible:first").focus();
// });
// $("#frmEditar").submit(function(e) {
//     e.preventDefault();
//         var e_id = $("#txtId").val();
//         var e_modulo = $("#e_modulo").val();
//         var e_clasificacion = $("#e_clasificacion").val();
//         var e_titulo = $("#e_titulo").val();
//         var e_autores = $("#e_autores").val();
//         var e_editorial_libro = $("#e_editorial_libro").val();
//         var e_anio_publicacion = $("#e_anio_publicacion").val();
//         var e_lugar_publicacion = $("#e_lugar_publicacion").val();
//         var e_isbn = $("#e_isbn").val();
//         var e_edicion = $("#e_edicion").val();
//         var e_condicion_libro = $("#e_condicion_libro").val();
//         var e_numero_identificacion = $("#e_numero_identificacion").val();
//         var e_observaciones = $("#e_observaciones").val();
//         $.ajax({
//             url: "actualizar.php",
//             type: "POST",
//             dataType: 'html',
//             data: {
//                 e_id: e_id,
//                 e_modulo: e_modulo,
//                 e_clasificacion: e_clasificacion,
//                 e_titulo: e_titulo,
//                 e_autores: e_autores,
//                 e_editorial_libro: e_editorial_libro,
//                 e_anio_publicacion: e_anio_publicacion,
//                 e_lugar_publicacion: e_lugar_publicacion,
//                 e_isbn: e_isbn,
//                 e_edicion: e_edicion,
//                 e_condicion_libro: e_condicion_libro,
//                 e_numero_identificacion: e_numero_identificacion,
//                 e_observaciones: e_observaciones,
//             },
//             success: function(data) {
//                 if (data.trim() == "exito") {
//                     lista();
//                     $("#mEditar").modal("hide");
//                     alertify.success("Libro actualizado");
//                 } else {
//                     alertify.error("Error al actualizar");
//                 }
//             },
//             error: function(xhr, status) {
//                 swal("Error de llamada AJAX", xhr.responseText, "error");
//             }
//         });
    
// });


// Función AJAX genérica con respuesta esperada en JSON
function postAjax(url, data) {
    return $.ajax({
        url: url,
        type: "POST",
        dataType: "json",
        data: data
    });
}

// Cargar lista de libros
function lista() {
    $.ajax({
        url: "lista.php",
        type: "POST",
        dataType: "html",
        success: function(data) {
            $("#list").hide().html(data).fadeIn("slow");
        },
        error: function(xhr) {
            swal("Error de llamada AJAX", xhr.responseText, "error");
        }
    });
}
lista();

// Alta de nuevo libro
$("#frmAlta").submit(async function (e) {
    e.preventDefault();
    try {
        const response = await postAjax("guardar.php", $(this).serialize());
        if (response.status === "ok") {
            $(this)[0].reset(); // limpia formulario
            alertify.success(response.msg || "Libro guardado");
            lista();
        } else {
            alertify.error(response.msg || "Error al guardar");
        }
    } catch (xhr) {
        swal("Error de llamada AJAX", xhr.responseText, "error");
    }
});

// Abrir modal para editar
function abrirMEditar(id) {
    postAjax("datosLibro.php", { id }).then(data => {
        const libro = data[0];
        $("#txtId").val(id);
        $("#e_modulo").val(libro.id_modulo).trigger("change");
        $("#e_clasificacion").val(libro.id_clasificacion).trigger("change");
        $("#e_titulo").val(libro.titulo);
        $("#e_autores").val(libro.autores);
        $("#e_editorial_libro").val(libro.editorial_libro);
        $("#e_anio_publicacion").val(libro.anio_publicacion);
        $("#e_lugar_publicacion").val(libro.lugar_publicacion);
        $("#e_isbn").val(libro.isbn);
        $("#e_edicion").val(libro.edicion);
        $("#e_condicion_libro").val(libro.condicion_libro);
        $("#e_numero_identificacion").val(libro.numero_identificacion);
        $("#e_observaciones").val(libro.observaciones);

        hvFInpS('#frmEditar', '#btnSubEdit');
        $("#mEditar").modal("show");
    }).catch(xhr => {
        swal("Error de llamada AJAX", xhr.responseText, "error");
    });
}

// Ver libro sin editar
function abrirMVer(id) {
    postAjax("datosLibro.php", { id }).then(data => {
        const libro = data[0];
        $("#v_modulo").val(libro.id_modulo).trigger("change");
        $("#v_clasificacion").val(libro.id_clasificacion).trigger("change");
        $("#v_titulo").val(libro.titulo);
        $("#v_autores").val(libro.autores);
        $("#v_editorial_libro").val(libro.editorial_libro);
        $("#v_anio_publicacion").val(libro.anio_publicacion);
        $("#v_lugar_publicacion").val(libro.lugar_publicacion);
        $("#v_isbn").val(libro.isbn);
        $("#v_edicion").val(libro.edicion);
        $("#v_condicion_libro").val(libro.condicion_libro);
        $("#v_numero_identificacion").val(libro.numero_identificacion);
        $("#v_observaciones").val(libro.observaciones);
        $("#mVer").modal("show");
    }).catch(xhr => {
        swal("Error de llamada AJAX", xhr.responseText, "error");
    });
}

// Enfocar primer campo al abrir modal
$(".modal").on("shown.bs.modal", function (e) {
    $(this).find('input, textarea, select').filter(":visible:first").focus();
});

// Editar libro
$("#frmEditar").submit(async function (e) {
    e.preventDefault();
    try {
        const response = await postAjax("actualizar.php", $(this).serialize());
        if (response.status === "ok") {
            $("#mEditar").modal("hide");
            lista();
            alertify.success(response.msg || "Libro actualizado");
        } else {
            alertify.error(response.msg || "Error al actualizar");
        }
    } catch (xhr) {
        swal("Error de llamada AJAX", xhr.responseText, "error");
    }
});
