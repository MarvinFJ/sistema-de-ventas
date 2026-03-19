<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/usuarios/listado_de_usuarios.php'); 

if(isset($_SESSION['mensaje'])){
  $respuesta = $_SESSION['mensaje']; ?>;
  <script>
  Swal.fire({
    position: 'top-end',
    icon: 'success',
    title: '<?php echo $respuesta;?>',
    showConfirmButton: false,
    timer: 2000
  })</script>
  <?php
  unset($_SESSION['mensaje']);
}

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0">Listado de Usuarios</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">

      <div class="row">
        <div class="col-md-12">
          <div class="card card-outline card-primary">
            <div class="card-header">
              <h3 class="card-title" _msttexthash="109512" _msthash="201">Usuarios Registrados</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="display: block;">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
                   <tr>
                  <th><center>Nro</center></th>
                  <th><center>Nombres</center></th>
                  <th><center>Email</center></th>
                </tr>
                  </thead>
                  <tbody>
                  <?php
                  $contador = 0;
                  foreach ($usuarios_datos as $usuarios_datos) { ?>
                  <tr>
                    <td><center><?php echo $contador = $contador + 1;?></center></td>
                    <td><?php echo $usuarios_datos['nombres'];?></td>
                    <td><?php echo $usuarios_datos['email'];?></td>                   
                  </tr>
                    <?php
                  }
                  ?>
                </tbody>
                  <tfoot>
                   <tr>
                  <th><center>Nro</center></th>
                  <th><center>Nombres</center></th>
                  <th><center>Email</center></th>
                </tr>
                  </tfoot>
                </table>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include('../layout/parte2.php'); ?>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
