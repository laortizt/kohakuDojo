<?php
	//peticion ajax
	session_start();
	$petitionAjax=false;
?>

<!DOCTYPE html>
<html>
<head>
	<title>Kohaku</title>

	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
	<link rel="icon" type="image/png" href="<?php echo SERVERURL; ?>/assets/img/favicon/favicon.ico"/>
	<title><?php echo COMPANY; ?></title>
	<!-- Import lib -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo SERVERURL; ?>/assets/fontawesome-free - copia/css/all.min.css">

	<link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
	
	<!-- LINKS datatable -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">

	<!-- End import lib -->
    <link href="<?php echo SERVERURL; ?>assets/style/dashboard.css" rel="stylesheet">
	<link href="<?php echo SERVERURL; ?>assets/style/calendar.css" rel="stylesheet">
	<link href="<?php echo SERVERURL; ?>assets/style/schedule.css" rel="stylesheet">
	<link href="<?php echo SERVERURL; ?>assets/style/attendance.css" rel="stylesheet">
	<link href="<?php echo SERVERURL; ?>assets/style/privileges.css" rel="stylesheet">
	<link href="<?php echo SERVERURL; ?>assets/sweet-alert/sweetalert2.css" rel="stylesheet">
	<link href="<?php echo SERVERURL; ?>assets/glyphicons/glyphicons.css" rel="stylesheet">

	<?php include "views/modules/script.php"; ?>
</head>
<body class="overlay-scrollbar">

