<?php
require_once "./controller/controllerAdmin.php";
$insAdmin = new controllerAdmin();
?>




    <!-- <?php include "./views/modules/menuProgress.php"; ?> -->

    <div class="row">
        <div class="col-12 col-m-12 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="header-class">
                        <h1 class="title">Listado Ascensos</h1>
                         <div>
						<!-- <a href="<?php echo SERVERURL; ?>newProgress" class="btn-kohaku">
							<i class="fas fa-plus-circle"></i> Nuevo -->
						</a> 
					    </div> 
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


<script src="<?php echo SERVERURL; ?>assets/script/progress.js"></script>