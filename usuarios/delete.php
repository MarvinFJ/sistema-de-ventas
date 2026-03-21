<?php
include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/usuarios/show_usuario.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0">Eliminar Usuarios</h1>
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

          <div class="card card-danger">
            <div class="card-header">
              <h3 class="card-title">¿Esta Seguro de Eliminar al Usuario?</h3>

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
                <form action="../app/controllers//usuarios//delete_usuario.php" method="POST">
                  <input type="text" name="id_usuario" value="<?php echo $id_usuario_get?>" hidden>
                    <div class="formgroup">
                    <label for="">Nombres</label>
                    <input type="text" name="nombres" class="form-control" value="<?php echo $nombres; ?>" disabled>
                  </div>
                  <div class="formgroup">
                    <label for="">Email</label>
                    <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" disabled>
                  </div>
                  <div class="formgroup">
                    <label for="">Rol del Usuario</label>
                    <input type="text" name="email" class="form-control" value="<?php echo $rol; ?>" disabled>
                  </div>
                  <hr>
                  <div class="formgroup">
                    <a href="index.php" class="btn btn-secondary">Volver</a>
                    <button class="btn btn-danger">Eliminar</button>
                  </div>
                </form>
                  
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
</div>
<?php include('../layout/mensajes.php'); ?>
<?php include('../layout/parte2.php'); ?>