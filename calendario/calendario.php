<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/almacen/listado_de_productos.php');
?>

<!-- FULLCALENDAR CSS -->

<link rel="stylesheet" href="../public/templeates/AdminLTE-3.2.0/plugins/fullcalendar/main.css">

<div class="content-wrapper">

  <div class="content-header">
    <div class="container-fluid">
      <h1>CALENDARIO</h1>
    </div>
  </div>

  <section class="content">
    <div class="container-fluid">
      <div class="row">

        <!-- CALENDARIO -->
        <div class="col-md-9">
          <div class="card card-primary">
            <div class="card-body p-2">

              <!-- 👇 ESTE ES EL DIV CORRECTO -->
              <div id="calendar"></div>

            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- MODAL CREAR EVENTO -->
  <div class="modal fade" id="modalEvento" tabindex="-1">
    <div class="modal-dialog modal-md modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header bg-primary py-2">
          <h6 class="modal-title">Nuevo Pedido</h6>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body py-2">

          <div class="alert alert-info p-2 mb-2 text-center" id="fechaCrear"></div>
          <input type="hidden" id="fecha_inicio">

          <!-- CLIENTE -->
          <div class="form-group mb-2">
            <label class="mb-1">Cliente</label>
            <input type="text" id="cliente" class="form-control form-control-sm" placeholder="Nombre">
            <small id="error_cliente" class="text-error"></small>
          </div>

          <!-- PRODUCTO -->
          <div class="form-group mb-2">
            <label class="mb-1">Producto</label>
            <select id="producto_id" class="form-control form-control-sm">
              <small id="error_producto" class="text-error"></small>
              <option value="">Seleccione</option>
              <?php foreach ($productos_datos as $producto): ?>
                <option value="<?php echo $producto['id_producto']; ?>"
                  data-precio="<?php echo $producto['precio_venta']; ?>"
                  data-stock="<?php echo $producto['stock']; ?>"
                  data-descripcion="<?php echo $producto['descripcion']; ?>">
                  <?php echo $producto['nombre']; ?>
                </option>
              <?php endforeach; ?>
            </select>
          </div>

          <!-- FILA -->
          <div class="row">
            <div class="col-6">
              <div class="form-group mb-2">
                <label class="mb-1">Stock</label>
                <input type="text" id="stock" class="form-control form-control-sm" readonly>
              </div>
            </div>

            <div class="col-6">
              <div class="form-group mb-2">
                <label class="mb-1">Cantidad</label>
                <input type="number" id="cantidad" class="form-control form-control-sm">
                <small id="error_cantidad" class="text-error"></small>
              </div>
            </div>
          </div>

          <!-- FILA -->
          <div class="row">
            <div class="col-6">
              <div class="form-group mb-2">
                <label class="mb-1">Precio</label>
                <input type="text" id="precio" class="form-control form-control-sm" readonly>
              </div>
            </div>

            <div class="col-6">
              <div class="form-group mb-2">
                <label class="mb-1">Subtotal</label>
                <input type="text" id="subtotal" class="form-control form-control-sm" readonly>
              </div>
            </div>
          </div>

          <!-- DESCRIPCIÓN -->
          <div class="form-group mb-2">
            <label class="mb-1">Descripción</label>
            <input type="text" id="descripcion" class="form-control form-control-sm" readonly>
          </div>

        </div>

        <div class="modal-footer py-2">
          <button class="btn btn-sm btn-secondary" data-dismiss="modal">Cancelar</button>
          <button class="btn btn-sm btn-success" id="guardarEvento">Guardar</button>
        </div>

      </div>
    </div>
  </div>

  <!-- MODAL DETALLE -->
  <div class="modal fade" id="modalDetalle" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header bg-info">
          <h5>Detalle del Pedido</h5>
        </div>

        <div class="modal-body" id="detalleContenido"></div>


        <div class="modal-footer justify-content-between">

          <!-- FECHA PEQUEÑA -->
          <small id="fechaDetalle" class="text-muted"></small>

          <div>
            <button class="btn btn-sm btn-success" id="btnVender">
              <i class="fas fa-cash-register"></i> Vender
            </button>

            <button class="btn btn-sm btn-danger" id="eliminarEvento">
              Eliminar
            </button>
          </div>

        </div>

      </div>
    </div>
  </div>

  <!-- MODAL VENDER -->
  <div class="modal fade" id="modalVender" tabindex="-1">
    <div class="modal-dialog modal-sm modal-dialog-centered">
      <div class="modal-content">

        <div class="modal-header bg-success py-2">
          <h6 class="modal-title">💰 Venta</h6>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body py-2">

          <input type="hidden" id="venta_evento_id">

          <!-- CLIENTE -->
          <div class="form-group mb-2">
            <label class="mb-1">Cliente</label>
            <input type="text" id="venta_cliente" class="form-control form-control-sm" readonly>
          </div>

          <!-- PRODUCTO -->
          <div class="form-group mb-2">
            <label class="mb-1">Producto</label>
            <input type="text" id="venta_producto" class="form-control form-control-sm" readonly>
          </div>

          <!-- FILA -->
          <div class="row">
            <div class="col-6">
              <div class="form-group mb-2">
                <label class="mb-1">Cantidad</label>
                <input type="number" id="venta_cantidad" class="form-control form-control-sm">
              </div>
            </div>

            <div class="col-6">
              <div class="form-group mb-2">
                <label class="mb-1">Precio</label>
                <input type="number" id="venta_precio" class="form-control form-control-sm">
              </div>
            </div>
          </div>

          <!-- TOTAL -->
          <div class="form-group mb-2">
            <label class="mb-1">Total</label>
            <input type="text" id="venta_total" class="form-control form-control-sm text-center font-weight-bold" readonly>
          </div>

        </div>

        <div class="modal-footer py-2">
          <button class="btn btn-sm btn-secondary" data-dismiss="modal">Cancelar</button>
          <button class="btn btn-sm btn-success" id="confirmarVenta">Guardar</button>
        </div>

      </div>
    </div>
  </div>

