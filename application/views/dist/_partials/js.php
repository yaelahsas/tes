<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>
<!-- General JS Scripts -->



<!-- JS Libraies -->
<?php
if ($this->uri->segment(1) == "" || $this->uri->segment(1) == "Dashboard") { ?>
	<script src="<?php echo base_url(); ?>assets/modules/jquery.sparkline.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/modules/chart.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.js"></script>
	<script src="<?php echo base_url(); ?>assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>

<?php
} elseif ($this->uri->segment(1) == "User") { ?>

	<script type="text/javascript">
		$(document).ready(function() {
			$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
				return {
					"iStart": oSettings._iDisplayStart,
					"iEnd": oSettings.fnDisplayEnd(),
					"iLength": oSettings._iDisplayLength,
					"iTotal": oSettings.fnRecordsTotal(),
					"iFilteredTotal": oSettings.fnRecordsDisplay(),
					"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
					"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
				};
			};

			var t = $("#mytable").dataTable({
				initComplete: function() {
					var api = this.api();
					$('#mytable_filter input')
						.off('.DT')
						.on('keyup.DT', function(e) {
							if (e.keyCode == 13) {
								api.search(this.value).draw();
							}
						});
				},
				oLanguage: {
					sProcessing: "loading..."
				},
				processing: true,
				serverSide: true,
				ajax: {
					"url": "user/json",
					"type": "POST"
				},
				columns: [{
						"data": "id",
						"orderable": false
					}, {
						"data": "username"
					}, {
						"data": "name"
					}, {
						"data": "level"
					},
					{
						"data": "action",
						"orderable": false,
						"className": "text-center"
					}
				],

				columnDefs: [{
					targets: [3],
					render: function(data, type, row) {
						switch (data) {
							case '1':
								return 'Admin';
								break;
							case '2':
								return 'Gudang';
								break;
							default:
								return '';
						}
					}
				}],
				order: [
					[0, 'asc']
				],
				rowCallback: function(row, data, iDisplayIndex) {
					var info = this.fnPagingInfo();
					var page = info.iPage;
					var length = info.iLength;
					var index = page * length + (iDisplayIndex + 1);
					$('td:eq(0)', row).html(index);
				}
			});
		});
	</script>

<?php
} elseif ($this->uri->segment(1) == "Kategori") { ?>

	<script type="text/javascript">
		$('#myModal').on('shown.bs.modal', function() {
			$('#myInput').trigger('focus')
		});
		$(document).ready(function() {
			$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
				return {
					"iStart": oSettings._iDisplayStart,
					"iEnd": oSettings.fnDisplayEnd(),
					"iLength": oSettings._iDisplayLength,
					"iTotal": oSettings.fnRecordsTotal(),
					"iFilteredTotal": oSettings.fnRecordsDisplay(),
					"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
					"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
				};
			};

			var t = $("#satuan").dataTable({
				initComplete: function() {
					var api = this.api();
					$('#satuan_filter input')
						.off('.DT')
						.on('keyup.DT', function(e) {
							if (e.keyCode == 13) {
								api.search(this.value).draw();
							}
						});
				},
				oLanguage: {
					sProcessing: "loading..."
				},
				processing: true,
				serverSide: true,
				ajax: {
					"url": "Kategori/json",
					"type": "POST"
				},
				columns: [{
						"data": "id",
						"orderable": false
					}, {
						"data": "nama",
						"className": "text-center"
					},
					{
						"data": "action",
						"orderable": false,
						"className": "text-center"

					}
				],
				order: [
					[0, 'asc']
				],
				rowCallback: function(row, data, iDisplayIndex) {
					var info = this.fnPagingInfo();
					var page = info.iPage;
					var length = info.iLength;
					var index = page * length + (iDisplayIndex + 1);
					$('td:eq(0)', row).html(index);
				}
			});
		});
	</script>