<?php
        //se incluye el archivo vista controlador
        require_once "./controller/viewsController.php";

        $noTemplateViews = ["forgot-password", "register"];
        //se instancia la vista controlado vistas o vt
        $vt = new viewsController();
        //queremos utilizar la funcion  obtener vista controlador
        //se crea una NUEVA variala $vtA para poder hacer el iclud de la variabl en el conenido SN ERROR
        $vtA=$vt->get_views_controller();
        // si vt trae el valor del login se muestra el login

        if(in_array($vtA, $noTemplateViews)):
            require_once "./views/pages/".$vtA.".php";
        elseif($vtA=="login"):
            //si no, me incluye todo el contenida de la página
            require_once "./views/pages/login-view.php";
        else:
            //iniciar sesión
            @session_start(['name'=>'SK']);
			@require_once"./controller/controllerLogin.php";
			//  se instancia la  funcion forzar sesión
			$lc = new controllerLogin();

			// si una de estas dos condiciones no viene definida el usuario no ha iniciado sesion bien 
			if(!isset($_SESSION['token_sk']) || !isset($_SESSION['email_sk'])){
				$lc->force_logout();
			}
    ?>
	<!-- navbar -->
	<div class="navbar">
		<!-- nav left -->
		<ul class="navbar-nav">
			<li class="nav-item">
				<a class="nav-link">
					<i class="fas fa-bars" onclick="collapseSidebar()"></i>
				</a>
			</li>
			<li class="nav-item">
				<img src="<?php echo SERVERURL; ?>assets/img/logokohaku.png" class="image-logo" alt="">
			</li>
		</ul>
		<!-- end nav left -->
		<!-- form -->
		<form class="navbar-search">
			<input type="text" name="Search" class="navbar-search-input" placeholder="What you looking for...">
			<i class="fas fa-search"></i>
		</form>
		<!-- end form -->
		<!-- nav right -->
		<ul class="navbar-nav nav-right">
			<li class="nav-item mode">
				<a class="nav-link" href="#" onclick="switchTheme()">
					<i class="fas fa-moon dark-icon"></i>
					<i class="fas fa-sun light-icon"></i>
				</a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link">
					<i class="fas fa-bell dropdown-toggle" data-toggle="notification-menu"></i>
					<span class="navbar-badge">15</span>
				</a>
				<ul id="notification-menu" class="dropdown-menu notification-menu">
					<div class="dropdown-menu-header">
						<span>
							Notifications
						</span>
					</div>
					<div class="dropdown-menu-content overlay-scrollbar scrollbar-hover">
						<li class="dropdown-menu-item">
							<a href="#" class="dropdown-menu-link">
								<div>
									<i class="fas fa-gift"></i>
								</div>
								<span>
									Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
									<br>
									<span>
										15/07/2020
									</span>
								</span>
							</a>
						</li>
						<li class="dropdown-menu-item">
							<a href="#" class="dropdown-menu-link">
								<div>
									<i class="fas fa-tasks"></i>
								</div>
								<span>
									Lorem ipsum dolor sit amet, consectetuer adipiscing elit.
									<br>
									<span>
										15/07/2020
									</span>
								</span>
							</a>
						</li>
						
					</div>
					<div class="dropdown-menu-footer">
						<span>
							View all notifications
						</span>
					</div>
				</ul>
			</li>
			<li class="nav-item avt-wrapper">
				<div class="avt dropdown">
					<img src="assets/img/undraw_profile.svg" alt="User image" class="dropdown-toggle" data-toggle="user-menu">
					<ul id="user-menu" class="dropdown-menu">
						<li  class="dropdown-menu-item">
							<a class="dropdown-menu-link">
								<div>
									<i class="fas fa-user-tie"></i>
								</div>
								<span>Profile</span>
							</a>
						</li>
						<li class="dropdown-menu-item">
							<a href="#" class="dropdown-menu-link">
								<div>
									<i class="fas fa-cog"></i>
								</div>
								<span>Settings</span>
							</a>
						</li>
						<li  class="dropdown-menu-item">
							<a href="#" class="dropdown-menu-link">
								<div>
									<i class="far fa-credit-card"></i>
								</div>
								<span>Payments</span>
							</a>
						</li>
						<li  class="dropdown-menu-item">
							<a href="#" class="dropdown-menu-link">
								<div>
									<i class="fas fa-spinner"></i>
								</div>
								<span>Projects</span>
							</a>
						</li>
						<li class="dropdown-menu-item">
							<a href="<?php echo $lc->encryption($_SESSION['token_sk']);?>" class="dropdown-menu-link btn-logout">
								<div>
									<i class="fas fa-sign-out-alt"></i>
								</div>
								<span>Logout</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
		</ul>
		<!-- end nav right -->
	</div>
	<!-- end navbar -->
	<!-- sidebar -->
	<div class="sidebar">
		<ul class="sidebar-nav">
			
			<li class="sidebar-nav-item">
				<a href="#" class="sidebar-nav-link active">
					<div>
					<i class="fas fa-key"></i>
					</div>
					<span>Admin</span>
				</a>
			</li>
			
			<li  class="sidebar-nav-item">
				<a href="<?php echo SERVERURL; ?>class.php" class="sidebar-nav-link">
					<div>
					<i class="far fa-calendar-alt"></i>
					</div>
					<span>clases</span>
				</a>
			</li>
			<li  class="sidebar-nav-item">
				<a href="#" class="sidebar-nav-link">
					<div>
					<i class="fas fa-cash-register"></i>
					</div>
					<span>Pagos</span>
				</a>
			</li>
			<li  class="sidebar-nav-item">
				<a href="#" class="sidebar-nav-link">
					<div>
						<i class="fas fa-check-circle"></i>
					</div>
					<span>Progreso</span>
				</a>
			</li>
			<li  class="sidebar-nav-item">
				<a href="#" class="sidebar-nav-link">
					<div>
					<i class="far fa-file-alt"></i>
					</div>
					<span>Trámites</span>
				</a>
			</li>
		</ul>
	</div>
	<!-- end sidebar -->
	
	<!-- main content -->
	<div class="wrapper">
 		<?php require_once $vtA; ?>
	</div>
	<!-- end main content -->
	<!-- import script -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	
	<script src="<?php echo SERVERURL; ?>assets/script/index.js"></script>

	<!-- end import script -->
	<?php 
	include  "./views/modules/logoutScript.php";
	endif; ?>
	
	<script>
	$material.init();
	</script>
</body>
<html>
