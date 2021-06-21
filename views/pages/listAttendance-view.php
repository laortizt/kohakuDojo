<?php
require_once "./controller/controllerAdmin.php";
require_once "./controller/controllerClass.php";
require_once "./controller/controllerInscription.php";
$insInscription = new controllerInscription();
$insAdmin = new controllerAdmin();
$insClass = new controllerClass();
?>

<div class="container-fluid">
	<div class="row-gutters">
		<?php
            $class = $insClass->get_class_controller();
        ?>
		<div class="col-5 col-sm-12 p-0">
            <div class="info-stats4">
                <img src="assets/img/japon2.png" alt="image" style="width: 100%;">
            </div>
        </div>

		<div class="col-16 col-m-6 col-sm-">
			<div class="card">
				<div class="card-content">

					<div class="header-class">
						<h1 class="title">Asistentes confirmados</h1>

						</div>

					</div>
					
					<?php
						$pageNumber = 1;

						if (isset($_GET)) {
							$pages = explode("/", $_GET['page']);
							if (count($pages) >= 3) {
								$p = intval($pages[2]);
								if ($p > 1) {
									$pageNumber = $p;
								}
							}
						}

						echo $insInscription->pages_class_assistance_controller($class['idClass'], $pageNumber, 10, $_SESSION['role_sk'], $_SESSION['code_sk']);
					?>

				</div>
				
			</div>
		</div>

	
		

	</div>

</div>