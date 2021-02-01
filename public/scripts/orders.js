$(document).ready(function() {
    $("#container-cliente").hide();
    $("#container-producto").hide();
    $("#container-bono").hide();
    $(".validacion").hide();

    indexClientes();
    indexProductos();
    indexBonos();

});

var URLdomain = window.location.origin;


$("#btn_clienteContainer").click(function() {
    $("#container-pedido").hide();
    $("#container-cliente").show();
});

$("#btn_bonoContainer").click(function() {
    selectBono();
    $("#container-pedido").hide();
    $("#container-bono").show();
});

$("#btn_productoContainer").click(function() {
    selectProducto();
    $("#container-pedido").hide();
    $("#container-producto").show();
});

$("#btn_backProductoContainer").click(function() {
    //Borrando filas sin SER SELECCIONADAS
    $("#tableProducts")
        .find(".filaProducto")
        .each(function() {
            var fila = $(this);
            var cantidad_paquete_producto = fila
                .find(".cantidad_paquete_producto")
                .val();

            if (cantidad_paquete_producto == "") {
                fila.remove();
            }
        });

    //Funcion para mostrar LOS PRODUCTOS COMO VISTA PREVIA
    tableProductsPedido();
    $("#container-producto").hide();
    $("#container-pedido").show();
});

$("#btn_backClienteContainer").click(function() {
    $("#container-cliente").hide();
    $("#container-pedido").show();
});

$("#btn_backBonoContainer").click(function() {
    //Borrando filas sin SER SELECCIONADAS
    $("#tableBonuses")
        .find(".filaBono")
        .each(function() {
            var fila = $(this);
            var producto_bono = fila.find(".producto_bono").text();
            if (producto_bono == "") {
                fila.remove();
            }
        });

    $("#container-bono").hide();
    $("#container-pedido").show();
});

$(document).on("click", ".btn_seleccionarCliente", function() {
    var obj = $(this)
        .parent()
        .parent();

    var idCliente = obj.find(".td_id_cliente").text();
    var nombresCliente = obj.find(".td_nombres_cliente").text();
    var apellidosCliente = obj.find(".td_apellidos_cliente").text();
    var direccionPedidoCliente = obj.find(".td_direccion_pedido_cliente").val();

    $("#nombres_pedido").val(nombresCliente);
    $("#apellidos_pedido").val(apellidosCliente);
    $("#idCliente_pedido").val(idCliente);
    $("#direccion_pedido").val(direccionPedidoCliente);

    $("#container-cliente").hide();
    $("#container-pedido").show();
});

$(document).on("click", ".btn_removeProduct", function() {
    let tr = $(this)
        .parent()
        .parent();

    tr.remove();
    total_subtotal_impuesto();

    // Obtenidendo el NOMBRE DEL PRODUCTO
    let id_fila = tr.attr("id");

    // Buscando en en la TABLA DE VISTA PREVIA PARA ELIMINAR SU FILA
    $("#tableProductsPedido")
        .find("#" + id_fila)
        .remove();
});

$(document).on("click", ".btn_removeBono", function() {
    $(this)
        .parent()
        .parent()
        .remove();
});

$("#btn_buscar_dni").click(function() {
    var dni = $("#dni_cliente").val();
    if (dni.length == 8) {
        var URL =
            "https://dniruc.apisperu.com/api/v1/dni/" +
            dni +
            "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InJlbmUubG96YW5vQHRlY3N1cC5lZHUucGUifQ.zaHm2Ff1axozxsNA1LT1H4ZSrR-FSxnmCmWcFBk-a3E";

        $("#nombres_cliente").val("Buscando ..");
        $("#apellidos_cliente").val("Buscando ..");

        $.ajax({
            type: "GET",
            url: URL,
            success: function(data) {
                $("#nombres_cliente").val(data.nombres);
                $("#apellidos_cliente").val(
                    data.apellidoPaterno + " " + data.apellidoMaterno
                );
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("Error Ajax");
            }
        });
    }
});

