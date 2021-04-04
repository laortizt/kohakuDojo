<?php
require_once "./controller/controllerAdmin.php";
$insAdmin = new controllerAdmin();
?>


<div class="container-fluid">

    <?php include "./views/modules/menuProgress.php"; ?>


    <div class="row">
        <div class="col-12 col-m-12 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="header-class">
                        <h1>Seguimiento</h1>
                        <a href="<?php echo SERVERURL; ?>newPay" class="btn-kohaku">
                            <i></i> Nuevo
                        </a>
                        <a href="<?php echo SERVERURL; ?>calendar" class="btn-kohaku">
                            <i></i> Eliminar
                        </a>
                        <a href="<?php echo SERVERURL; ?>calendar" class="btn-kohaku">
                            <i></i> Listar
                        </a>
                    </div>

                    <table>
                        <thead>
                            <tr>
                                <th>Exámen</th>
                                <th>Fecha</th>
                                <th>Observaciones</th>
                                <td colspan="1">Estado</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td data-label="examen">10 kyu </td>
                                <td data-label="Fecha">02/01/2015</td>
                                <td data-label="Observacion">Muy buen Exámen</td>
                                <td data-label="Estado">Aprobado</td>
                            </tr>
                            <tr>
                                <td data-label="examen">9 kyu </td>
                                <td data-label="Fecha">02/01/2015</td>
                                <td data-label="Observacion">Muy buen Exámen</td>
                                <td data-label="Estado">Aprobado</td>
                            </tr>
                            <td data-label="examen">8 kyu </td>
                            <td data-label="Fecha">-</td>
                            <td data-label="Observacion">-</td>
                            <td data-label="Estado">-</td>
                            </tr>
                            <td data-label="examen">7 kyu </td>
                            <td data-label="Fecha">-</td>
                            <td data-label="Observacion">-</td>
                            <td data-label="Estado">-</td>
                            </tr>
                            <td data-label="examen">6 kyu </td>
                            <td data-label="Fecha">-</td>
                            <td data-label="Observacion">-</td>
                            <td data-label="Estado">-</td>
                            </tr>
                            <td data-label="examen">5 kyu </td>
                            <td data-label="Fecha">-</td>
                            <td data-label="Observacion">-</td>
                            <td data-label="Estado">-</td>
                            </tr>
                            <td data-label="examen">4 kyu </td>
                            <td data-label="Fecha">-</td>
                            <td data-label="Observacion">-</td>
                            <td data-label="Estado">-</td>
                            </tr>
                            <td data-label="examen">3 kyu </td>
                            <td data-label="Fecha">-</td>
                            <td data-label="Observacion">-</td>
                            <td data-label="Estado">-</td>
                            </tr>
                            <td data-label="examen">2 kyu </td>
                            <td data-label="Fecha">-</td>
                            <td data-label="Observacion">-</td>
                            <td data-label="Estado">-</td>
                            </tr>
                            <td data-label="examen">1 kyu </td>
                            <td data-label="Fecha">-</td>
                            <td data-label="Observacion">-</td>
                            <td data-label="Estado">-</td>
                            </tr>
                            <td data-label="examen">Shodan</td>
                            <td data-label="Fecha">-</td>
                            <td data-label="Observacion">-</td>
                            <td data-label="Estado">-</td>
                            </tr>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>

    <div class="RespuestaAjax"></div>
</div>

<script src="<?php echo SERVERURL; ?>assets/script/progress.js"></script>