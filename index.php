<!DOCTYPE html>
<html lang="en">
<head>
	<title>SetiaBusana Application</title>
	
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

	<!-- Fonts and icons -->
	<link rel="stylesheet" href="resources/assets/css/fonts.css">
	<script src="resources/assets/plugins/webfont/webfont.min.js"></script>
	<script>
		// WebFont.load({
		// 	google: {"families":["Lato:300,400,700,900"]},
		// 	custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['resources/assets/css/fonts.min.css']},
		// 	active: function() {
		// 		sessionStorage.fonts = true;
		// 	}
		// });
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="resources/assets/plugins/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="resources/assets/plugins/jquery-ui/jquery-ui.min.css">
	<link rel="stylesheet" href="resources/assets/css/atlantis.min.css">

	<!--   Core JS Files   -->
	<script src="resources/assets/plugins/jQuery_v1.11.2/jquery.min.js"></script>
	<script src="resources/assets/js/core/popper.min.js"></script>
	<script src="resources/assets/js/core/bootstrap.min.js"></script>

	<!-- jQuery UI -->
	<script src="resources/assets/plugins/jquery-ui/jquery-ui.js"></script>

	<!-- jQuery Scrollbar -->
	<script src="resources/assets/plugins/jquery-scrollbar/jquery.scrollbar.min.js"></script>

	<!-- jQuery Sparkline -->
	<script src="resources/assets/plugins/jquery.sparkline/jquery.sparkline.min.js"></script>

	<!-- Bootstrap Notify -->
	<script src="resources/assets/plugins/bootstrap-notify/bootstrap-notify.min.js"></script>

	<!-- Bootstrap Select -->
	<script src="resources/assets/plugins/bootstrap-select/js/bootstrap-select.min.js"></script>

	<!-- JS -->
	<script src="resources/assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
	<script src="resources/assets/js/atlantis.min.js"></script>
	<script src="resources/assets/plugins/jquery-redirect/jquery.redirect.js"></script>

</head>
<body>
	<div class="wrapper">

		<!-- Header -->
		<div class="main-header">
			<?php
			include "header.php";
			?>
		</div>
		<!-- End Header -->


		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">			
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<ul class="nav nav-primary">

						<!-- Beranda -->
						<li class="nav-item <?php if(!isset($_GET['page']))echo "active"; ?>">
							<a href="index.php">
								<i class="fas fa-home"></i>
								<p>Beranda</p>
							</a>
						</li>

						<li class="nav-section">
							<span class="sidebar-mini-icon">
								<i class="fa fa-ellipsis-h"></i>
							</span>
							<h4 class="text-section">Menus</h4>
						</li>

						<!-- Pengiriman -->
						<li class="nav-item <?php if(isset($_GET['page']) && $_GET['page']=='pengiriman')echo "active"; ?>">
							<a href="index.php?page=pengiriman">
								<i class="fas fa-truck"></i>
								<p>Pengiriman</p>
							</a>
						</li>

						<!-- Pemeteraian -->
						<li class="nav-item <?php if(isset($_GET['page']) && $_GET['page']=='pemeteraian')echo "active"; ?>">
							<a href="index.php?page=pemeteraian">
								<i class="fas fa-file"></i>
								<p>Pemeteraian</p>
							</a>
						</li>

					</ul>
				</div>
			</div>
		</div>
		<!-- Sidebar --> 


		<!-- Main Content -->
		<div class="main-panel">
			<div class="content">
				<?php
				if (isset($_GET['page'])) {
					$page = $_GET['page'];
					if ($page == 'pengiriman') {
						//Menu Pengiriman
						include 'pages/pengiriman/pengiriman.php';
					} else if($page == 'pemeteraian'){
						//Menu Pemeteraian
						include 'pages/pemeteraian/pemeteraian.php';
					}
				}else{
					include 'home.php';
				}
				?>
			</div>
		</div>
		<!-- End Main Content -->

	</div>
</body>
</html>