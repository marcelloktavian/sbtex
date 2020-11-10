<div class="page-inner">
	<div class="page-header">
		<h4 class="page-title">Pemeteraian</h4>
		<ul class="breadcrumbs">
			<li class="nav-home">
				<a href="index.php">
					<i class="flaticon-home"></i>
				</a>
			</li>
			<li class="separator">
				<i class="flaticon-right-arrow"></i>
			</li>
			<li class="nav-item">
				<a href="#">Pemeteraian</a>
			</li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title">Form Pemeteraian</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12 col-lg-12">				
							<div class="form-group">
								<div class="input-group">
									<input type="text" class="form-control" name="idwo" id="idwo" placeholder="ID WO" maxlength="12">
									<div class="input-group-prepend">
										<button class="btn btn-info" type="button" name="cari" id="cari" onclick="cari()">Cari</button>
									</div>
									<div class="input-group-prepend">
										<button class="btn btn-danger" type="button" name="post" id="post" onclick="post()">Post</button>
									</div>
								</div>
								<label id="untukkode"></label>
							</div>
							<div class="table-responsive">
								<table id="tblwo" class="table table-bordered" width="100%"></table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$('#idwo').click(function() {
		$('#idwo').val('');	
	});

	function create_tabel(idwo){
		$.ajax({
			type: 'POST',
			url: 'pages/pemeteraian/fetch.php',
			data: { wo: idwo },
			dataType :"text",
			success: function(response) {
				var html = '';
				html += '<thead><tr><th width="80%">KG</th>';
				html += '<th width="20%">Seq</th></tr>';
				html += '</thead><tbody>';

				// var no = 1;
				var datanya = JSON.parse(response);
				for (var i = 0; i < datanya.length; i++) {
					var seq = datanya[i]['seq'];
					var roll = datanya[i]['roll'];
					
					for (var j = 0; j < roll; j++) {
						html += '<tr><td contenteditable="true" class="kg"></td>';
						html += '<td class="seq">'+seq+'</td></tr>';
						// no++;
					}
				}
				// console.log(html);
				$('#tblwo').html(html);
			}
		});

	}

	function cari() {
		var id = $('#idwo').val();
		var jml = id.length;

		if (jml < 12 || jml > 12) {
			Swal.fire({
				icon: 'error',
				title: 'Pemberitahuan',
				text: 'Cek Ulang ID WO'
			})
		} else {
			$.ajax({
				type: 'POST',
				url: 'pages/pemeteraian/ambil_wo.php',
				data: { wo: id },
				dataType :"text",
				success: function(response) {
					var datanya = JSON.parse(response);
					var jml = datanya[0]['jum'];

					if (jml==1) {
						var html = '<h2>'+datanya[0]['kode']+'</h2>';
						create_tabel(id);
					} else {
						var html = '';
						$('#tblwo').html('');
						Swal.fire({
							icon: 'error',
							title: 'Pemberitahuan',
							text: 'ID WO Tidak Ditemukan'
						})
					}
					$('#untukkode').html(html);

				}
			});
		}
	}

	$("#idwo").keydown(function(event) {
		if (event.keyCode === 13) {
			cari();
		}
	});

	function post() {
		var id = $('#idwo').val();
		var jml = id.length;

		if (jml < 12 || jml > 12) {
			Swal.fire({
				icon: 'error',
				title: 'Pemberitahuan',
				text: 'Cek Ulang ID WO'
			})
		} else {
			$.ajax({
				type: 'POST',
				url: 'pages/pemeteraian/ambil_wo.php',
				data: { wo: id },
				dataType :"text",
				success: function(response) {
					var datanya = JSON.parse(response);
					var jml = datanya[0]['jum'];

					if (jml==1) {
						Swal.fire({
							title: 'Pemberitahuan',
							text: "Apakah Ingin Memposting?",
							icon: 'warning',
							showCancelButton: true,
							confirmButtonColor: '#3085d6',
							cancelButtonColor: '#d33',
							confirmButtonText: 'Posting'
						}).then((result) => {
							if (result.isConfirmed) {
								var kg = [];
								var seq = [];
								$('.kg').each(function(){
									kg.push($(this).text());
								});
								$('.seq').each(function(){
									seq.push($(this).text());
								});

								console.log(kg);
							}
						})
					} else {
						var html = '';
						$('#tblwo').html('');
						Swal.fire({
							icon: 'error',
							title: 'Pemberitahuan',
							text: 'ID WO Tidak Ditemukan'
						})
					}
					$('#untukkode').html(html);

				}
			});
		}
	}	
</script>