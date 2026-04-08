<?php
include('./app/config.php');
include('layout/sesion.php');

include('layout/parte1.php');
include('app/controllers/usuarios/listado_de_usuarios.php');
include('app/controllers/roles/listado_de_roles.php');
include('app/controllers/categorias/listado_de_categoria.php');
include('app/controllers/almacen/listado_de_productos.php');
include('app/controllers/proveedores/listado_de_proveedores.php');
include('app/controllers/compras/listado_de_compras.php');
include('app/controllers/eventos/listado_de_eventos_dashboard.php');

?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h1 class="m-0"><?php echo $nombres_sesion; ?> </h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Dashboard</h3>
                </div>

                <div class="card-body">
                    <div class="row g-3">

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-gradient-warning">
                                <div class="inner">
                                    <?php
                                    $contador_de_usuarios = 0;
                                    foreach ($usuarios_datos as $usuarios_dato) {
                                        $contador_de_usuarios = $contador_de_usuarios + 1;
                                    }
                                    ?>
                                    <h3><?php echo $contador_de_usuarios; ?></h3>
                                    <p>Usuarios Registrados</p>
                                </div>
                                <a href="<?php echo $URL; ?>/usuarios/create.php">
                                    <div class="icon">
                                        <i class="fas fa-user-plus"></i>
                                    </div>
                                </a>
                                <a href="<?php echo $URL; ?>/usuarios" class="small-box-footer">
                                    Más detalle <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-gradient-info">
                                <div class="inner">
                                    <?php
                                    $contador_de_roles = 0;
                                    foreach ($roles_datos as $roles_dato) {
                                        $contador_de_roles = $contador_de_roles + 1;
                                    }
                                    ?>
                                    <h3><?php echo $contador_de_roles; ?></h3>
                                    <p>Roles Registrados</p>
                                </div>
                                <a href="<?php echo $URL; ?>/roles/create.php">
                                    <div class="icon">
                                        <i class="fas fa-address-card"></i>
                                    </div>
                                </a>
                                <a href="<?php echo $URL; ?>/roles" class="small-box-footer">
                                    Más detalle <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>


                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-gradient-success">
                                <div class="inner">
                                    <?php
                                    $contador_de_categorias = 0;
                                    foreach ($categorias_datos as $categorias_dato) {
                                        $contador_de_categorias = $contador_de_categorias + 1;
                                    }
                                    ?>
                                    <h3><?php echo $contador_de_categorias; ?></h3>
                                    <p>Categorías Registrados</p>
                                </div>
                                <a href="<?php echo $URL; ?>/categorias">
                                    <div class="icon">
                                        <i class="fas fa-tags"></i>
                                    </div>
                                </a>
                                <a href="<?php echo $URL; ?>/categorias" class="small-box-footer">
                                    Más detalle <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>


                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-gradient-primary">
                                <div class="inner">
                                    <?php
                                    $contador_de_productos = 0;
                                    foreach ($productos_datos as $productos_dato) {
                                        $contador_de_productos = $contador_de_productos + 1;
                                    }
                                    ?>
                                    <h3><?php echo $contador_de_productos; ?></h3>
                                    <p>Productos Registrados</p>
                                </div>
                                <a href="<?php echo $URL; ?>/almacen/create.php">
                                    <div class="icon">
                                        <i class="fas fa-list"></i>
                                    </div>
                                </a>
                                <a href="<?php echo $URL; ?>/almacen" class="small-box-footer">
                                    Más detalle <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>



                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-gradient-dark">
                                <div class="inner">
                                    <?php
                                    $contador_de_proveedores = 0;
                                    foreach ($proveedores_datos as $proveedores_dato) {
                                        $contador_de_proveedores = $contador_de_proveedores + 1;
                                    }
                                    ?>
                                    <h3><?php echo $contador_de_proveedores; ?></h3>
                                    <p>Proveedores Registrados</p>
                                </div>
                                <a href="<?php echo $URL; ?>/proveedores">
                                    <div class="icon">
                                        <i class="fas fa-id-badge"></i>
                                    </div>
                                </a>
                                <a href="<?php echo $URL; ?>/proveedores" class="small-box-footer">
                                    Más detalle <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-gradient-danger">
                                <div class="inner">
                                    <?php
                                    $contador_de_compras = 0;
                                    foreach ($compras_datos as $compras_dato) {
                                        $contador_de_compras = $contador_de_compras + 1;
                                    }
                                    ?>
                                    <h3><?php echo $contador_de_compras; ?></h3>
                                    <p>Compras Registrados</p>
                                </div>
                                <a href="<?php echo $URL; ?>/compras">
                                    <div class="icon">
                                        <i class="fas fa-cart-plus"></i>
                                    </div>
                                </a>
                                <a href="<?php echo $URL; ?>/compras" class="small-box-footer">
                                    Más detalle <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>
                        </div>

                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-gradient-pink shadow">
                                <div class="inner">
                                    <?php
                                    $contador_de_eventos = 0;
                                    foreach ($eventos_datos as $evento) {
                                        $contador_de_eventos = $contador_de_eventos + 1;
                                    }
                                    ?>
                                    <h3><?php echo $contador_de_eventos; ?></h3>
                                    <p>Eventos en Calendario</p>
                                </div>
                                <a href="<?php echo $URL; ?>/calendario/calendario.php">
                                    <div class="icon">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                </a>
                                <a href="<?php echo $URL; ?>/calendario/calendario.php" class="small-box-footer">
                                    Ver calendario <i class="fas fa-arrow-circle-right"></i>
                                </a>
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<style>
    .small-box:hover {
        transform: scale(1.03);
        transition: 0.3s;
    }
</style>

<?php include('layout/parte2.php'); ?>