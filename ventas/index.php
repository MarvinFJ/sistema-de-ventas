<?php

include('../app/config.php');
include('../layout/sesion.php');
include('../layout/parte1.php');
include('../app/controllers/ventas/listado_de_ventas.php');
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <h1>Listado de Ventas</h1>
        </div>
    </div>

    <div class="content">
        <div class="container-fluid">

            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Ventas registradas</h3>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tablaVentas" class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Nro</th>
                                    <th>N° Venta</th>
                                    <th>Cliente</th>
                                    <th>Total</th>
                                    <th>Método Pago</th>
                                    <th>Fecha</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                            <?php
                            $contador = 0;
                            foreach ($ventas_datos as $venta) {
                                $contador++;
                            ?>

                                <tr>
                                    <td><?php echo $contador; ?></td>
                                    <td><?php echo $venta['nro_venta']; ?></td>
                                    <td><?php echo $venta['nombre_cliente']; ?></td>
                                    <td><?php echo $venta['total']; ?></td>
                                    <td><?php echo $venta['metodo_pago']; ?></td>
                                    <td><?php echo $venta['fyh_creacion']; ?></td>

                                    <td>
                                        <a href="ver.php?nro_venta=<?php echo $venta['nro_venta']; ?>" 
                                           class="btn btn-info btn-sm">
                                           <i class="fa fa-eye"></i> Ver
                                        </a>
                                    </td>
                                </tr>

                            <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<?php include('../layout/parte2.php'); ?>

<script>
$(function () {
    $("#tablaVentas").DataTable({
        "pageLength": 5,
        "language": {
            "emptyTable": "No hay ventas registradas",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ ventas",
            "search": "Buscar:",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });
});
</script>