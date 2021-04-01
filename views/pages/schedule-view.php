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
                        <h1>Horario de Clasers</h1>
                    </div>
                  
                    <span id="menu-navi">
                        <button type="button" class="btn btn-default btn-sm move-today" data-action="move-today">Hoy</button>
                        <button type="button" class="btn btn-default btn-sm move-day" data-action="move-prev">
                            <i class="calendar-icon ic-arrow-line-left" data-action="move-prev"></i>
                        </button>
                        <button type="button" class="btn btn-default btn-sm move-day" data-action="move-next">
                            <i class="calendar-icon ic-arrow-line-right" data-action="move-next"></i>
                        </button>
                    </span>
                    <span id="renderRange" class="render-range"></span>

                    <div class="promo_card" id="post">
                        <h2>Custom popUp Post </h2>
                    </div>
                    <div class="promo_card" id="event">
                        <h2>Custom popUp Event </h2>
                    </div>
                    <div class="promo_card" id="offer">
                        <h2>Custom popUp Offer </h2>
                    </div>
                    <div class="promo_card" id="create">
                        <h2>Custom Create Schedule popUp </h2>
                    </div>
                    
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>

</div>
<script src="<?php echo SERVERURL; ?>assets/script/schedule.js"></script>