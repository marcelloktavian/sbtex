<div class="page-inner">
	<div class="page-header">
		<h4 class="page-title">Input KG</h4>
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
				<a href="#">Input KG</a>
			</li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title">Form Input KG</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-md-12 col-lg-12">
							<?php $other = explode(';', $_GET['other']); ?>
								<label><strong><?php echo 'KP('.$_GET['kp'].')'; ?></strong></label>
								<label><strong><?php echo $other[0].'('.$other[2].') &nbsp;'.$other[1]; ?></strong></label>
								&nbsp;|&nbsp;<label id="jmlkg" for="jmlkg"></label>
							<div class="form-group">
								<div class="input-group">
									<!-- <input type="text" class="form-control" name="idwo" id="idwo" placeholder="ID WO" maxlength="12"> -->
									<div class="input-group-prepend">
										<!-- <button class="btn btn-info" type="button" name="cari" id="cari" onclick="cari()">Cari</button> -->
									</div>
									<div class="input-group-prepend">
										<button class="btn btn-danger" type="button" name="post" id="post" onclick="post()">Post</button>
										<button class="btn btn-secondary" type="button" name="lihat" id="lihat" data-toggle="modal" data-target="#exampleModalLong">Lihat daftar KP</button>
									</div>
								</div>
								
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

<!-- modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Lihat data KP</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-responsive fixed-table-body tabel-partai"></table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- endmodal -->
<script>
$(document).ready(function () {
	var idwo = '<?php echo $_GET['idwo'] ?>';
	var id = '<?php echo $_GET['id'] ?>'.split(';');
	// console.log(id[2]);
	check(idwo);
	insertStatus(idwo,id[2]);
	create_tabel(idwo,id[2]);
	$.ajax({
			type: "POST",
			url: "pages/pemeteraian/list_wo.php",
			data: "",
			dataType: "text",
			success: function (response) {
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
					var roll = data[i]['qtysum'];
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
					if(status == "on"){
						conn="(!) ";
					}

					if(state_po == '1'){
						connPO='(PO!)';
					}
					html += '<tr>'
					html += '<td>'+connPO+conn+cust+'</td>';
					html += '<td><strong>'+kode+'</strong></td>'
					html += '<td>'+tanggal+'</td>';
					html += '<td>'+warna+'('+kwarna+')'+'</td>';
					html += '<td>'+grey+'</td>';
					html += '<td>'+roll+'</td></tr>';
					html += '<td>'+setting+'</td></td>';
					no++;
				}
				$('.tabel-partai').html(html);
			}
		});
});

function checkvalue(){
	var num = 0.0;
	html="";
	$('.kg').each(function()
	{
		num += parseFloat($(this).val());
	});
	html += "<strong>KG "+num.toFixed(2)+"</strong>";
	$("#jmlkg").html(html);
};

	function check(idwo){
		$.ajax({
			type: "POST",
			url: "pages/pemeteraian/check_status.php",
			data: {idwo : idwo},
			dataType: "text",
			success: function (result) {
				var fix_Result = JSON.parse(result);
				
				if (fix_Result == "on"){
					window.swal({
						icon: 'error',
						title: 'Pemberitahuan',
						text: 'KP Sedang Dikerjakan \n Silahkan Kembali Ke Menu Pemartaian'
					});
				}
			}
		});
	}

	function insertStatus(idwo,idso){
		$.ajax({
			type: "POST",
			url: "pages/pemeteraian/insert_status.php",
			data: {idwo:idwo,so:idso},
			dataType: "text",
			success: function (response) {
				
			}
		});
	}

	$('#idwo').click(function() {
		$('#idwo').val('');	
	});

	function create_tabel(idwo,idso){
		$.ajax({
			type: 'POST',
			url: 'pages/pemeteraian/fetch.php',
			data: { wo: idwo ,so:idso},
			dataType :"text",
			success: function(response) {
				var html = '';
				html += '<thead><tr><th>NO</th>';
				html += '<th width="80%">KG</th>';
				html += '<th width="5%">Seq</th>';
				html += '<th width="10%">Setting</th></tr>';
				html += '</thead><tbody>';

				var no = 1;
				var datanya = JSON.parse(response);
				for (var i = 0; i < datanya.length; i++) {
					var seq = datanya[i]['seq'];
					var roll = datanya[i]['qty'];
					var setting = datanya[i]['setting'];
					
					for (var j = 0; j < roll; j++) {
						html += '<tr><td>'+no+'</td>';
						html += '<td contenteditable="false" class=""><input type="number" class="kg" onkeyup="javascript:checkvalue();" style="width:95px;" /></td>';
						html += '<td class="seq">'+seq+'</td>';
						html += '<td class="setting">'+setting+'</td></tr>';
						no++;
					}
				}
				// console.log(html);
				$('#tblwo').html(html);
			}
		});

	}


	function post() {
		var id = '<?php echo $_GET['idwo'] ?>';
		var other = '<?php echo $_GET['id'] ?>';
		var jml = id.length;
		// buat button disable jika di klik disini
		$("#post").prop('disabled',true);
		if (jml < 12 || jml > 12) {
			window.swal({
				icon: 'error',
				title: 'Pemberitahuan',
				text: 'Cek Ulang ID WO'
			});
			$("#post").prop('disabled',false);
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
						if ($(this).val().trim()=='') {
							kosong = 1;
						}
					});

					//jika id wo ditemukan
					if (jml==1) {
						//jika ada kg yang kosong
						if (kosong==0) {
									window.swal({
										title: "Proses Posting...",
										text: "Tunggu Sampai Selesai",
										imageUrl: "resources/assets/images/ajaxloader.gif",
										showConfirmButton: false,
										allowOutsideClick: false
									});

									var kg = [];
									var seq = [];
									var setting = [];

									$('.kg').each(function(){
										kg.push($(this).val());
									});

									$('.seq').each(function(){
										seq.push($(this).text());
									});

									$('.setting').each(function(){
										setting.push($(this).text());
									});

									$.ajax({
										url: "pages/pemeteraian/posting.php",
										type: "POST",
										data: {
											idwo: id,
											kg: kg,
											seq: seq,
											setting: setting,
											other:other
										},
										cache: false,
										success: function (res) {
											$("#post").prop('disabled',true);
											window.swal({
												title: "Selesai!",
												showConfirmButton: false,
												timer: 1000
											});
										location.replace("index.php?page=pemeteraian");
									}
								});
						} else {
							window.swal({
								icon: 'error',
								title: 'Pemberitahuan',
								text: 'KG Tidak Boleh Kosong'
							});
							$("#post").prop('disabled',true);
						}
					} else {
						var html = '';
						$('#tblwo').html('');
						window.swal({
							icon: 'error',
							title: 'Pemberitahuan',
							text: 'ID WO Tidak Ditemukan'
						});
						$("#post").prop('disabled',true);
					}
					$('#untukkode').html(html);

				}
			});
		}
	}	
</script>