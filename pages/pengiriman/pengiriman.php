<div class="page-inner">
	<div class="page-header">
		<h4 class="page-title">Pengiriman</h4>
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
				<a href="#">Pengiriman</a>
			</li>
		</ul>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<div class="card-title">Form Pengiriman</div>
				</div>
				<div class="card-body">
					<div class="row">
						<div class="col-12">
							<div id="alertnull"></div>
						</div>
						<div class="col-12">
							<div id="countInfo"></div>
						</div>
						<div class="col-12">
							<div id="countSisa"></div>
						</div>
						<div class="alert alert-success alert-dismissible" id="success" style="display:none;">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
						</div>
						<div class="alert alert-danger alert-dismissible" id="error" style="display:none;">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
						</div>
						<div class="col-md-12 col-lg-12">				
							<div class="form-group">
								<div class="input-group">
									<input type="text" class="form-control" id="barcode" placeholder="BARCODE" name="barcode">
									<div class="input-group-prepend">
										<input type="button" name="save" class="btn btn-info" value="Simpan" id="butsave" name="butsave">
									</div>
									<div class="input-group-prepend">
										<input type="button" class="btn btn-danger" value="Post" id="butpost" name="butpost">
									</div>
								</div>
								<label id="untukkode"></label>
							</div>
							<br>
							<div class="table-responsive">
								<h3 align="center">BARCODE DATA</h3>
								<table class="table table-bordered table-striped" id="maintable">
									<tr>
										<th width="10%">BARCODE</th>
										<th width="20%">No.SO</th>
										<th width="20%">No.KP</th>
										<th width="40%">Pelanggan</th>
										<th width="10%">KG</th>
									</tr>
								</table>
							</div>						

							<div class="" id="inserted_item_data">
								<div class="valTotal">
								</div><br>
								<textarea class="tmptotalpost" name="" id="" cols="43" rows="5" readonly style="width: 100%;"></textarea><br>	
								<button class="btn btn-danger clearPostlist form-control"><svg width="1em" height="1em"
									viewBox="0 0 16 16" class="bi bi-trash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
									<path fill-rule="evenodd"
									d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5a.5.5 0 0 0-1 0v7a.5.5 0 0 0 1 0v-7z" />
								</svg> Hapus Data Telah Posting</button><br><br>
							</div>
							<div class="datasementara"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<script>
	$(document).ready(function(){
	// inisialisasi data
	var count = 1;
	var arrlist = [];
	var uniqueNames = [];
	var tmpClear = [];
	sum_info();
	sum_sisa();
	getarray();
	$("#barcode").focus();

	function makeid(length) {
		var result = '';
		var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		var charactersLength = characters.length;
		for (var i = 0; i < length; i++) {
			result += characters.charAt(Math.floor(Math.random() * charactersLength));
		}
		return result;
	}

	$(".clearPostlist").on('click',function(){
		Swal.fire({
			title: "Proses Clear...",
			text: "Tunggu Sampai Selesai",
			imageUrl: "resources/assets/images/ajaxloader.gif",
			showConfirmButton: false,
			allowOutsideClick: false
		});

		$.ajax({
			url: "pages/pengiriman/clearHistoryPost.php",
			type: "POST",
			data: {
				kodegroups: tmpClear,
			},
			cache: false,
			success: function (res) {
				$("#loader").hide();
				Swal.fire({
					title: "Selesai!",
					showConfirmButton: false,
					timer: 1000
				});
				location.reload();
			}
		});
	});

	$("#butpost").on('click', function () {
		Swal.fire({
			title: "Proses Posting...",
			text: "Tunggu Sampai Selesai",
			imageUrl: "resources/assets/images/ajaxloader.gif",
			showConfirmButton: false,
			allowOutsideClick: false
		});

		var list_barcode = [];
		$('.tmpdata').each(function () {
			list_barcode.push($(this).val());
		});
		$.ajax({
			url: "pages/pengiriman/posting.php",
			type: "POST",
			data: {
				id_group: makeid(10),
				status: 'N',
				barcode: list_barcode
			},
			cache: false,
			success: function (res) {
				fetch_item_data(1);
				sum_info();
				sum_sisa();
				$("#loader").hide();
				Swal.fire({
					title: "Selesai!",
					showConfirmButton: false,
					timer: 1000
				});
				location.reload();
			}
		});
	});

	function untukalert(isi) {
		var html = '<div class="alert alert-danger" role="alert">'+
		isi+'</div>';
		$('#alertnull').html(html);
	}

	function untukduplicate(barcode, names) {
		var a = '';
		if (names.length==0) {
			a = 'T';
		}
		for (var i = 0; i < names.length; i++) {
			if (barcode==names[i]) {
				a = 'Y';
				break;
			}else{
				a = 'T';
			}
		}
		if(a == 'Y'){
			untukalert('Barcode sudah ada');
		}else if(a=='T'){

			$('#barcode').val(function(){
				arrlist.push($(this).val());
			});
			$.each(arrlist, function(i, el){
				if($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
			});
			fetch_item_data(1);
			notfound(barcode);
		}
	}

	function notfound(barcode) {
		$.ajax({
			url:"pages/pengiriman/validasi.php",
			method:"POST",
			type: 'text',
			data:{
				barcode:barcode
			},
			success:function(data)
			{
				console.log(data);
				var test = data;
				if (test=='404') {
					// console.log('error');
					untukalert('Data Tidak Ditemukan!');
				}else if(test=='202'){
					untukalert('Data Pernah DiScan!');
				}else{
					var html_code = " <input class='tmpdata' type='text' value='" + barcode + "' style='width:60px;' readonly>";
					$('.datasementara').append(html_code);
				}
			}
		})
	}

	function save(barcode) {
		if (barcode == null || barcode == '') {
			untukalert('Barcode Tidak Boleh Kosong!');
		} else {
			$('#alertnull').html('');

			untukduplicate(barcode, uniqueNames);	

			console.log(uniqueNames);

			$("#butsave").removeAttr("disabled");
			$('#barcode').val('');

			sum_info();
			sum_sisa();

		}
	}

	$('#butsave').on('click', function () {
		$("#butsave").attr("disabled", "disabled");
		var barcode = $('#barcode').val();

		save(barcode);
	});

	$('#barcode').keydown(function (e) {
		if (e.keyCode == 13) {
			//alert('you pressed enter ^_^');
			//----------event click enter---------------
			$("#butsave").attr("disabled", "disabled");
			var barcode = $('#barcode').val();

			save(barcode);
			//----------end-------------
		}
	});

	function fetch_item_data(a){
		if(a == 1){
			$.ajax({
				url:"pages/pengiriman/fetch.php",
				method:"POST",
				data:{
					barcode:uniqueNames
				},
				success:function(data)
				{
					$('#maintable').append(data);
				}
			})
		}
	}

	function sum_info(){
		var rowCount = uniqueNames.length;	
		$('#countInfo').html("&nbsp;&nbsp;&nbsp;&nbsp;<strong>Total Semua :"+rowCount+"</strong>");
	}

	function sum_sisa(){
		var list_barcode = [];
		$('.tmpdata').each(function () {
			list_barcode.push($(this).val());
		});
		var lastVal = list_barcode.reverse();
		$.ajax({
			url: "pages/pengiriman/sum_sisa.php",
			method: "POST",
			data: {
				idkgdet: lastVal[0]
			},
			success: function (data) {
				$('#countSisa').html(data);
			}
		})
	}

	function getarray(){
		$.ajax({
			type: "ajax",
			url: "pages/pengiriman/getArray.php",
			dataType:"json",
			success: function (response){	
				$(".valTotal").html("Data Yang Sudah Di Posting Saat ini<strong>("+response[0].total+")</strong>");

				if(response[0].total == '0'){
					for (var i = 0; i < response.length; i++) {
						$(".tmptotalpost").val();
						tmpClear.push(response[i].groups);
					}
				}else{
					for (var i = 0; i < response.length; i++) {
						$(".tmptotalpost").append(response[i].count+'[KP'+response[i].kp+']'+'\n');
						tmpClear.push(response[i].groups);
					}
				}
			}
		});
	}
});
</script>