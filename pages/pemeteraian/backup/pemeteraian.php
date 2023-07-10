<div class="page-inner">
	<div class="page-header">
		<h4 class="page-title">Pemartaian</h4>
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
				<a href="#">Pemartaian</a>
			</li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title">Form Pemartaian</div>
				</div>
				<div class="card-body">
					<table class="table table-responsive fixed-table-body tabel-partai">
						<tr>
							<!-- <th>NO</th> -->
							<th>CUSTOMER</th>
							<th>KP</th>
							<th>TGL</th>
							<th>WARNA</th>
							<th>JENIS</th>
							<th>ROLL</th>
							<th>AKSI</th>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function(){
	ambil_listwo();
	setInterval(function(){
		ambil_listwo(); // this will run after every 5 seconds
	}, 5000);
});

	$('#idwo').click(function() {
		$('#idwo').val('');	
	});

	function ambil_listwo(){
		$.ajax({
			type: "POST",
			url: "pages/pemeteraian/list_wo.php",
			data: "",
			dataType: "text",
			success: function (response) {
				// console.log(response);
				var html = "";
				var data = JSON.parse(response);
				var no = 1;
				for (var i = 0; i < data.length; i++) {
					var kode = data[i]['no_kp'];
					var idwo = data[i]['id_wo'];
					var cust = data[i]['customer'];
					var kwarna = data[i]['kodewarna'];
					var grey = data[i]['grey'];
					var warna = data[i]['warna'];
					var roll = data[i]['qty'];
					var status = data[i]['status'];
					var tanggal = data[i]['tgl_trans'];
					var idjw = data[i]['id_jw'];
					var idcust = data[i]['id_cust'];
					var idso = data[i]['id_so'];
					var idjp = data[i]['id_jpo'];
					var idgrey = data[i]['id_grey'];
					var state_po = data[i]['state_po'];
					var setting = data[i]['setting'];
					var conn = "";
					var connPO = "";
					// console.log(status);
					if(status == "on"){
						conn="(!) ";
					}

					if(state_po == '1'){
						connPO='(PO!)';
					}

					// console.log(conn);
					// html += '<tr><td>'+no+'</td>';
					html += '<tr><td><a class="btn btn-default" href="index.php?page=posting&idwo='+idwo+'&kp='+kode+'&id='+idjw+';'+idcust+';'+idso+';'+idjp+';'+idgrey+'&other='+warna+';'+cust+';'+kwarna+';'+tanggal+';'+grey+roll+'">Partai</a></td>';
					html += '<td>'+connPO+conn+cust+'</td>';
					html += '<td><strong>'+kode+'</strong></td>'
					html += '<td>'+tanggal+'</td>';
					html += '<td>'+warna+'('+kwarna+')'+'</td>';
					html += '<td>'+grey+'</td>';
					html += '<td>'+roll+'</td></td>';
					html += '<td>'+setting+'</td></td>';
					// html += '<td><a class="btn btn-default" href="index.php?page=posting&idwo='+idwo+'&kp='+kode+'">Partai</a></td></tr>';
					no++;
				}
				$('.tabel-partai > tbody:last-child').html(html);
			}
		});
	}

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
					var roll = datanya[i]['qty'];
					
					for (var j = 0; j < roll; j++) {
						html += '<tr><td contenteditable="true" class="kg"></td>';
						html += '<td class="seq">'+seq+'</td></tr>';
					}
				}
				$('#tblwo').html(html);
			}
		});

	}

	function cari() {
		var id = $('#idwo').val();
		var jml = id.length;

		if (jml < 12 || jml > 12) {
			window.swal({
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
						var html = '<h2>KP:'+datanya[0]['kode']+'</h2>';
						create_tabel(id);
					} else {
						var html = '';
						$('#tblwo').html('');
						window.swal({
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
			window.swal({
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
					var kosong = 0;

					//validasi jika ada kg kosong
					$('.kg').each(function(){
						if ($(this).text().trim()=='') {
							kosong = 1;
						}
					});

					//jika id wo ditemukan
					if (jml==1) {
						//jika ada kg yang kosong
						if (kosong==0) {
							// window.swal({
							// 	title: 'Pemberitahuan',
							// 	text: "Apakah Ingin Memposting?",
							// 	icon: 'warning',
							// 	showCancelButton: true,
							// 	confirmButtonColor: '#3085d6',
							// 	cancelButtonColor: '#d33',
							// 	confirmButtonText: 'Posting'
							// }).then((result) => {
							// 	if (result.isConfirmed) {
									window.swal({
										title: "Proses Posting...",
										text: "Tunggu Sampai Selesai",
										imageUrl: "resources/assets/images/ajaxloader.gif",
										showConfirmButton: false,
										allowOutsideClick: false
									});

									var kg = [];
									var seq = [];

									$('.kg').each(function(){
										kg.push($(this).text());
									});

									$('.seq').each(function(){
										seq.push($(this).text());
									});

									$.ajax({
										url: "pages/pemeteraian/posting.php",
										type: "POST",
										data: {
											idwo: id,
											kg: kg,
											seq: seq
										},
										cache: false,
										success: function (res) {
											window.swal({
												title: "Selesai!",
												showConfirmButton: false,
												timer: 1000
											});
										// location.reload();
									}
								});
						// 	}
						// })
						} else {
							window.swal({
								icon: 'error',
								title: 'Pemberitahuan',
								text: 'KG Tidak Boleh Kosong'
							})
						}
					} else {
						var html = '';
						$('#tblwo').html('');
						window.swal({
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