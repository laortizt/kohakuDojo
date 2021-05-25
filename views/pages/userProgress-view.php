<?php
require_once "./controller/controllerProgress.php";
$insProgress = new controllerProgress();
?>



<div class="row privileges">
    <div class="col-12 col-m-12 col-sm-12">
        <div class="card">
            <div class="card-content">
			
                <div class="header-class">
					<h1 class="title">Mi Progreso</h1>
					<div class="barra__buscador">

					<form action="" class="formulario" method="post" form-data="default" form-data="default">
						<div>
							<input type="text" name="search_user" placeholder="Buscar nombre o apellidos" value="" class="text-search">
							<button href="#" type="submit" value="Buscar" name="button-search" class="btn-search"><i class="fa bi bi-search"></i></button>
						</div>
					</form>
					</div>

                 
                </div>

                <div>

                    <?php
					$pages = explode("/", $_GET['page']);

					echo $insProgress->pages_progress_controller(0, 10, $_SESSION['role_sk'], 'code');
					?>
                </div>
            </div>
        </div>

    </div>
</div>
