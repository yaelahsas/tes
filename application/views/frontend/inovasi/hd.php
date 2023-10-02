<style>
	.pdf-button {
		width: 250px;
		/* Set lebar semua tombol menjadi 500px */
		margin-bottom: 10px;
		/* Berikan sedikit margin antara tombol */
	}
</style>
<section class="breadcrumbs">

</section><!-- End Breadcrumbs Section -->
<section class="inner-page">
	<div class="container d-flex justify-content-center align-items-center">
		<div class="col-md-6">
			<h1 class="text-center">Kalkulator Cairan</h1>
			<form id="cairan-form">
				<div class="mb-3">
					<label for="nama" class="form-label">Nama:</label>
					<input type="text" class="form-control" id="nama" required>
				</div>
				<div class="mb-3">
					<label for="umur" class="form-label">Umur:</label>
					<input type="number" class="form-control" id="umur" required>
				</div>
				<div class="mb-3">
					<label for="tanggal" class="form-label">Tanggal:</label>
					<input type="date" class="form-control" id="tanggal" required>
				</div>
				<div class="mb-3">
					<label for="berat-badan" class="form-label">Berat Badan (kg):</label>
					<input type="number" class="form-control" id="berat-badan" required>
				</div>
				<div class="mb-3">
					<label for="batasmax" class="form-label">Batas cairan / Hari (ml):</label>
					<input type="number" class="form-control" id="batasmax" value="500" disabled>
				</div>
				<div class="mb-3">
					<label for="jumlah-urin" class="form-label">Jumlah Urin / 24 Jam (ml):</label>
					<input type="number" class="form-control" id="jumlah-urin" required>
				</div>
				<button type="button" class="btn btn-primary" onclick="hitungCairan()">Hitung Cairan</button>
			</form>
			<h4 class="mt-4">Hasil Perhitungan Cairan:</h4>
			<div id="hasil-cairan"></div>
			<br /><br />
			<line></line>
			<h5 class="mt-4">Edukasi Pola Kepatuhan Cairan</h5>

			<div class="mt-4">
				<div class="row">
					<div class="col-md-6 mb-3">
						<button class="btn btn-primary btn-block pdf-button" onclick="bukaPDF('<?= base_url('gambar/pdf/BERAT_BADAN_KERING.pdf') ?>')">Berat Badan Kering</button>
					</div>
					<div class="col-md-6 mb-3">
						<button class="btn btn-primary btn-block pdf-button" onclick="bukaPDF('<?= base_url('gambar/pdf/CAIRAN_TUBUH.pdf') ?>')">Cairan Tubuh</button>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 mb-3">
						<button class="btn btn-primary btn-block pdf-button" onclick="bukaPDF('<?= base_url('gambar/pdf/DIET_RENDAH_GARAM.pdf') ?>')">Diet Rendah Garam</button>
					</div>
					<div class="col-md-6 mb-3">
						<button class="btn btn-primary btn-block pdf-button" onclick="bukaPDF('<?= base_url('gambar/pdf/IDWG.pdf') ?>')">IDWG</button>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 mb-3">
						<button class="btn btn-primary btn-block pdf-button" onclick="bukaPDF('<?= base_url('gambar/pdf/KESEIMBANGAN.pdf') ?>')">Keseimbangan</button>
					</div>
					<div class="col-md-6 mb-3">
						<button class="btn btn-primary btn-block pdf-button" onclick="bukaPDF('<?= base_url('gambar/pdf/PERAWATAN_AV_SHUNT.pdf') ?>')">Perawatan AV Shunt</button>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 mb-3">
						<button class="btn btn-primary btn-block pdf-button" onclick="bukaPDF('<?= base_url('gambar/pdf/PERAWATAN_CDL.pdf') ?>')">Perawatan CDL</button>
					</div>
					<!-- Tambahkan tombol PDF lainnya di sini sesuai kebutuhan -->
				</div>
			</div>


		</div>
	</div>

</section>


<script>
	window.onload = function() {
		// Ambil semua tombol PDF
		var pdfButtons = document.querySelectorAll('.pdf-button');

		// Temukan lebar tombol terpanjang
		var maxWidth = 0;
		pdfButtons.forEach(function(button) {
			var buttonWidth = button.offsetWidth;
			if (buttonWidth > maxWidth) {
				maxWidth = buttonWidth;
			}
		});

		// Atur lebar semua tombol sesuai dengan tombol terpanjang
		pdfButtons.forEach(function(button) {
			button.style.width = maxWidth + 'px';
		});
	};

	function bukaPDF(url) {
		window.open(url, '_blank');
	}

	function hitungCairan() {
		// Ambil nilai dari input
		var nama = document.getElementById("nama").value;
		var tanggal = document.getElementById("tanggal").value;
		var batasmax = parseFloat(document.getElementById("batasmax").value);
		var jumlahUrin = parseInt(document.getElementById("jumlah-urin").value);

		// Hitung kebutuhan cairan (rumus contoh, bisa disesuaikan)
		var kebutuhanCairan = batasmax + jumlahUrin;

		// Tampilkan hasil dengan format yang rapi
		var hasilCairan = `<p>Halo ${nama}, pada tanggal ${tanggal}, kebutuhan cairan Anda adalah ${kebutuhanCairan} ml.</p>
  <p>Untuk menjaga kebutuhan cairan Anda, berikut tips dari kami:</p>
  <ol>
    <li>Mengukur produksi urin dalam sehari semalam (24 jam).</li>
    <li>Mengatur minum dengan cara jumlah urin sehari ditambah 500 ml air.</li>
    <li>Ganti minum air dingin dengan air hangat.</li>
  </ol>
  <p>Untuk konsultasi lebih lanjut datang saja ke Poli Penyakit Dalam RSUD Genteng ya..</p>
  `;

		document.getElementById("hasil-cairan").innerHTML = hasilCairan;

		// Reset nilai-nilai input
		document.getElementById("nama").value = "";
		document.getElementById("umur").value = "";
		document.getElementById("tanggal").value = "";
		document.getElementById("berat-badan").value = "";
		document.getElementById("jumlah-urin").value = "";
	}
</script>
</body>

</html>