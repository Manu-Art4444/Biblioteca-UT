function lista() {
    $.ajax({
        url: "lista_no_prestados.php",
        type: "POST",
        dataType: 'html',
        data: {},
        success: function(data) {
            $("#list").html(data);
        },
        error: function(xhr, status) {
            swal("Error de llamada AJAX", xhr.responseText, "error");
        }
    });
}
lista();
function listPrestamo() {
    $.ajax({
        url: "lista_prestados.php",
        type: "POST",
        dataType: 'html',
        data: {},
        success: function(data) {
            $("#listPrestamo").hide();
            $("#listPrestamo").html(data);
            $("#listPrestamo").fadeIn("slow");
        },
        error: function(xhr, status) {
            swal("Error de llamada AJAX", xhr.responseText, "error");
        }
    });
}
listPrestamo();
function listHistorial() {
    $.ajax({
        url: "lista_historial.php",
        type: "POST",
        dataType: 'html',
        data: {},
        success: function(data) {
            $("#listHistorial").html(data);
        },
        error: function(xhr, status) {
            swal("Error de llamada AJAX", xhr.responseText, "error");
        }
    });
}
listHistorial();


function terminarPrestamo(id){
    $.ajax({
        url: "datosPrestamo.php",
        type: "POST",
        dataType: 'json',
        encode: true,
        data: {
            id: id
        },
        success: function(data) {
            $("#t_id_prestamo").val(data[0].id_prestamo);
            $("#t_id_alumno").val(data[0].id_alumno);
            $("#t_alumno").val(data[0].matricula+" - "+data[0].alumno);
            $("#t_fecha_prestamo").val(data[0].fecha_prestamo);
            $("#t_fecha_compromiso").val(data[0].fecha_compromiso);
            $("#t_observaciones_prestamo").val(data[0].observaciones_prestamo);
            $("#t_id_libro").val(data[0].id_libro);
            $("#t_modulo").val(data[0].id_modulo).trigger("change");
            $("#t_clasificacion").val(data[0].id_clasificacion).trigger("change");
            $("#t_titulo").val(data[0].titulo);
            $("#t_autores").val(data[0].autores);
            $("#t_editorial_libro").val(data[0].editorial_libro);
            $("#t_anio_publicacion").val(data[0].anio_publicacion);
            $("#t_lugar_publicacion").val(data[0].lugar_publicacion);
            $("#t_isbn").val(data[0].isbn);
            $("#t_edicion").val(data[0].edicion);
            $("#t_condicion_libro").val(data[0].condicion_libro);
            $("#t_numero_identificacion").val(data[0].numero_identificacion);
            $("#t_observaciones").val(data[0].observaciones);
            document.getElementById("t_fecha_devolucion").value = new Date().toISOString().split('T')[0];
            
            $("#mTerminar").modal("show");
            if ($('select').data('select2')) {
               $('select').select2('destroy');
            }
            setTimeout(function(){
                $("#id_alumno").select2({
                    placeholder: "Seleccionar...",
                    language: {
                        inputTooShort: function (args) {
                            return "Escribe 2 o mas letras...";
                        },
                        noResults: function () {
                            return "Sin resultados...";
                        },
                        searching: function () {
                            return "Buscando...";
                        }
                    },
                    minimumInputLength: 2,
                    ajax: {
                        url: 'loadAlumnos.php',
                        dataType: 'json',
                        type: "GET",
                        quietMillis: 50,
                        data: function(term) {
                            return{term:term.term};
                        },
                        processResults: function (response) {
                            return{results:response};
                        }
                    },
                    dropdownParent: $('#mVer')
                });
            },100);
        },
        error: function(xhr, status) {
            swal("Error de llamada AJAX", xhr.responseText, "error");
        }
    });
}

