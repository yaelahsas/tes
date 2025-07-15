<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('dist/_partials/header');
?>
<!-- Main Content -->
<div class="main-content">
	<section class="section">
		<div class="section-header">
			<h1>Data Artikel</h1>
			<div class="section-header-breadcrumb">
				<div class="breadcrumb-item">Data Artikel</div>
			</div>
		</div>

		<div class="section-body">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h4>Data Artikel</h4>
							<div>
								<?php echo anchor(site_url('Artikel/create'), 'Create', 'class="btn btn-primary"'); ?>
								<button type="button" class="btn btn-success" data-toggle="modal" data-target="#batchGenerateModal">
									Generate Batch AI
								</button>
							</div>
						</div>
						<div class="card-body">
							<?= $this->session->flashdata('message'); ?>
							<div class="table-responsive">
								<table class="table table-striped" id="artikel" style="overflow-x:auto;">
									<thead>
										<tr>
											<th width="80px">No</th>
											<th>Judul</th>
											<th>Kategori</th>
											<th>Status</th>
											<th width="200px">Action</th>
										</tr>
									</thead>

								</table>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</section>
</div>

<!-- Modal Generate Batch AI -->
<div class="modal fade" id="batchGenerateModal" tabindex="-1" role="dialog" aria-labelledby="batchGenerateModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="batchGenerateModalLabel">Generate Batch Artikel AI</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<form id="batchGenerateForm">
					<div class="form-group">
						<label for="jumlahArtikel">Jumlah Artikel yang ingin digenerate:</label>
						<input type="number" class="form-control" id="jumlahArtikel" name="jumlahArtikel" min="1" max="10" value="3" required>
						<small class="form-text text-muted">Maksimal 10 artikel per batch</small>
					</div>
					<div class="form-group">
						<label for="kategoriArtikel">Kategori:</label>
						<select class="form-control" id="kategoriArtikel" name="kategoriArtikel" required>
							<option value="">--Pilih Kategori--</option>
							<?php 
							$this->load->model('Kategori_model');
							$categories = $this->Kategori_model->get_all();
							foreach ($categories as $cat) { ?>
								<option value="<?= $cat->id ?>"><?= $cat->nama ?></option>
							<?php } ?>
						</select>
					</div>
				</form>
				
				<!-- Progress Section -->
				<div id="progressSection" style="display: none;">
					<div class="progress mb-3">
						<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" 
							 style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="progressBar">
							0%
						</div>
					</div>
					<div id="progressText">Memulai generate artikel...</div>
					<div id="progressLog" class="mt-3" style="max-height: 200px; overflow-y: auto; background: #f8f9fa; padding: 10px; border-radius: 5px;">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal" id="closeBtn">Tutup</button>
				<button type="button" class="btn btn-primary" id="startGenerateBtn">Mulai Generate</button>
				<button type="button" class="btn btn-danger" id="stopGenerateBtn" style="display: none;">Stop</button>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function() {
	let isGenerating = false;
	let currentIndex = 0;
	let totalArticles = 0;
	
	$('#startGenerateBtn').click(function() {
		const jumlah = parseInt($('#jumlahArtikel').val());
		const kategori = $('#kategoriArtikel').val();
		
		if (!kategori) {
			alert('Pilih kategori terlebih dahulu!');
			return;
		}
		
		if (jumlah < 1 || jumlah > 10) {
			alert('Jumlah artikel harus antara 1-10!');
			return;
		}
		
		startBatchGenerate(jumlah, kategori);
	});
	
	$('#stopGenerateBtn').click(function() {
		isGenerating = false;
		$('#startGenerateBtn').show();
		$('#stopGenerateBtn').hide();
		$('#closeBtn').prop('disabled', false);
		addLog('❌ Proses dihentikan oleh user');
	});
	
	function startBatchGenerate(jumlah, kategori) {
		isGenerating = true;
		currentIndex = 0;
		totalArticles = jumlah;
		
		// Show progress section and hide form
		$('#batchGenerateForm').hide();
		$('#progressSection').show();
		$('#startGenerateBtn').hide();
		$('#stopGenerateBtn').show();
		$('#closeBtn').prop('disabled', true);
		
		// Reset progress
		updateProgress(0);
		$('#progressLog').html('');
		
		addLog('🚀 Memulai generate ' + jumlah + ' artikel...');
		
		generateNextArticle(kategori);
	}
	
	function generateNextArticle(kategori) {
		if (!isGenerating || currentIndex >= totalArticles) {
			// Selesai
			isGenerating = false;
			$('#startGenerateBtn').show();
			$('#stopGenerateBtn').hide();
			$('#closeBtn').prop('disabled', false);
			addLog('✅ Semua artikel berhasil digenerate!');
			
			// Reload datatable
			setTimeout(function() {
				location.reload();
			}, 2000);
			return;
		}
		
		currentIndex++;
		const progress = Math.round((currentIndex / totalArticles) * 100);
		updateProgress(progress);
		
		addLog('📝 Generate artikel ke-' + currentIndex + '...');
		
		// Generate artikel
		$.ajax({
			url: '<?= site_url('Artikel/generate_batch_article') ?>',
			type: 'POST',
			data: { kategori: kategori },
			dataType: 'json',
			success: function(response) {
				if (response.error) {
					addLog('❌ Error artikel ke-' + currentIndex + ': ' + response.error);
				} else {
					addLog('✅ Artikel ke-' + currentIndex + ' berhasil: "' + response.judul + '"');
				}
				
				// Jeda 5 detik sebelum artikel berikutnya
				if (isGenerating && currentIndex < totalArticles) {
					addLog('⏳ Menunggu 5 detik...');
					setTimeout(function() {
						generateNextArticle(kategori);
					}, 5000);
				} else {
					generateNextArticle(kategori);
				}
			},
			error: function() {
				addLog('❌ Error network artikel ke-' + currentIndex);
				// Lanjut ke artikel berikutnya meski error
				setTimeout(function() {
					generateNextArticle(kategori);
				}, 5000);
			}
		});
	}
	
	function updateProgress(percent) {
		$('#progressBar').css('width', percent + '%').attr('aria-valuenow', percent).text(percent + '%');
		$('#progressText').text('Progress: ' + currentIndex + '/' + totalArticles + ' artikel (' + percent + '%)');
	}
	
	function addLog(message) {
		const timestamp = new Date().toLocaleTimeString();
		$('#progressLog').append('<div>[' + timestamp + '] ' + message + '</div>');
		$('#progressLog').scrollTop($('#progressLog')[0].scrollHeight);
	}
	
	// Reset modal when closed
	$('#batchGenerateModal').on('hidden.bs.modal', function() {
		if (!isGenerating) {
			$('#batchGenerateForm').show();
			$('#progressSection').hide();
			$('#startGenerateBtn').show();
			$('#stopGenerateBtn').hide();
			$('#closeBtn').prop('disabled', false);
		}
	});
});
</script>

<?php $this->load->view('dist/_partials/footer'); ?>
