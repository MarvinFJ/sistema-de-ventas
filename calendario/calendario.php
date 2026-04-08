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

        <!-- EVENTOS -->
        <div class="col-md-3">
          <div class="card">
            <div class="card-header">
              <h4>Eventos Arrastrables</h4>
            </div>
            <div class="card-body">

              <div id="external-events"></div>

              <div class="checkbox mt-2">
                <label>
                  <input type="checkbox" id="drop-remove">
                  Eliminar después de soltar
                </label>
              </div>

            </div>
          </div>
          <!-- /.card -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Crear Evento</h3>
            </div>
            <div class="card-body">
              <div class="btn-group" style="width: 100%; margin-bottom: 10px;">
                <ul class="fc-color-picker" id="color-chooser">
                  <li><a class="text-primary" href="#"><i class="fas fa-square"></i></a></li>
                  <li><a class="text-warning" href="#"><i class="fas fa-square"></i></a></li>
                  <li><a class="text-success" href="#"><i class="fas fa-square"></i></a></li>
                  <li><a class="text-danger" href="#"><i class="fas fa-square"></i></a></li>
                  <li><a class="text-muted" href="#"><i class="fas fa-square"></i></a></li>
                </ul>
              </div>
              <!-- /btn-group -->
              <div class="input-group">
                <input id="new-event" type="text" class="form-control" placeholder="Event Title">

                <div class="input-group-append">
                  <button id="add-new-event" type="button" class="btn btn-primary">Add</button>
                </div>
                <!-- /btn-group -->
              </div>
              <!-- /input-group -->
            </div>
          </div>
        </div>

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
<script src="../public/templeates/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<script src="../public/templeates/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
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

    var containerEl = document.getElementById('external-events');
    var calendarEl = document.getElementById('calendar');

    var currentColor = '#3788d8';

    // 🎨 SELECCIONAR COLOR
    $('#color-chooser a').click(function(e) {
      e.preventDefault();
      currentColor = $(this).find('i').css('color');
    });

    // 🎯 CREAR EVENTO ARRASTRABLE
    $('#add-new-event').click(function(e) {
      e.preventDefault();

      var val = $('#new-event').val();

      if (val.length === 0) return;

      // 🔥 CREAR NUEVO DIV
      var event = $('<div />');
      event.addClass('external-event');

      // 🎨 COLOR SELECCIONADO
      event.css({
        'background-color': currentColor,
        'border-color': currentColor,
        'color': '#fff'
      });

      event.text(val);

      // 📦 AGREGAR AL CONTENEDOR
      $('#external-events').prepend(event);

      // 🧹 LIMPIAR INPUT
      $('#new-event').val('');

      // 💾 GUARDAR EN LOCALSTORAGE
      var eventos = JSON.parse(localStorage.getItem('eventosArrastrables')) || [];

      eventos.push({
        titulo: val,
        color: currentColor
      });

      localStorage.setItem('eventosArrastrables', JSON.stringify(eventos));
    });

    // 🔥 ARRASTRABLES
    new FullCalendar.Draggable(containerEl, {
      itemSelector: '.external-event',
      eventData: function(eventEl) {
        return {
          title: eventEl.innerText.trim(),
          backgroundColor: window.getComputedStyle(eventEl).getPropertyValue('background-color'),
          borderColor: window.getComputedStyle(eventEl).getPropertyValue('background-color'),
          textColor: '#fff'
        };
      }
    });

    var fechaURL = new URLSearchParams(window.location.search).get('fecha');
    var calendar = new FullCalendar.Calendar(calendarEl, {

      initialDate: fechaURL ? fechaURL : new Date(), // 👈 ESTA ES LA CLAVE
      timeZone: 'local', // 👈 IMPORTANTE

      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },

      themeSystem: 'bootstrap',
      events: '../app/controllers/eventos/listado.php',

      eventDidMount: function(info) {

        var idURL = new URLSearchParams(window.location.search).get('id');

        if (idURL && info.event.id == idURL) {

          info.el.style.border = "3px solid red";
          info.el.style.backgroundColor = "#ffcccc";

          // 🔥 CENTRAR
          setTimeout(() => {
            info.el.scrollIntoView({
              behavior: 'smooth',
              block: 'center'
            });
          }, 500);

          // 🔥 ABRIR MODAL AUTOMÁTICO
          setTimeout(() => {

            var evento = info.event;

            var contenido = `
        <p><b>Cliente:</b> ${evento.extendedProps.cliente}</p>
        <p><b>Producto:</b> ${evento.extendedProps.producto}</p>
        <p><b>Cantidad:</b> ${evento.extendedProps.cantidad}</p>
        <p><b>Descripción:</b> ${evento.extendedProps.descripcion}</p>`;

            $('#detalleContenido').html(contenido);
            $('#fechaDetalle').html("<b>Fecha:</b> " + evento.startStr);

            $('#modalDetalle').modal('show');

          }, 800);
        }
      },







      editable: true,
      droppable: true,
      selectable: true,

      // 📅 ABRIR MODAL
      dateClick: function(info) {

        // 🧹 LIMPIAR CAMPOS
        $('#cliente').val('');
        $('#producto').val('');
        $('#cantidad').val('');
        $('#descripcion').val('');

        // 📅 SETEAR FECHA
        $('#fecha_inicio').val(info.dateStr);

        // 🔥 MOSTRAR FECHA
        $('#fechaCrear').html("<b>Fecha:</b> " + info.dateStr);
        // 👀 MOSTRAR MODAL
        $('#modalEvento').modal('show');
      },

      // 👁️ VER DETALLE
      eventClick: function(info) {

        var evento = info.event;

        var contenido = `
    <p><b>Cliente:</b> ${evento.extendedProps.cliente}</p>
    <p><b>Producto:</b> ${evento.extendedProps.producto}</p>
    <p><b>Cantidad:</b> ${evento.extendedProps.cantidad}</p>
    <p><b>Descripción:</b> ${evento.extendedProps.descripcion}</p>`;

        $('#detalleContenido').html(contenido);

        // 📅 FECHA
        $('#fechaDetalle').html("<b>Fecha:</b> " + evento.startStr);

        $('#modalDetalle').modal('show');

        // 🔥 AQUÍ ESTÁ EL PROBLEMA — AGREGA ESTO
        $('#eliminarEvento').off().click(function() {

          $.ajax({
            url: '../app/controllers/eventos/delete.php',
            type: 'POST',
            data: {
              id: evento.id
            },
            success: function(respuesta) {

              console.log(respuesta); // para debug

              $('#modalDetalle').modal('hide');
              calendar.refetchEvents();

            }
          });

        });

      },

      // 🎯 ARRASTRAR Y GUARDAR
      eventReceive: function(info) {

        var titulo = info.event.title;
        var fecha = info.event.startStr;
        var color = info.event.backgroundColor;

        var removeAfterDrop = document.getElementById('drop-remove').checked;

        // ✅ SI EL CHECK ESTÁ ACTIVADO → ELIMINAR DEL PANEL IZQUIERDO
        if (removeAfterDrop) {
          info.draggedEl.parentNode.removeChild(info.draggedEl);
        }
        if (removeAfterDrop) {
          var texto = info.draggedEl.innerText.trim();

          var eventos = JSON.parse(localStorage.getItem('eventosArrastrables')) || [];

          eventos = eventos.filter(e => e.titulo !== texto);

          localStorage.setItem('eventosArrastrables', JSON.stringify(eventos));
        }

        // ⚠️ ELIMINAR EL EVENTO TEMPORAL DEL CALENDARIO
        info.event.remove();

        // 💾 GUARDAR EN BD
        $.ajax({
          url: '../app/controllers/eventos/create.php',
          type: 'POST',
          data: {
            titulo: titulo,
            fecha_inicio: fecha,
            fecha_fin: fecha,
            color: color
          },
          success: function() {
            calendar.refetchEvents();
          }
        });

      }

    });


    calendar.render();

    // 👀 MOSTRAR MODAL
    $('#modalEvento').on('hidden.bs.modal', function() {
      $('#cliente').val('');
      $('#producto').val('');
      $('#cantidad').val('');
      $('#descripcion').val('');
    });

    // ✅ GUARDAR EVENTO (AHORA SÍ BIEN UBICADO)
    $('#guardarEvento').click(function() {

      var cliente = $('#cliente').val();
      var producto = $('#producto').val();
      var cantidad = $('#cantidad').val();
      var descripcion = $('#descripcion').val();
      var fecha = $('#fecha_inicio').val();

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

    // 🔄 CARGAR EVENTOS GUARDADOS
    var eventosGuardados = JSON.parse(localStorage.getItem('eventosArrastrables')) || [];

    eventosGuardados.forEach(function(ev) {

      var event = $('<div />');
      event.addClass('external-event');
      event.text(ev.titulo);

      event.css({
        'background-color': ev.color,
        'border-color': ev.color,
        'color': '#fff'
      });

      $('#external-events').prepend(event);

    });
  });
</script>

<style>
  #calendar {
    width: 100%;
  }

  .external-event {
    cursor: grab;
    border-radius: 8px;
    padding: 8px;
    margin-bottom: 5px;
    font-weight: bold;
  }
</style>