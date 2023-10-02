<style>
	.custom-card {
		margin-bottom: 20px;
	}

	.img-cus {
		text-align: center;
		margin-bottom: 20px;
	}

	.img-cus img {
		display: block;
		max-width: 1000px;
		/* Lebar maksimum pada layar normal (desktop) */
		max-height: 700px;
		/* Tinggi maksimum pada layar normal (desktop) */
		width: auto;
		height: auto;
		margin: 0 auto;
	}

	/* Media query untuk perangkat seluler dengan lebar maksimum 768px */
	@media (max-width: 768px) {
		.img-cus img {
			max-width: 80%;
			/* Mengurangi lebar maksimum gambar untuk perangkat seluler */
		}
	}
</style>


<section class="breadcrumbs">
	<div class="container">

		<div class="d-flex justify-content-between align-items-center">


		</div>
</section><!-- End Breadcrumbs Section -->
<section class="inner-page">
	<div class="img-cus">
		<img src="<?= base_url('gambar/fix.jpg') ?>" class="card-img-top img-fluid" alt="Gambar 3" width="1000" height="700">
	</div>
	<div class="container">
		<div class="row justify-content-center"> <!-- Menggunakan justify-content-center untuk tengah horizontal -->
			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">PIOFAR</h5>
						<p class="card-text">Inovasi terbaru kami, Piofar, menggabungkan teknologi dengan pelayanan informasi obat di instalasi farmasi. Piofar membantu pasien memahami obat mereka dengan lebih baik, menyediakan informasi dosis, interaksi obat, dan panduan penggunaan yang tepat, menjadikan perawatan kesehatan lebih terjangkau dan aman.</p>
						<button class="btn btn-primary">
							<a href="https://wa.me/6281235117253?text=Saya%20ingin%20bertanya%20tentang%20obat" style="color: white;">Hubungi Kami</a>
						</button>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card custom-card">
					<div class="card-body">
						<h5 class="card-title">GERAKPOL KANGMAS</h5>
						<p class="card-text">Inovasi terbaru kami, GERAKPOL KANGMAS, adalah solusi revolusioner yang memudahkan pasien dalam menanyakan tentang layanan poliklinik, jadwal poliklinik, dan jadwal dokter. Dengan GERAKPOL KANGMAS, pasien dapat dengan mudah mengakses informasi terkini mengenai poliklinik.</p>
						<button class="btn btn-primary"><a href="https://wa.me/6282228748899?text=Halo,%20saya%20ingin%20bertanya%20mengenai%20poliklinik" style="color: white;">Hubungi Kami</a></button>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">SI DIA BERKESAN</h5>
						<p class="card-text">Kalkulasi dan edukasi pola kepatuhan cairan pasien Hemodialisa</p>
						<button class="btn btn-primary"><a href="<?= base_url("home/hd") ?>" style="color: white;">Hubungi Kami</a></button>
					</div>
				</div>
			</div>
		</div>

	</div>
	<div class="row justify-content-center"> <!-- Menggunakan justify-content-center untuk tengah horizontal -->
		<div class="col-md-1">
			<div class="card custom-card">
				<div class="card-body">
					<a href='http://www.freevisitorcounters.com'>at Freevisitorcounters.com</a>
					<script type='text/javascript' src='https://www.freevisitorcounters.com/auth.php?id=bdf3fe564d5a0b284c2b63bd9a19a06c396007ba'></script>
					<script type="text/javascript" src="https://www.freevisitorcounters.com/en/home/counter/1079940/t/7"></script>
				</div>
			</div>
		</div>
	</div>
</section>