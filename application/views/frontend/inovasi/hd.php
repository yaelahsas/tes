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
		</div>
	</div>

</section>


<script>
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