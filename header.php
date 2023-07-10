<!-- Logo Header -->
<div class="logo-header" data-background-color="blue">

	<a href="index.php" class="logo">
		<b alt="navbar brand" class="navbar-brand" style="color: white;">SetiaBusana</b>
	</a>
	<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon">
			<i class="icon-menu"></i>
		</span>
	</button>
	<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
	<div class="nav-toggle">
		<button class="btn btn-toggle toggle-sidebar">
			<i class="icon-menu"></i>
			<a class="nav-link" href="#" role="button" id="refresh">
					<i class="fas fa-sync-alt"></i>
					<h7>Refresh</h7>
				</a>
		</button>
	</div>
</div>
<!-- End Logo Header -->

<!-- Navbar Header -->
<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">
	<div class="container-fluid">
		<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
			<li class="nav-item dropdown hidden-caret">
				<a class="nav-link" href="#" role="button" id="refresh">
					<i class="fas fa-sync-alt"></i>
					<h7>Refresh</h7>
				</a>
			</li>
		</ul>
	</div>
</nav>
<!-- End Navbar -->	

<script>
	$('#refresh').click(function() {
		window.location.reload();
	});

</script>