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

	.page-view-card {
		background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
		color: white;
		border: none;
		border-radius: 1rem;
		box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
		transition: transform 0.3s ease-in-out;
	}

	.page-view-card:hover {
		transform: translateY(-10px);
	}

	.page-view-card .card-body {
		padding: 2rem;
	}

	.page-view-card .card-title {
		font-size: 1.2rem;
		margin-bottom: 1rem;
		text-transform: uppercase;
		letter-spacing: 1px;
	}

	.page-view-card .card-text {
		font-size: 2.5rem;
		font-weight: bold;
	}

	/* Responsiveness */
	@media (max-width: 767.98px) {
		.page-view-card .card-body {
			padding: 1.5rem;
		}

		.page-view-card .card-title {
			font-size: 1rem;
		}

		.page-view-card .card-text {
			font-size: 2rem;
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
		<img src="<?= base_url('gambar/1.svg') ?>" class="card-img-top img-fluid" alt="Gambar 3" width="1000" height="700">
	</div>
	<div class="container">
		<div class="row justify-content-center"> <!-- Menggunakan justify-content-center untuk tengah horizontal -->
			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">PIOFAR</h5>
						<img src="<?= base_url('gambar/piofar.jpg') ?>" class="card-img-top img-fluid" alt="Gambar 3" width="1000" height="700">
						<br />
						<br />
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
						<img src="<?= base_url('gambar/gerakpolkangmas.jpg') ?>" class="card-img-top img-fluid" alt="Gerakpol Kangmas">
						<br />
						<br />
						<button class="btn btn-primary"><a href="https://wa.me/6282228748899?text=Halo,%20saya%20ingin%20bertanya%20mengenai%20poliklinik" style="color: white;">Hubungi Kami</a></button>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">SI DIA BERKESAN</h5>
						<img src="<?= base_url('gambar/sidiaberkesan.jpg') ?>" class="card-img-top img-fluid" alt="Gerakpol Kangmas">
						<br />
						<br />
						<button class="btn btn-primary"><a href="<?= base_url("home/hd") ?>" style="color: white;">Hubungi Kami</a></button>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card custom-card">
					<div class="card-body">
						<h5 class="card-title">PUSAT INFORMASI DAN PENGADUAN</h5>
						<img src="<?= base_url('gambar/sarpras.jpg') ?>" class="card-img-top img-fluid" alt="Pusat informasi dan pengaduan">
						<br />
						<br />
						<button class="btn btn-primary"><a href="https://wa.me/6281329651321?text=Halo,%20saya%20ingin%20bertanya%20mengenai%20RSUD%20Genteng" style="color: white;">Hubungi Kami</a></button>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card custom-card">
					<div class="card-body">
						<h5 class="card-title">PENDAFTARAN ONLINE WA</h5>
						<img src="<?= base_url('gambar/online.jpg') ?>" class="card-img-top img-fluid" alt="Pendaftaran Online">
						<br />
						<br />
						<button class="btn btn-primary"><a href="https://wa.me/628113439905?text=Halo%20Saya%20Ingin%20Mendaftar" style="color: white;">Daftar</a></button>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card custom-card">
					<div class="card-body">
						<h5 class="card-title">KARTINI</h5>
						<img src="<?= base_url('gambar/kartini.jpg') ?>" class="card-img-top img-fluid" alt="Kartini">
						<br />
						<br />
						<button class="btn btn-primary"><a href="<?= base_url("home/kartini") ?>" style="color: white;">Selengkapnya</a></button>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="card custom-card">
					<div class="card-body">
						<h5 class="card-title">HOSTREN</h5>
						<img src="<?= base_url('gambar/hostren.jpg') ?>" class="card-img-top img-fluid" alt="Hostren">
						<br />
						<br />
						<button class="btn btn-primary"><a href="<?= base_url("home/hostren") ?>" style="color: white;">Selengkapnya</a></button>
					</div>
				</div>
			</div>

		</div>

	</div>
	<div class="row justify-content-center"> <!-- Menggunakan justify-content-center untuk tengah horizontal -->
		<div class="container mt-5">
			<div class="row justify-content-center">
				<div class="col-md-4">
					<div class="card page-view-card text-center">
						<div class="card-body">
							<h5 class="card-title">Telah Dilihat</h5>
							<p class="card-text">6234</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>