function seleccionarLibro(id){
    $.ajax({
        url: "datosLibro.php",
        type: "POST",
        dataType: 'json',
        encode: true,
        data: {
            id: id
        },
        success: function(data) {
            $("#v_id_libro").val(data[0].id_libro);
            $("#v_modulo").val(data[0].id_modulo).trigger("change");
            $("#v_clasificacion").val(data[0].id_clasificacion).trigger("change");
            $("#v_titulo").val(data[0].titulo);
            $("#v_autores").val(data[0].autores);
            $("#v_editorial_libro").val(data[0].editorial_libro);
            $("#v_anio_publicacion").val(data[0].anio_publicacion);
            $("#v_lugar_publicacion").val(data[0].lugar_publicacion);
            $("#v_isbn").val(data[0].isbn);
            $("#v_edicion").val(data[0].edicion);
            $("#v_condicion_libro").val(data[0].condicion_libro);
            $("#v_numero_identificacion").val(data[0].numero_identificacion);
            $("#v_observaciones").val(data[0].observaciones);
            $("#mVer").modal("show");
            if ($('select').data('select2')) {
               $('select').select2('destroy');
             }
            setTimeout(function(){
                $("#id_alumno").select2({
                    placeholder: "Seleccionar...",
                    language: {
                        inputTooShort: function (args) {
                            return "Escribe 2 o mas letras...";
                        },
                        noResults: function () {
                            return "Sin resultados...";
                        },
                        searching: function () {
                            return "Buscando...";
                        }
                    },
                    minimumInputLength: 2,
                    ajax: {
                        url: 'loadAlumnos.php',
                        dataType: 'json',
                        type: "GET",
                        quietMillis: 50,
                        data: function(term) {
                            return{term:term.term};
                        },
                        processResults: function (response) {
                            return{results:response};
                        }
                    },
                    dropdownParent: $('#mVer')
                });
            },100);
        },
        error: function(xhr, status) {
            swal("Error de llamada AJAX", xhr.responseText, "error");
        }
    });
}

function regPrestamo(){
    var id_libro = $("#v_id_libro").val();
    var id_alumno = $("#id_alumno").val();
    var fecha_prestamo = $("#fecha_prestamo").val();
    var fecha_compromiso = $("#fecha_compromiso").val();
    var observaciones_prestamo = $("#v_observaciones_prestamo").val();

    $.ajax({
        url: "guardarPrestamo.php",
        type: "POST",
        dataType: 'html',
        data: {
            id_libro: id_libro,
            id_alumno: id_alumno,
            fecha_prestamo: fecha_prestamo,
            fecha_compromiso: fecha_compromiso,
            observaciones: observaciones_prestamo
        },
        success: function(data) {
            if (data.trim() == "exito") {
                lista();
                alertify.success("Prestamo registrado");
                $("#mVer").modal("hide");
                $("#id_libro").val("");
                $("#id_alumno").val("");
                $("#fecha_prestamo").val("");
                $("#fecha_compromiso").val("");
                $("#v_observaciones_prestamo").val("");
            } else {
                alertify.error("Error al guardar");
            }
        },
        error: function(xhr, status) {
            swal("Error de llamada AJAX", xhr.responseText, "error");
        }
    });
}

$("#frmAlta").submit(function(e) {
    e.preventDefault();
        var id_modulo = $("#id_modulo").val();
        var id_clasificacion = $("#id_clasificacion").val();
        var titulo = $("#titulo").val();
        var autores = $("#autores").val();
        var editorial_libro = $("#editorial_libro").val();
        var anio_publicacion = $("#anio_publicacion").val();
        var lugar_publicacion = $("#lugar_publicacion").val();
        var isbn = $("#isbn").val();
        var edicion = $("#edicion").val();
        var condicion_libro = $("#condicion_libro").val();
        var numero_identificacion = $("#numero_identificacion").val();
        var observaciones = $("#observaciones").val();
        
        $.ajax({
            url: "guardar.php",
            type: "POST",
            dataType: 'html',
            data: {
                id_modulo: id_modulo,
                id_clasificacion: id_clasificacion,
                titulo: titulo,
                autores: autores,
                editorial_libro: editorial_libro,
                anio_publicacion: anio_publicacion,
                lugar_publicacion: lugar_publicacion,
                isbn: isbn,
                edicion: edicion,
                condicion_libro: condicion_libro,
                numero_identificacion: numero_identificacion,
                observaciones: observaciones,
            },
            success: function(data) {
                if (data.trim() == "exito") {
                    $("#modulo").val("");
                    $("#clasificacion").val("");
                    alertify.success("Libro guardado");
                    $("#perfil").focus();
                    lista();
                } else {
                    alertify.error("Error al guardar");
                }
            },
            error: function(xhr, status) {
                swal("Error de llamada AJAX", xhr.responseText, "error");
            }
        });
    
});

