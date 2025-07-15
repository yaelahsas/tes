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
					<div class="form-group">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" id="enableScheduling" name="enableScheduling">
							<label class="form-check-label" for="enableScheduling">
								Aktifkan penjadwalan otomatis (1 artikel per hari)
							</label>
						</div>
					</div>
					<div class="form-group" id="schedulingOptions" style="display: none;">
						<label for="startDate">Mulai publish dari tanggal:</label>
						<input type="date" class="form-control" id="startDate" name="startDate" value="<?= date('Y-m-d', strtotime('+1 day')) ?>">
						<small class="form-text text-muted">Artikel akan dipublish secara berurutan setiap hari mulai dari tanggal ini</small>
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
	let generatedArticleIds = []; // Array untuk menyimpan ID artikel yang digenerate
	
	// Toggle scheduling options
	$('#enableScheduling').change(function() {
		if ($(this).is(':checked')) {
			$('#schedulingOptions').show();
		} else {
			$('#schedulingOptions').hide();
		}
	});
	
	$('#startGenerateBtn').click(function() {
		const jumlah = parseInt($('#jumlahArtikel').val());
		const kategori = $('#kategoriArtikel').val();
		const enableScheduling = $('#enableScheduling').is(':checked');
		const startDate = $('#startDate').val();
		
		if (!kategori) {
			alert('Pilih kategori terlebih dahulu!');
			return;
		}
		
		if (jumlah < 1 || jumlah > 10) {
			alert('Jumlah artikel harus antara 1-10!');
			return;
		}
		
		if (enableScheduling && !startDate) {
			alert('Pilih tanggal mulai publish!');
			return;
		}
		
		startBatchGenerate(jumlah, kategori, enableScheduling, startDate);
	});
	
	$('#stopGenerateBtn').click(function() {
		isGenerating = false;
		$('#startGenerateBtn').show();
		$('#stopGenerateBtn').hide();
		$('#closeBtn').prop('disabled', false);
		addLog('❌ Proses dihentikan oleh user');
	});
	
	function startBatchGenerate(jumlah, kategori, enableScheduling, startDate) {
		isGenerating = true;
		currentIndex = 0;
		totalArticles = jumlah;
		generatedArticleIds = []; // Reset array
		
		// Show progress section and hide form
		$('#batchGenerateForm').hide();
		$('#progressSection').show();
		$('#startGenerateBtn').hide();
		$('#stopGenerateBtn').show();
		$('#closeBtn').prop('disabled', true);
		
		// Reset progress
		updateProgress(0);
		$('#progressLog').html('');
		
		if (enableScheduling) {
			addLog('🚀 Memulai generate ' + jumlah + ' artikel dengan penjadwalan otomatis...');
			addLog('📅 Artikel akan dipublish mulai tanggal: ' + startDate);
		} else {
			addLog('🚀 Memulai generate ' + jumlah + ' artikel...');
		}
		
		generateNextArticle(kategori, enableScheduling, startDate);
	}
	
	function generateNextArticle(kategori, enableScheduling, startDate) {
		if (!isGenerating || currentIndex >= totalArticles) {
			// Selesai generate, cek apakah perlu set scheduling
			if (enableScheduling && generatedArticleIds.length > 0) {
				addLog('📅 Setting jadwal publish untuk ' + generatedArticleIds.length + ' artikel...');
				setArticleSchedule(generatedArticleIds, startDate);
			} else {
				finishBatchGenerate();
			}
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
					if (response.artikel_id) {
						generatedArticleIds.push(response.artikel_id);
					}
				}
				
				// Jeda 5 detik sebelum artikel berikutnya
				if (isGenerating && currentIndex < totalArticles) {
					addLog('⏳ Menunggu 5 detik...');
					setTimeout(function() {
						generateNextArticle(kategori, enableScheduling, startDate);
					}, 5000);
				} else {
					generateNextArticle(kategori, enableScheduling, startDate);
				}
			},
			error: function() {
				addLog('❌ Error network artikel ke-' + currentIndex);
				// Lanjut ke artikel berikutnya meski error
				setTimeout(function() {
					generateNextArticle(kategori, enableScheduling, startDate);
				}, 5000);
			}
		});
	}

	function setArticleSchedule(articleIds, startDate) {
		$.ajax({
			url: '<?= site_url('Artikel/set_batch_schedule') ?>',
			type: 'POST',
			data: { 
				artikel_ids: articleIds,
				start_date: startDate
			},
			dataType: 'json',
			success: function(response) {
				if (response.error) {
					addLog('❌ Error setting schedule: ' + response.error);
				} else {
					addLog('✅ Jadwal publish berhasil diset!');
					addLog('📅 Artikel akan tayang otomatis setiap hari mulai ' + startDate);
				}
				finishBatchGenerate();
			},
			error: function() {
				addLog('❌ Error network saat setting schedule');
				finishBatchGenerate();
			}
		});
	}

	function finishBatchGenerate() {
		isGenerating = false;
		$('#startGenerateBtn').show();
		$('#stopGenerateBtn').hide();
		$('#closeBtn').prop('disabled', false);
		addLog('✅ Semua proses selesai!');
		
		// Reload datatable
		setTimeout(function() {
			location.reload();
		}, 2000);
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
