<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php'); 

if(isset($_SESSION['mensaje'])){
  $respuesta = $_SESSION['mensaje']; ?>;
  <script>
  Swal.fire({
    position: 'top-end',
    icon: 'error',
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
          <h1 class="m-0">Registro de Usuarios</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-5">

            <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title" _msttexthash="109512" _msthash="201">Llene los datos con cuidado</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
              <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body" style="display: block;">
              <div class="row">
                <div class="col-md-12">
                  <form action="../app/controllers//usuarios/create.php" method="post">
                    <div class="formgroup">
                      <label for="">Nombres</label>
                      <input type="text" name="nombres" class="form-control" placeholder="Escriba el nombre del nuevo usuario">
                    </div>
                    <div class="formgroup">
                      <label for="">Email</label>
                      <input type="email" name="email" class="form-control" placeholder="Escriba el email del nuevo usuario">
                    </div>
                    <div class="formgroup">
                      <label for="">Password</label>
                      <input type="text" name="password_user" class="form-control" placeholder="Escriba el Password del nuevo usuario">
                    </div>
                    <div class="formgroup">
                      <label for="">Verificar Password</label>
                      <input type="text" name="password_repeat" class="form-control" placeholder="Verificar Password del nuevo usuario">
                    </div>
                    <hr>
                    <div class="formgroup">
                      <a href="index.php" class="btn btn-secondary">Cancelar</a>
                     <button type="submit" class="btn btn-primary">Guardar</button>
                  </form>
                
              </div>
              </div>
            </div>
          </div>

        </div>

      </div>


    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php include('../layout/parte2.php'); ?>