<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
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
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header bg-primary">
          <h5 class="modal-title">Nuevo Pedido</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <div class="modal-body">

          <div class="alert alert-info" id="fechaCrear"></div>
          <input type="hidden" id="fecha_inicio">

          <div class="form-group">
            <label>Cliente</label>
            <input type="text" id="cliente" class="form-control">
          </div>

          <div class="form-group">
            <label>Producto</label>
            <input type="text" id="producto" class="form-control">
          </div>

          <div class="form-group">
            <label>Cantidad</label>
            <input type="number" id="cantidad" class="form-control">
          </div>

          <div class="form-group">
            <label>Descripción</label>
            <textarea id="descripcion" class="form-control"></textarea>
          </div>

        </div>

        <div class="modal-footer">
          <button class="btn btn-success" id="guardarEvento">Guardar</button>
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


        <div class="modal-footer">
          <div class="alert alert-info" id="fechaDetalle"></div>
          <button class="btn btn-danger" id="eliminarEvento">Eliminar</button>
        </div>

      </div>
    </div>
  </div>

</div>

<?php include('../layout/parte2.php'); ?>

<!-- SCRIPTS -->
<!--<script src="../public/templeates/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>-->
<!--<script src="../public/templeates/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>-->
<script src="../public/templeates/AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js"></script>
<script src="../public/templeates/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>

<script src="../public/templeates/AdminLTE-3.2.0/plugins/moment/moment.min.js"></script>
<script src="../public/templeates/AdminLTE-3.2.0/plugins/fullcalendar/main.js"></script>

<style>
  #calendar {
    width: 100%;
  }
</style>

<script>
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

            var contenido = `
        <p><b>Cliente:</b> ${evento.extendedProps.cliente}</p>
        <p><b>Producto:</b> ${evento.extendedProps.producto}</p>
        <p><b>Cantidad:</b> ${evento.extendedProps.cantidad}</p>
        <p><b>Descripción:</b> ${evento.extendedProps.descripcion}</p>
      `;

            $('#detalleContenido').html(contenido);
            $('#fechaDetalle').html("<b>Fecha:</b> " + evento.startStr);

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

        $('#cliente').val('');
        $('#producto').val('');
        $('#cantidad').val('');
        $('#descripcion').val('');

        $('#fecha_inicio').val(info.dateStr);
        $('#fechaCrear').html("<b>Fecha:</b> " + info.dateStr);

        $('#modalEvento').modal('show');
      },

      // 👁️ CLICK EN EVENTO → VER DETALLE
      eventClick: function(info) {

        var evento = info.event;

        var contenido = `
        <p><b>Cliente:</b> ${evento.extendedProps.cliente}</p>
        <p><b>Producto:</b> ${evento.extendedProps.producto}</p>
        <p><b>Cantidad:</b> ${evento.extendedProps.cantidad}</p>
        <p><b>Descripción:</b> ${evento.extendedProps.descripcion}</p>
      `;

        $('#detalleContenido').html(contenido);
        $('#fechaDetalle').html("<b>Fecha:</b> " + evento.startStr);

        $('#modalDetalle').modal('show');

        // 🗑 ELIMINAR
        $('#eliminarEvento').off().click(function() {

          $.ajax({
            url: '../app/controllers/eventos/delete.php',
            type: 'POST',
            data: {
              id: evento.id
            },
            success: function() {

              $('#modalDetalle').modal('hide');
              calendar.refetchEvents();

            }
          });

        });

      },

      // 🎨 OPCIONAL → mostrar más info en calendario
      eventContent: function(arg) {
        return {
          html: `<b>${arg.event.title}</b><br>${arg.event.extendedProps.cantidad || ''}`
        };
      }

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
      var producto = $('#producto').val();
      var cantidad = $('#cantidad').val();
      var descripcion = $('#descripcion').val();
      var fecha = $('#fecha_inicio').val();

      if (!cliente || !producto || !cantidad) {
        alert("Completa todos los campos");
        return;
      }

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
          titulo: cliente + ' - ' + producto,
          cliente: cliente,
          producto: producto,
          cantidad: cantidad,
          descripcion: descripcion,
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
</script>

<style>
  #calendar {
    width: 100%;
  }
</style>