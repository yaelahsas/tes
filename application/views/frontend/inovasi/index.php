<style>
	.custom-card {
		margin-bottom: 20px;
	}

	.img-cus {
		text-align: center;
		margin-bottom: 20px;

	}

	.img-cus img {
		display: inline-block;
		/* Menggunakan inline-block untuk mengatur margin auto */
		max-width: 50%;
		/* Lebar maksimum 70% dari container */
		height: auto;
		/* Gambar tetap proporsional */
		margin: 0 auto;
		/* Mengatur margin auto secara horizontal akan membuat gambar berada di tengah */
	}
</style>
<section class="breadcrumbs">
	<div class="container">

		<div class="d-flex justify-content-between align-items-center">


		</div>
</section><!-- End Breadcrumbs Section -->
<section class="inner-page">
	<div class="img-cus">
		<img src="<?= base_url('gambar/benefit.jpg') ?>" class="card-img-top img-fluid" alt="Gambar 3" width="1000" height="700">
	</div>
	<div class="container">
		<div class="row justify-content-center"> <!-- Menggunakan justify-content-center untuk tengah horizontal -->
			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">PIOVAR</h5>
						<p class="card-text">Pelayanan informasi obat instalasi farmasi</p>
						<button class="btn btn-primary">Klik</button>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card custom-card">
					<div class="card-body">
						<h5 class="card-title">GERAKPOL KANGMAS</h5>
						<p class="card-text">Konsultasi layanan poliklinik</p>
						<button class="btn btn-primary">Klik</button>
					</div>
				</div>
			</div>
		</div>
		<div class="row justify-content-center"> <!-- Menggunakan justify-content-center untuk tengah horizontal -->
			<div class="col-md-4">
				<div class="card custom-card">
					<div class="card-body">
						<h5 class="card-title">SEMBUH CERIA</h5>
						<p class="card-text">Konsultasi perawatan rawat inap kelas 1</p>
						<button class="btn btn-primary">Klik</button>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">SI DIA BERKESAN</h5>
						<p class="card-text">Konsultasi pola kepatuhan cairan pasien HD</p>
						<button class="btn btn-primary">Klik</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>