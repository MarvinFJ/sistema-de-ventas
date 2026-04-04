<!-- Main Footer -->
<footer class="main-footer">
    <!-- Default to the left -->
    <strong>
        <center>Copyright &copy; 2023 <a href="https://adminlte.io"></a>.</center>
    </strong>
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->


<!-- Bootstrap 4 -->
<script src="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>


<!-- DataTables  & Plugins -->
 <script>
$('#monto_recibido').keyup(function(){
    var recibido = parseFloat($(this).val());
    var total = parseFloat($('#total_venta').val());

    if(!isNaN(recibido)){
        var cambio = recibido - total;
        $('#cambio').val(cambio.toFixed(2));
    }
});
</script>
<script>
$('form').submit(function(e){

    var recibido = parseFloat($('#monto_recibido').val());
    var total = parseFloat($('#total_venta').val());

    if(isNaN(recibido)){
        alert("Ingrese el monto recibido");
        e.preventDefault();
        return;
    }

    if(recibido < total){
        alert("El monto es menor al total");
        e.preventDefault();
        return;
    }

});
</script>
<script src="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/jszip/jszip.min.js"></script>
<script src="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script>
    function mostrarGuia() {
        Swal.fire({
            title: '👋 Bienvenido',
            text: 'Este es tu sistema de ventas',
            icon: 'info'
        }).then(() => {
            Swal.fire('📦 Productos', 'Aquí gestionas tu inventario');
        }).then(() => {
            Swal.fire('🛒 Ventas', 'Aquí realizas ventas');
        });
    }
</script>

</body>

</html>