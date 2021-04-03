<?php
require_once "./controller/controllerClass.php";
$insAdmin = new controllerClass();
?>


<div class="container-fluid">
    <?php include "./views/modules/menuClass.php"; ?>

    <div class="row">
        <div class="col-12 col-m-12 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="header-class">
                        <h1>Horario de Clases</h1>
                    </div>

                    <div class="container">
                        <div id="menu">
                            <span id="menu-navi">
                                <button type="button" class="btn btn-default btn-sm move-today" data-action="move-today">Today</button>
                                <button type="button" class="btn btn-default btn-sm move-day" data-action="move-prev">
                                    <i class="calendar-icon ic-arrow-line-left" data-action="move-prev"></i>
                                </button>
                                <button type="button" class="btn btn-default btn-sm move-day" data-action="move-next">
                                    <i class="calendar-icon ic-arrow-line-right" data-action="move-next"></i>
                                </button>
                            </span>
                            <span id="renderRange" class="render-range"></span>
                        </div>

                        <div id="calendar" style="height: 800px;"></div>
                    </div>


                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="<?php echo SERVERURL; ?>assets/script/calendar.js"></script>