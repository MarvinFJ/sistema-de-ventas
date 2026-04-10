<?php
include(__DIR__ . '/../app/controllers/configuraciones/show.php');

?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de ventas</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/dist/css/adminlte.min.css">

    <!-- Libreria Sweetallert2-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

    <!-- jQuery -->
    <script src="<?php echo $URL; ?>/public/templeates/AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
    <style>
        .dropdown-menu {
            margin-right: -50px;
            /* mueve hacia la izquierda */
        }
    </style>

</head>

<body class="hold-transition sidebar-mini">

    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light"
            style="background-color: <?php echo $config['color_navbar'] ?? '#ffffff'; ?>">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="#" onclick="mostrarGuia()" class="nav-link">
                        <i class="fas fa-question-circle"></i> Ayuda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#modal-config">
                        <i class="fas fa-cog"></i>
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" onclick="cargarNotificaciones()">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-danger navbar-badge" id="contadorNotificaciones">0</span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right shadow-lg" style="border-radius:10px;">


                        <span class="dropdown-header" id="tituloNotificaciones">0 Notificaciones</span>

                        <div class="dropdown-divider"></div>

                        <div id="listaNotificaciones"></div>

                        <div class="dropdown-divider"></div>

                        <a href="<?php echo $URL; ?>/calendario/calendario.php?crear=1" class="dropdown-item text-center text-primary">
                            <i class="fas fa-plus-circle"></i> Crear evento
                        </a>
                    </div>
                </li>
            </ul>


            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->


        <!-- Main Sidebar Container -->
        <aside class="main-sidebar elevation-4"
            style="background-color: <?php echo $config['color_sidebar'] ?? '#343a40'; ?>">
            <!-- Brand Logo -->
            <a href="<?php echo $URL; ?>" class="brand-link">
                <img src="<?php echo $URL; ?>/almacen/logo/<?php echo $config['logo'] ?? 'logo.png'; ?>"
                    onerror="this.src='<?php echo $URL; ?>/almacen/logo/logo.png'"
                    class="brand-image img-circle elevation-3">
                <span class="brand-text font-weight-light">
                    <?php echo $config['nombre_empresa'] ?? 'SIS VENTAS'; ?>
                </span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="<?php echo $URL; ?>/almacen/img_productos/mar.jpeg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $rol_sesion; ?></a>
                    </div>
                </div>


                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->

                        <li class="nav-item ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Usuarios
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/usuarios" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de usuarios</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/usuarios/create.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Creación de usuario</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-address-card"></i>
                                <p>
                                    Roles
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/roles" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de roles</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/roles/create.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Creación de rol</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tags"></i>
                                <p>
                                    Categorías
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/categorias" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de categorías</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-list"></i>
                                <p>
                                    Almacen
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/almacen" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de productos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/almacen/create.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Creación de productos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-cart-plus"></i>
                                <p>
                                    Compras
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/compras" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de compras</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/compras/create.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Creación de compra</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-id-badge"></i>
                                <p>
                                    Proveedores
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/proveedores" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de proveedores</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item ">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-shopping-basket"></i>
                                <p>
                                    Ventas
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/ventas" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de ventas</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?php echo $URL; ?>/ventas/create.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Realizar de venta</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo $URL; ?>/calendario/calendario.php" class="nav-link">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>
                                    Calendar
                                    <span class="badge badge-info right"></span>
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="<?php echo $URL; ?>/app/controllers/login/cerrar_sesion.php" class="nav-link" style="background-color: #ca0a0b">
                                <i class="nav-icon fas fa-door-closed"></i>
                                <p>
                                    Cerrar Sesión
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <div class="modal fade" id="modal-config">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header bg-dark text-white">
                        <h4 class="modal-title">⚙️ Configuración del Sistema</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <form action="<?php echo $URL; ?>/app/controllers/configuraciones/update.php" method="post" enctype="multipart/form-data">
                        <div class="modal-body">

                            <div class="form-group">
                                <label>Nombre de la Empresa</label>
                                <input type="text" name="nombre_empresa" class="form-control" value="<?php echo $config['nombre_empresa'] ?? ''; ?>" required>
                            </div>

                            <div class="form-group">
                                <label>Logo</label>
                                <input type="file" name="logo" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label>Color Sidebar</label>
                                <input type="color" name="color_sidebar" value="<?php echo $config['color_sidebar'] ?? '#343a40'; ?>" required>
                            </div>

                            <div class="form-group">
                                <label>Color Navbar</label>
                                <input type="color" name="color_navbar" value="<?php echo $config['color_navbar'] ?? '#ffffff'; ?>">
                            </div>

                        </div>

                        <div class="modal-footer">
                            <button class="btn btn-success">Guardar</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <script>
            $(document).ready(function() {

                function cargarNotificaciones() {

                    $.ajax({
                        url: '<?php echo $URL; ?>/app/controllers/eventos/notificaciones.php',
                        type: 'GET',
                        success: function(respuesta) {

                            var eventos = JSON.parse(respuesta);

                            var html = '';
                            var contador = 0;

                            var hoy = new Date();

                            eventos.forEach(function(evento) {

                                var fechaEvento = new Date(evento.fecha_inicio);
                                var diferencia = (fechaEvento - hoy) / (1000 * 60 * 60 * 24);

                                var color = 'text-success';
                                var icono = 'far fa-calendar';

                                // 🔥 LÓGICA DE ALERTA
                                if (diferencia <= 1) {
                                    color = 'text-danger';
                                    icono = 'fas fa-exclamation-circle';
                                } else if (diferencia <= 3) {
                                    color = 'text-warning';
                                    icono = 'fas fa-exclamation-triangle';
                                } else if (diferencia <= 7) {
                                    color = 'text-info';
                                    icono = 'fas fa-bell';
                                }

                                html += `
                                    <a href="<?php echo $URL; ?>/calendario/calendario.php?fecha=${evento.fecha_inicio}&id=${evento.id}" class="dropdown-item d-flex align-items-start">

                                    <div class="mr-3">
                                        <i class="${icono} ${color}" style="font-size:20px;"></i>
                                    </div>

                                    <div style="flex:1;">
                                     <div style="font-weight:bold;">${evento.titulo}</div>
                                     <small class="text-muted">${evento.fecha_inicio}</small>
                                     </div>

                                        </a>
                                    <div class="dropdown-divider"></div>
                                `;

                                contador++;
                            });

                            if (contador === 0) {
                                html = '<span class="dropdown-item text-center">Sin notificaciones</span>';
                            }

                            $('#listaNotificaciones').html(html);
                            $('#contadorNotificaciones').text(contador);
                            $('#tituloNotificaciones').text(contador + ' Notificaciones');

                        }
                    });
                }
                //CARGA INICIAL
                cargarNotificaciones();

                // 🔄 refresca cada 30 segundos
                setInterval(cargarNotificaciones, 30000);

                //Dropdown siempre se actualize campanita
                $('.nav-item.dropdown').on('show.bs.dropdown', function() {
                    cargarNotificaciones();
                });

            });
        </script>