function abrirMEditar(id) {
    $.ajax({
        url: "datosLibro.php",
        type: "POST",
        dataType: 'json',
        encode: true,
        data: {
            id: id
        },
        success: function(data) {
            $("#txtId").val(id);

            $("#e_modulo").val(data[0].id_modulo).trigger("change");
            $("#e_clasificacion").val(data[0].id_clasificacion).trigger("change");
            $("#e_titulo").val(data[0].titulo);
            $("#e_autores").val(data[0].autores);
            $("#e_editorial_libro").val(data[0].editorial_libro);
            $("#e_anio_publicacion").val(data[0].anio_publicacion);
            $("#e_lugar_publicacion").val(data[0].lugar_publicacion);
            $("#e_isbn").val(data[0].isbn);
            $("#e_edicion").val(data[0].edicion);
            $("#e_condicion_libro").val(data[0].condicion_libro);
            $("#e_numero_identificacion").val(data[0].numero_identificacion);
            $("#e_observaciones").val(data[0].observaciones);

            hvFInpS('#frmEditar', '#btnSubEdit');
            $("#mEditar").modal("show");
        },
        error: function(xhr, status) {
            swal("Error de llamada AJAX", xhr.responseText, "error");
        }
    });
}
function abrirMVer(id) {
    $.ajax({
        url: "datosLibro.php",
        type: "POST",
        dataType: 'json',
        encode: true,
        data: {
            id: id
        },
        success: function(data) {
            $("#v_modulo").val(data[0].id_modulo).trigger("change");
            $("#v_clasificacion").val(data[0].id_clasificacion).trigger("change");
            $("#v_titulo").val(data[0].titulo);
            $("#v_autores").val(data[0].autores);
            $("#v_editorial_libro").val(data[0].editorial_libro);
            $("#v_anio_publicacion").val(data[0].anio_publicacion);
            $("#v_lugar_publicacion").val(data[0].lugar_publicacion);
            $("#v_isbn").val(data[0].isbn);
            $("#v_edicion").val(data[0].edicion);
            $("#v_condicion_libro").val(data[0].condicion_libro);
            $("#v_numero_identificacion").val(data[0].numero_identificacion);
            $("#v_observaciones").val(data[0].observaciones);
            $("#mVer").modal("show");
        },
        error: function(xhr, status) {
            swal("Error de llamada AJAX", xhr.responseText, "error");
        }
    });
}
$(".modal").on("shown.bs.modal", function(e) {
    $(this).find('input, textarea, select').filter(":visible:first").focus();
});
$("#frmEditar").submit(function(e) {
    e.preventDefault();
        var e_id = $("#txtId").val();
        var e_modulo = $("#e_modulo").val();
        var e_clasificacion = $("#e_clasificacion").val();
        var e_titulo = $("#e_titulo").val();
        var e_autores = $("#e_autores").val();
        var e_editorial_libro = $("#e_editorial_libro").val();
        var e_anio_publicacion = $("#e_anio_publicacion").val();
        var e_lugar_publicacion = $("#e_lugar_publicacion").val();
        var e_isbn = $("#e_isbn").val();
        var e_edicion = $("#e_edicion").val();
        var e_condicion_libro = $("#e_condicion_libro").val();
        var e_numero_identificacion = $("#e_numero_identificacion").val();
        var e_observaciones = $("#e_observaciones").val();
        $.ajax({
            url: "actualizar.php",
            type: "POST",
            dataType: 'html',
            data: {
                e_id: e_id,
                e_modulo: e_modulo,
                e_clasificacion: e_clasificacion,
                e_titulo: e_titulo,
                e_autores: e_autores,
                e_editorial_libro: e_editorial_libro,
                e_anio_publicacion: e_anio_publicacion,
                e_lugar_publicacion: e_lugar_publicacion,
                e_isbn: e_isbn,
                e_edicion: e_edicion,
                e_condicion_libro: e_condicion_libro,
                e_numero_identificacion: e_numero_identificacion,
                e_observaciones: e_observaciones,
            },
            success: function(data) {
                if (data.trim() == "exito") {
                    lista();
                    $("#mEditar").modal("hide");
                    alertify.success("Libro actualizado");
                } else {
                    alertify.error("Error al actualizar");
                }
            },
            error: function(xhr, status) {
                swal("Error de llamada AJAX", xhr.responseText, "error");
            }
        });
    
});

function devPrestamo(){
    var id_prestamo = $("#t_id_prestamo").val();
    var fecha_devolucion = $("#t_fecha_devolucion").val();
    var observaciones_prestamo = $("#t_observaciones_prestamo").val();
    $.ajax({
        url: "devPrestamo.php",
        type: "POST",
        dataType: 'html',
        data: {
            id_prestamo: id_prestamo,
            fecha_devolucion: fecha_devolucion,
            observaciones_prestamo: observaciones_prestamo
        },
        success: function(data) {
            if (data.trim() == "exito") {
                lista();
                listPrestamo();
                listHistorial();
                alertify.success("Libro devuelto");
                $("#mTerminar").modal("hide");
            } else {
                alertify.error("Error al actualizar");
            }
        },
        error: function(xhr, status) {
            swal("Error de llamada AJAX", xhr.responseText, "error");
        }
    });
}