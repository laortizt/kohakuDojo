<?php
require_once "./controller/controllerClass.php";
$insAdmin = new controllerClass();
?>

    <div class="row">
        <div class="col-12 col-m-12 col-sm-12">
            <div class="card">
                <div class="card-content">
                    <div class="header-class">
                        <h1 class="title">Horario de Clases</h1>
                        <?php include "./views/modules/menuClass.php"; ?>
                    </div>

                    <div class="container container-calendar">
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

                        <div id="calendar" style="min-height: 600px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script defer src="<?php echo SERVERURL; ?>assets/script/calendar.js"></script>