$("#btn_buscar_ruc").click(function() {
    console.log("RUC BUSCANDO");
    var ruc = $("#ruc_cliente").val();
    if (ruc.length == 11) {
        var URL =
            "https://dniruc.apisperu.com/api/v1/ruc/" +
            ruc +
            "?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6InJlbmUubG96YW5vQHRlY3N1cC5lZHUucGUifQ.zaHm2Ff1axozxsNA1LT1H4ZSrR-FSxnmCmWcFBk-a3E";

        $("#empresa_cliente").val("Buscando ..");
        $("#direccion_empresa_cliente").val("Buscando ..");

        $.ajax({
            type: "GET",
            url: URL,
            success: function(data) {
                if (data) {
                    $("#empresa_cliente").val(data.razonSocial);
                    $("#direccion_empresa_cliente").val(data.direccion);
                } else {
                    $("#empresa_cliente").val("Intenta de nuevo ..");
                    $("#direccion_empresa_cliente").val("Intenta de nuevo ..");
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log("Error Ajax");
            }
        });
    }
});

var cont = 0;
$("#btn_addProducto").click(function() {
    cont = cont + 1;
    $("#tableProducts").append(
        "<tr class='filaProducto' id='" +
            cont +
            "'>" +
            "<input type='hidden' name='id_producto_pedido[]' class='id_producto'>" +
            "<input type='hidden' step='any' 'value='0' class='subtotalIGV_producto' name='subtotal_producto_pedido[]' readonly>" +
            "<input type='hidden' class='nombre_producto'>" +
            "<td>" +
            strSelectProducto +
            "</td>" +
            "<td>" +
            "<input type='number' step='any' style='width:100px; text-align:center;' value='0' class='precio_producto' readonly>" +
            "</td>" +
            "<td>" +
            "<input type='number' style='width:100px; text-align:center;' class='cantidad_paquete_producto' readonly>" +
            "</td>" +
            "<td>" +
            "<input type='number' style='width:100px; text-align:center;' class='precio_paquete_producto' readonly>" +
            "</td>" +
            "<td>" +
            "<input type='number' style='width:100px; text-align:center;' class='cantidad_producto' name='cantidad_producto_pedido[]'>" +
            "</td>" +
            "<td align='center'>" +
            "<button type='button' class='btn btn-danger btn-sm btn_removeProduct'><i class='fas fa-times'></i>" +
            "</button>" +
            "</td>" +
            "</tr>"
    );
});

$("#btn_addBono").click(function() {
    $("#tableBonuses").append(
        "<tr class='filaBono'>" +
            "<td>" +
            strSelectBono +
            "</td>" +
            "<td>" +
            "<span class='producto_bono'></span>" +
            "<input type='hidden' style='width:100px; text-align:center;' class='id_producto_bono' name='id_producto_bono_pedido[]'>" +
            "<input type='hidden' style='width:100px; text-align:center;' class='id_bono' name='id_bono_pedido[]'" +
            "</td>" +
            "<td>" +
            "<input type='number' style='width:80px; text-align:center;' name='cantidad_bono_pedido[]' class='cantidad_bono'>" +
            "</td>" +
            "<td align='center'>" +
            "<button type='button' class='btn btn-danger btn-sm btn_removeBono'><i class='fas fa-times'></i>" +
            "</button>" +
            "</td>" +
            "</tr>"
    );
});

$("#btn_guardarCliente").click(function() {
    var cont = 1;

    var dni = $("#dni_cliente").val();
    var nombres = $("#nombres_cliente").val();
    var apellidos = $("#apellidos_cliente").val();
    var ruc = $("#ruc_cliente").val();
    var empresa = $("#empresa_cliente").val();
    var direccion_empresa = $("#direccion_empresa_cliente").val();
    var direccion_pedido = $("#direccion_pedido_cliente").val();
    var telefono = $("#telefono_cliente").val();

    $(".validacion").hide();

    var token = $("#token").val();
    var ruta = "http://preventabiox.com/pedidos/createCustomer";

    if (cont == 1) {
        $.ajax({
            url: ruta,
            headers: {
                "X-CSRF-TOKEN": token
            },
            type: "POST",
            dataType: "json",
            data: {
                nombres_cliente: nombres,
                apellidos_cliente: apellidos,
                dni_cliente: dni,
                ruc_cliente: ruc,
                empresa_cliente: empresa,
                direccion_empresa_cliente: direccion_empresa,
                direccion_pedido_cliente: direccion_pedido,
                telefono_cliente: telefono,
                slug: ""
            },
            success: function(response) {
                indexClientes();
                $(".modal-inputs").val("");
            }
        });
    }
});

$("#btn_buscarCliente").click(function() {
    let inputBuscadorCliente = $("#inputBuscadorCliente").val();

    //Aqui se estas ocultando todos las filas de clientes
    $(".filaCliente").hide();

    $("#tableCustomers")
        .find(".filaCliente")
        .each(function() {
            var dniFila = $(this)
                .find(".td_dni_cliente")
                .text();

            var rucFila = $(this)
                .find(".td_ruc_cliente")
                .text();

            if (
                dniFila.indexOf(inputBuscadorCliente) != -1 ||
                rucFila.indexOf(inputBuscadorCliente) != -1
            ) {
                //SE muestra la fila de conincidencia
                $(this).show();
            }
        });
});

$(document).on("keyup", ".cantidad_producto", function() {
    let obj = $(this)
        .parent()
        .parent();
    let precio_paquete = obj.find(".precio_paquete_producto").val();
    let cantidad = $(this).val();

    let subtotalIGV = cantidad * precio_paquete;
    obj.find(".subtotalIGV_producto").val(subtotalIGV);
    total_subtotal_impuesto();
});

var strSelectProducto = "";
var selectProducto = function() {
    strSelectProducto =
        "<select onchange='selectFunctionProductos($(this))'><option>Seleecione</option>";
    for (let x = 0; x < productosAjax.length; x++) {
        const producto = productosAjax[x];
        strSelectProducto =
            strSelectProducto +
            "<option value='" +
            producto.id +
            "'>" +
            producto.nombre +
            "</option>";
    }
    strSelectProducto = strSelectProducto + "</select>";
};

var strSelectBono = "";
var selectBono = function() {
    strSelectBono =
        "<select onchange='selectFunctionBonos($(this))'><option>Seleccione</option>";
    for (let x = 0; x < bonosAjax.length; x++) {
        const bono = bonosAjax[x];
        strSelectBono =
            strSelectBono +
            "<option value='" +
            bono.id +
            "'>" +
            bono.titulo +
            "</option>";
    }
    strSelectBono = strSelectBono + "</select>";
};

var indexClientes = function() {
    var URL = URLdomain + "/pedidos/listCustomers";
    $.ajax({
        type: "GET",
        url: URL,
        success: function(data) {
            limpiarTablaCliente();
            tablaCliente(data);
            $("#modal-nuevoCliente").hide();
        },
        error: function(jqXHR, textStatus, errorThrown) {}
    });
};

var productosAjax = {};
var indexProductos = function() {
    var URL =URLdomain+ "/pedidos/listProducts";
    $.ajax({
        type: "GET",
        url: URL,
        success: function(data) {
            productosAjax = data;
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log("Error Ajax");
        }
    });
};

var bonosAjax = {};
var indexBonos = function() {
    var URL = URLdomain+ "/pedidos/listBonuses";
    $.ajax({
        type: "GET",
        url: URL,
        success: function(data) {
            bonosAjax = data;
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log("Error Ajax");
        }
    });
};

var tablaCliente = function(data) {
    for (var x = 0; x < data.length; x++) {
        var item = data[x];
        $("#tableCustomers").append(
            "<tr class='filaCliente'>" +
                "<td align='center'>" +
                "<button type='button' class='btn btn-info btn-sm btn_seleccionarCliente'><i class='fas fa-mouse-pointer'></i>" +
                "<input type='hidden' class='td_direccion_pedido_cliente' value='" +
                item.direccion_pedido +
                "' >" +
                "</button>" +
                "</td>" +
                "<td class='td_id_cliente'>" +
                item.id +
                "</td>" +
                "<td class='td_nombres_cliente'>" +
                item.nombres +
                "</td>" +
                "<td class='td_apellidos_cliente'>" +
                item.apellidos +
                "</td>" +
                "<td class='td_dni_cliente'>" +
                item.dni +
                "</td>" +
                "<td class='td_ruc_cliente'>" +
                item.ruc +
                "</td>" +
                "<td class='td_telefono_cliente'>" +
                item.telefono +
                "</td>" +
                "</tr>"
        );
    }
};

var limpiarTablaCliente = function() {
    $(".filaCliente").remove();
};

var selectFunctionProductos = function(e) {
    var obj = e;

    for (let x = 0; x < productosAjax.length; x++) {
        const item = productosAjax[x];
        if (item.id == obj.val()) {
            obj.parent()
                .parent()
                .find(".id_producto")
                .val(item.id);

            obj.parent()
                .parent()
                .find(".precio_producto")
                .val(item.precio);

            obj.parent()
                .parent()
                .find(".cantidad_paquete_producto")
                .val(item.cantidad_paquete);

            obj.parent()
                .parent()
                .find(".precio_paquete_producto")
                .val(item.cantidad_paquete * item.precio);

            //Este para pasar el nombre  a la VISTA PREVIA
            obj.parent()
                .parent()
                .find(".nombre_producto")
                .val(item.nombre);

            break;
        }
    }
};

var selectFunctionBonos = function(e) {
    var obj = e;

    for (let x = 0; x < bonosAjax.length; x++) {
        const item = bonosAjax[x];
        if (item.id == obj.val()) {
            obj.parent()
                .parent()
                .find(".producto_bono")
                .text(item.nombre_producto);
            obj.parent()
                .parent()
                .find(".id_producto_bono")
                .val(item.products_id);
            obj.parent()
                .parent()
                .find(".id_bono")
                .val(item.id);

            $("#descripcion_bono").text(item.descripcion);

            break;
        }
    }
};

var total_subtotal_impuesto = function() {
    var total = 0;
    var subtotal = 0;
    var impuesto = 0;
    $(".subtotalIGV_producto").each(function(i, e) {
        var semivalor = $(this).val() - 0;
        total += semivalor;
    });

    subtotal = total / 1.18;
    impuesto = total - subtotal;

    //Para la vista de PRODUCTOS
    $("#total_venta").val(total.toFixed(3));
    $("#subtotal_venta").val(subtotal.toFixed(3));
    $("#impuesto_venta").val(impuesto.toFixed(3));
    //Para la vista de PEDIDOS
    $("#total_pedido").val(total.toFixed(3));
    $("#subtotal_pedido").val(subtotal.toFixed(3));
    $("#impuesto_pedido").val(impuesto.toFixed(3));
};

var tableProductsPedido = function() {
    //Para remover filas de la VISTA PRINCIPAL
    $(".filaProductoView").remove();

    $("#tableProducts")
        .find(".filaProducto")
        .each(function() {
            let TR = $(this);

            let id_tr = TR.attr("id");
            let producto = TR.find(".nombre_producto").val();
            let precio_unidad = TR.find(".precio_producto").val();
            let cantidad_paquete = TR.find(".cantidad_paquete_producto").val();
            let precio_paquete = TR.find(".precio_paquete_producto").val();
            let cantidad = TR.find(".cantidad_producto").val();

            $("#tableProductsPedido").append(
                "<tr class='filaProductoView' id='" +
                    id_tr +
                    "'>" +
                    "<td align='center'>" +
                    "<span>" +
                    producto +
                    "</span>" +
                    "</td>" +
                    "<td align='center'>" +
                    "S/.<span>" +
                    precio_unidad +
                    "</span>" +
                    "</td>" +
                    "<td align='center'>" +
                    "<span >" +
                    cantidad_paquete +
                    "</span>" +
                    "</td>" +
                    "<td align='center'>" +
                    "S/.<span >" +
                    precio_paquete +
                    "</span>" +
                    "</td>" +
                    "<td align='center'>" +
                    "<span>" +
                    cantidad +
                    "</span>" +
                    "</td>" +
                    "</tr>"
            );
        });
};