</div>

<?php include('../layout/parte2.php'); ?>

<!-- SCRIPTS -->
<!--<script src="../public/templeates/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>-->
<!--<script src="../public/templeates/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>-->

<!--<script src="../public/templeates/AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js"></script>-->
<!--<script src="../public/templeates/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>-->

<!--<script src="../public/templeates/AdminLTE-3.2.0/plugins/moment/moment.min.js"></script>-->
<!--<script src="../public/templeates/AdminLTE-3.2.0/plugins/fullcalendar/main.js"></script>-->
<script src="../public/templeates/AdminLTE-3.2.0/plugins/moment/moment.min.js"></script>
<script src="../public/templeates/AdminLTE-3.2.0/plugins/fullcalendar/main.js"></script>

<style>
  #calendar {
    width: 100%;
  }

  .input-error {
    border: 1px solid red !important;
  }

  .text-error {
    color: red;
    font-size: 12px;
  }

  .modal-sm {
    max-width: 350px;
  }
</style>

<script>
  //Boton Vender Redireccion
  $(document).on('click', '#btnVender', function() {

    var evento = window.eventoSeleccionado;

    if (!evento) {
      alert("Error: no hay datos del evento");
      return;
    }


    var producto_id = evento.extendedProps.producto_id;

    var precio = $('#producto_id option[value="' + producto_id + '"]').data('precio');

    $('#venta_cliente').val(evento.extendedProps.cliente);
    $('#venta_producto').val(evento.extendedProps.producto.trim());
    $('#venta_cantidad').val(evento.extendedProps.cantidad);
    $('#venta_precio').val(precio); // 🔥 AUTO PRECIO BD

    $('#modalDetalle').modal('hide');
    $('#modalVender').modal('show');

    // 🔥 ESPERAR A QUE EL MODAL ABRA BIEN
    setTimeout(function() {
      calcularTotalVenta();
    }, 200);

  });

  function calcularTotalVenta() {
    var cantidad = parseFloat($('#venta_cantidad').val()) || 0;
    var precio = parseFloat($('#venta_precio').val()) || 0;

    $('#venta_total').val((cantidad * precio).toFixed(2));
  }

  //Calcular Total Automatico
  $('#venta_cantidad, #venta_precio').on('input', function() {

    calcularTotalVenta();
    var cantidad = parseFloat($('#venta_cantidad').val()) || 0;
    var precio = parseFloat($('#venta_precio').val()) || 0;

    $('#venta_total').val((cantidad * precio).toFixed(2));

  });


  //Guardar Venta (AJAX)
  $('#confirmarVenta').click(function() {

    var cliente = $('#venta_cliente').val();
    var producto = $('#venta_producto').val();
    var cantidad = $('#venta_cantidad').val();
    var precio = $('#venta_precio').val();
    var total = $('#venta_total').val();

    if (!precio || !cantidad) {
      alert("Completa los datos");
      return;
    }

    $.ajax({
      url: '../app/controllers/ventas/guardar_venta_calendario.php',
      type: 'POST',
      data: {
        cliente: cliente,
        producto: producto,
        cantidad: cantidad,
        precio: precio,
        total: total
      },
      success: function() {

        alert("Venta realizada correctamente");

        $('#modalVender').modal('hide');

      }
    });

  });

  $(function() {

    var calendarEl = document.getElementById('calendar');
    // 🔥 ABRIR MODAL SI VIENE DESDE NOTIFICACIÓN
    var crear = new URLSearchParams(window.location.search).get('crear');

    var calendar = new FullCalendar.Calendar(calendarEl, {

      eventDidMount: function(info) {

        var idURL = new URLSearchParams(window.location.search).get('id');

        if (idURL && info.event.id == idURL) {

          // 🎯 RESALTAR EVENTO
          info.el.style.border = "3px solid red";
          info.el.style.backgroundColor = "#ffcccc";

          // 🔥 ABRIR MODAL AUTOMÁTICO
          setTimeout(() => {

            var evento = info.event;
            window.eventoSeleccionado = evento; // 🔥 IMPORTANTE

            var evento = info.event;

            var contenido = `
            <div class="mb-2"><b>Cliente:</b> ${evento.extendedProps.cliente}</div>
            <div class="mb-2"><b>Producto:</b> ${evento.extendedProps.producto}</div>
            <div class="mb-2"><b>Cantidad:</b> ${evento.extendedProps.cantidad}</div>
            <div class="mb-2"><b>Descripción:</b> ${evento.extendedProps.descripcion}</div>
            `;

            $('#detalleContenido').html(contenido);
            $('#fechaDetalle').html("Fecha: " + evento.startStr);

            $('#modalDetalle').modal('show');

            // 🔥 LIMPIAR URL PARA QUE NO SE REPITA
            window.history.replaceState({}, document.title, window.location.pathname);

          }, 500);
        }

      },

      initialView: 'dayGridMonth',
      locale: 'es',

      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },

      events: '../app/controllers/eventos/listado.php',

      // 📅 CLICK EN DÍA → CREAR PEDIDO
      dateClick: function(info) {

        $('#producto_id').val('');
        $('#descripcion').val('');
        $('#stock').val('');
        $('#cantidad').val('');
        $('#precio').val('');
        $('#subtotal').val('');

        $('#fecha_inicio').val(info.dateStr);
        $('#fechaCrear').html("<b>Fecha:</b> " + info.dateStr);

        $('#modalEvento').modal('show');
      },

      // 👁️ CLICK EN EVENTO → VER DETALLE
      eventClick: function(info) {

        var evento = info.event;

        //🔥 GUARDAMOS TODO EN VARIABLES GLOBALES
        window.eventoSeleccionado = evento;

        var producto = evento.extendedProps.producto;
        var precio = 0;

        $('#producto_id option').each(function() {
          if ($(this).text() == producto) {
            precio = $(this).data('precio');
          }
        });

        var contenido = `
    <p><b>Cliente:</b> ${evento.extendedProps.cliente}</p>
    <p><b>Producto:</b> ${evento.extendedProps.producto}</p>
    <p><b>Cantidad:</b> ${evento.extendedProps.cantidad}</p>
    <p><b>Precio:</b> ${precio}</p>
    <p><b>Descripción:</b> ${evento.extendedProps.descripcion}</p>
  `;

        $('#detalleContenido').html(contenido);
        $('#modalDetalle').modal('show');
      },

    });

    calendar.render();

    // 🔥 ABRIR MODAL SI VIENE DESDE NOTIFICACIÓN
    if (crear) {

      setTimeout(() => {

        var hoy = new Date().toISOString().split('T')[0];

        $('#fecha_inicio').val(hoy);
        $('#fechaCrear').html("<b>Fecha:</b> " + hoy);

        $('#modalEvento').modal('show');

        // 🔥 LIMPIAR URL
        window.history.replaceState({}, document.title, window.location.pathname);

      }, 500);
    }

    // 💾 GUARDAR EVENTO
    $('#guardarEvento').click(function() {

      var cliente = $('#cliente').val();
      var producto_id = $('#producto_id').val();
      var producto = $('#producto_id option:selected').text(); // 🔥 nombre correcto
      var cantidad = $('#cantidad').val();
      var descripcion = $('#descripcion').val();
      var precio = $('#precio').val();
      var subtotal = $('#subtotal').val();
      var fecha = $('#fecha_inicio').val();

      // limpiar errores
      $('.form-control').removeClass('input-error');
      $('.text-error').text('');
      $('.form-control').on('input change', function() {
        $(this).removeClass('input-error');
        $(this).next('.text-error').text('');
      });

      var error = false;

      if (!cliente) {
        $('#cliente').addClass('input-error');
        $('#error_cliente').text('Ingrese el cliente');
        error = true;
      }

      if (!producto_id) {
        $('#producto_id').addClass('input-error');
        $('#error_producto').text('Seleccione un producto');
        error = true;
      }

      if (!cantidad) {
        $('#cantidad').addClass('input-error');
        $('#error_cantidad').text('Ingrese cantidad');
        error = true;
      }

      if (error) return;

      var hoy = new Date();
      var fechaEvento = new Date(fecha);
      var diferencia = (fechaEvento - hoy) / (1000 * 60 * 60 * 24);

      var color = '#28a745';

      if (diferencia <= 1) {
        color = '#dc3545';
      } else if (diferencia <= 3) {
        color = '#ffc107';
      }

      $.ajax({
        url: '../app/controllers/eventos/create.php',
        type: 'POST',
        data: {
          titulo: cliente,
          cliente: cliente,
          producto_id: producto_id,
          producto: producto,
          cantidad: cantidad,
          descripcion: descripcion,
          precio: precio,
          subtotal: subtotal,
          fecha_inicio: fecha,
          fecha_fin: fecha,
          color: color
        },
        success: function() {

          $('#modalEvento').modal('hide');
          calendar.refetchEvents();

        }
      });

    });

  });

  // 🗑️ ELIMINAR EVENTO
  $('#eliminarEvento').click(function() {

    var evento = window.eventoSeleccionado;

    if (!evento) {
      alert("No hay evento seleccionado");
      return;
    }

    $.ajax({
      url: '../app/controllers/eventos/delete.php',
      type: 'POST',
      data: {
        id: evento.id
      },
      success: function(response) {

        if (response.trim() == "OK") {

          $('#modalDetalle').modal('hide');

          // 🔥 eliminar visualmente sin recargar
          evento.remove();

        } else {
          alert("Error al eliminar");
        }

      }
    });

  });

  //Calcular subtotal automático
  $('#cantidad').on('input', function() {
    calcularSubtotal();
  });

  function calcularSubtotal() {
    var cantidad = parseFloat($('#cantidad').val()) || 0;
    var precio = parseFloat($('#precio').val()) || 0;

    var subtotal = cantidad * precio;

    $('#subtotal').val(subtotal.toFixed(2));
  }

  //Cargar datos automáticamente al seleccionar producto
  $('#producto_id').change(function() {

    var selected = $(this).find(':selected');

    var precio = selected.data('precio');
    var stock = selected.data('stock');
    var descripcion = selected.data('descripcion');

    $('#precio').val(precio);
    $('#stock').val(stock);
    $('#descripcion').val(descripcion);

    calcularSubtotal();
  });

  //LIMPIAR LOS INPUTS AL CERRAR
  $('#modalEvento').on('hidden.bs.modal', function() {

    $('#cliente').val('');
    $('#producto').val('');
    $('#cantidad').val('');
    $('#descripcion').val('');
    $('#fecha_inicio').val('');

  });
</script>

<style>
  #calendar {
    width: 100%;
  }
</style>