<?php
} elseif ($this->uri->segment(1) == "Artikel") { ?>

	<script type="text/javascript">
		$(document).ready(function() {
			$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
				return {
					"iStart": oSettings._iDisplayStart,
					"iEnd": oSettings.fnDisplayEnd(),
					"iLength": oSettings._iDisplayLength,
					"iTotal": oSettings.fnRecordsTotal(),
					"iFilteredTotal": oSettings.fnRecordsDisplay(),
					"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
					"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
				};
			};

			var t = $("#artikel").dataTable({
				initComplete: function() {
					var api = this.api();
					$('#artikel_filter input')
						.off('.DT')
						.on('keyup.DT', function(e) {
							if (e.keyCode == 13) {
								api.search(this.value).draw();
							}
						});
				},
				oLanguage: {
					sProcessing: "loading..."
				},
				processing: true,
				serverSide: true,
				ajax: {
					"url": "artikel/json",
					"type": "POST"
				},
				columns: [{
						"data": "id",
						"orderable": false
					}, {
						"data": "judul"
					}, {
						"data": "kategori"
					},
					{
						"data": "action",
						"orderable": false,
						"className": "text-center"

					}
				],
				order: [
					[0, 'desc']
				],
				rowCallback: function(row, data, iDisplayIndex) {
					var info = this.fnPagingInfo();
					var page = info.iPage;
					var length = info.iLength;
					var index = page * length + (iDisplayIndex + 1);
					$('td:eq(0)', row).html(index);
				}
			});
		});
	</script>
<?php
} elseif ($this->uri->segment(1) == "Poli") { ?>

	<script type="text/javascript">
		$(document).ready(function() {
			$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
				return {
					"iStart": oSettings._iDisplayStart,
					"iEnd": oSettings.fnDisplayEnd(),
					"iLength": oSettings._iDisplayLength,
					"iTotal": oSettings.fnRecordsTotal(),
					"iFilteredTotal": oSettings.fnRecordsDisplay(),
					"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
					"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
				};
			};

			var t = $("#poli").dataTable({
				initComplete: function() {
					var api = this.api();
					$('#poli_filter input')
						.off('.DT')
						.on('keyup.DT', function(e) {
							if (e.keyCode == 13) {
								api.search(this.value).draw();
							}
						});
				},
				oLanguage: {
					sProcessing: "loading..."
				},
				processing: true,
				serverSide: true,
				ajax: {
					"url": "poli/json",
					"type": "POST"
				},
				columns: [{
						"data": "id",
						"orderable": false
					}, {
						"data": "nama_poli"
					}, {
						"data": "jam_buka"
					}, {
						"data": "jam_tutup"
					},
					{
						"data": "action",
						"orderable": false,
						"className": "text-center"

					}
				],
				order: [
					[0, 'desc']
				],
				rowCallback: function(row, data, iDisplayIndex) {
					var info = this.fnPagingInfo();
					var page = info.iPage;
					var length = info.iLength;
					var index = page * length + (iDisplayIndex + 1);
					$('td:eq(0)', row).html(index);
				}
			});
		});
	</script>
<?php
} elseif ($this->uri->segment(1) == "Dokter") { ?>

	<script type="text/javascript">
		$('#myModal').on('shown.bs.modal', function() {
			$('#myInput').trigger('focus')
		});
		$(document).ready(function() {
			$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
				return {
					"iStart": oSettings._iDisplayStart,
					"iEnd": oSettings.fnDisplayEnd(),
					"iLength": oSettings._iDisplayLength,
					"iTotal": oSettings.fnRecordsTotal(),
					"iFilteredTotal": oSettings.fnRecordsDisplay(),
					"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
					"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
				};
			};

			var t = $("#dokter").dataTable({
				initComplete: function() {
					var api = this.api();
					$('#dokter_filter input')
						.off('.DT')
						.on('keyup.DT', function(e) {
							if (e.keyCode == 13) {
								api.search(this.value).draw();
							}
						});
				},
				oLanguage: {
					sProcessing: "loading..."
				},
				processing: true,
				serverSide: true,
				ajax: {
					"url": "Dokter/json",
					"type": "POST"
				},

				columns: [{
						"data": "id",
						"orderable": false
					}, {
						"data": "nama",
						"className": "text-center"
					},
					{
						"data": "img",
						"render": function(data) {
							return '<img src="gambar/dokter/' + data + '" width="100px">';
						}
					},
					{
						"data": "action",
						"orderable": false,
						"className": "text-center"

					}
				],
				order: [
					[0, 'asc']
				],
				rowCallback: function(row, data, iDisplayIndex) {
					var info = this.fnPagingInfo();
					var page = info.iPage;
					var length = info.iLength;
					var index = page * length + (iDisplayIndex + 1);
					$('td:eq(0)', row).html(index);
				}
			});
		});
	</script>
