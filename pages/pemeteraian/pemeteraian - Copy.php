<div class="page-inner">
	<div class="row">
	<div align="left" class="col-sm"><div class="page-header">
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
	</div></div>
	<div align="right" class="col-sm"><button class="btn btn-info" data-toggle="modal" data-target="#modalKP"><i class="fa fa-plus"></i> KP Manual</button></div>
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

<!-- Modal -->
<div class="modal fade" id="modalKP" tabindex="-1" role="dialog" aria-labelledby="modalKPLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalKPLabel">Tambah KP Manual</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<!-- 1 -->
      	<div class="form-group row">
      		<label for="nokp" class="col-sm-2 col-form-label">No KP:</label>
      		<div class="col-sm-10">
      			<input class="form-control" type="number" name="nokp" id="nokp">
      		</div>
      	</div>
      	<!-- 2 -->
      	<div class="form-group row">
      		<label for="jmroll" class="col-sm-2 col-form-label">Jumlah Roll:</label>
      		<div class="col-sm-10">
      			<input class="form-control" type="number" name="jmroll" id="jmroll">
      		</div>
      	</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-info" onclick="addKP()">Tambah</button>
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
					html += '<tr><td><a class="btn btn-default" href="index.php?page=posting&idwo='+idwo+'&kp='+kode+'&id='+idjw+';'+idcust+';'+idso+';'+idjp+';'+idgrey+'&other='+warna+';'+cust+';'+kwarna+';'+tanggal+';'+grey+roll+';auto'+'">Partai</a></td>';
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

	function addKP(){
		var nokp= $("#nokp").val();
		var jmlroll=$("#jmroll").val();

		let pesan ="";
		if(nokp == ""){
			pesan="Nomer KP Wajib Di isi!";
		}

		if(jmlroll == ""){
			pesan="Jumlah Roll Wajib Di isi!";
		}

		if(pesan === ""){
			// PROSES
			// ajax for get data wo/kp
			$.ajax({
				type: "POST",
				url: "pages/pemeteraian/searchwo.php",
				data: {
					'kodewo':nokp,
				},
				success: function (response) {
					var data = JSON.parse(response);
					var no = 1;
					if(data.length > 0){
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
					}
					// direct to another page
			window.location='index.php?page=posting&idwo='+idwo+'&kp='+kode+'&id='+idjw+';'+idcust+';'+idso+';'+idjp+';'+idgrey+'&other='+warna+';'+cust+';'+kwarna+';'+tanggal+';'+grey+';'+jmlroll+';manual'+'';
				}else{
					window.swal({
						icon: 'error',
						title: 'Pemberitahuan',
						text: "KP Tidak Di temukan!"
					});
				}
			}
			});
		}else{
			window.swal({
				icon: 'error',
				title: 'Pemberitahuan',
				text: pesan
			});
		}

		$("#nokp").val('');
		$("#jmroll").val('');
	}
</script>