<?php
} elseif ($this->uri->segment(1) == "Layanan") { ?>

	<script type="text/javascript">
		$('#myModal').on('shown.bs.modal', function() {
			$('#myInput').trigger('focus')
		});
		$(document).ready(function() {
			$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
				return {
					"iStart": oSettings._iDisplayStart,
					"iEnd": oSettings.fnDisplayEnd(),
					"iLength": oSettings._iDisplayLength,
					"iTotal": oSettings.fnRecordsTotal(),
					"iFilteredTotal": oSettings.fnRecordsDisplay(),
					"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
					"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
				};
			};

			var t = $("#layanan").dataTable({
				initComplete: function() {
					var api = this.api();
					$('#layanan_filter input')
						.off('.DT')
						.on('keyup.DT', function(e) {
							if (e.keyCode == 13) {
								api.search(this.value).draw();
							}
						});
				},
				oLanguage: {
					sProcessing: "loading..."
				},
				processing: true,
				serverSide: true,
				ajax: {
					"url": "Layanan/json",
					"type": "POST"
				},

				columns: [{
						"data": "id",
						"orderable": false
					}, {
						"data": "judul",
						"className": "text-center"
					},
					{
						"data": "img",
						"render": function(data) {
							return '<img src="gambar/Layanan/' + data + '" width="100px">';
						}
					},
					{
						"data": "action",
						"orderable": false,
						"className": "text-center"

					}
				],
				order: [
					[0, 'asc']
				],
				rowCallback: function(row, data, iDisplayIndex) {
					var info = this.fnPagingInfo();
					var page = info.iPage;
					var length = info.iLength;
					var index = page * length + (iDisplayIndex + 1);
					$('td:eq(0)', row).html(index);
				}
			});
		});
	</script>
<?php
} elseif ($this->uri->segment(1) == "Profil") { ?>

	<script type="text/javascript">
		$('#myModal').on('shown.bs.modal', function() {
			$('#myInput').trigger('focus')
		});
		$(document).ready(function() {
			$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
				return {
					"iStart": oSettings._iDisplayStart,
					"iEnd": oSettings.fnDisplayEnd(),
					"iLength": oSettings._iDisplayLength,
					"iTotal": oSettings.fnRecordsTotal(),
					"iFilteredTotal": oSettings.fnRecordsDisplay(),
					"iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
					"iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
				};
			};

			var t = $("#profil").dataTable({
				initComplete: function() {
					var api = this.api();
					$('#profil_filter input')
						.off('.DT')
						.on('keyup.DT', function(e) {
							if (e.keyCode == 13) {
								api.search(this.value).draw();
							}
						});
				},
				oLanguage: {
					sProcessing: "loading..."
				},
				processing: true,
				serverSide: true,
				ajax: {
					"url": "Profil/json",
					"type": "POST"
				},

				columns: [{
						"data": "id",
						"orderable": false

					},
					{
						"data": "img_profil",
						"render": function(data) {
							return '<img src="gambar/profil/' + data + '" width="100px">';
						}
					}, {
						"data": "is_active",
						"className": "text-center"
					},
					{
						"data": "action",
						"orderable": false,
						"className": "text-center"

					}
				],
				columnDefs: [{
					targets: [2],
					render: function(data, type, row) {
						switch (data) {
							case '1':
								return '<p class="text-dark bg-success"><b>Aktif</b></p>';
								break;
							case '2':
								return '<p class="text-dark bg-danger"><b>Tidak Aktif</b></p>';
								break;
							default:
								return '';
						}
					}
				}],
				order: [
					[0, 'asc']
				],
				rowCallback: function(row, data, iDisplayIndex) {
					var info = this.fnPagingInfo();
					var page = info.iPage;
					var length = info.iLength;
					var index = page * length + (iDisplayIndex + 1);
					$('td:eq(0)', row).html(index);
				}
			});
		});
	</script>
<?php
} ?>
<!-- Page Specific JS File -->
<?php
if ($this->uri->segment(1) == "" || $this->uri->segment(1) == "Dashboard") { ?>
	<script src="<?php echo base_url(); ?>assets/js/page/index.js"></script>
<?php
} elseif ($this->uri->segment(2) == "index_0") { ?>
	<script src="<?php echo base_url(); ?>assets/js/page/index-0.js"></script>

<?php
} ?>








</body>

</html>