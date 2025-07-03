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

	.rating {
		font-size: 20px;
		margin: 10px 0;
	}

	.stars {
		font-size: 30px;
		margin: 10px 0;
	}

	.star {
		cursor: pointer;
		margin: 0 5px;
	}

	.one {
		color: rgb(255, 0, 0);
	}

	.two {
		color: #ff9800;
	}

	.three {
		color: rgb(251, 255, 120);
	}

	.four {
		color: rgb(255, 255, 0);
	}

	.five {
		color: #04AA6D;
	}

	textarea {
		width: 90%;
		padding: 10px;
		border: 1px solid #ccc;
		border-radius: 4px;
	}

	button {
		background-color: #007BFF;
		color: white;
		padding: 10px 20px;
		border: none;
		border-radius: 4px;
		cursor: pointer;
	}

	button:hover {
		background-color: #0056b3;
	}

	.reviews {
		margin-top: 20px;
		text-align: left;
	}

	.review {
		border: 1px solid #ccc;
		border-radius: 4px;
		padding: 10px;
		margin: 10px 0;
	}

	.review p {
		margin: 0;
	}

	/* Three column layout */
	.side {
		float: left;
		width: 15%;
		margin-top: 10px;
	}

	.middle {
		float: left;
		width: 70%;
		margin-top: 10px;
	}

	/* Place text to the right */
	.right {
		text-align: right;
	}

	/* Clear floats after the columns */
	.row:after {
		content: "";
		display: table;
		clear: both;
	}

	/* The bar container */
	.bar-container {
		width: 100%;
		background-color: #f1f1f1;
		text-align: center;
		color: white;
	}

	/* Individual bars */
	.bar-5 {
		width: 60%;
		height: 18px;
		background-color: #04AA6D;
	}

	.bar-4 {
		width: 30%;
		height: 18px;
		background-color: rgb(255, 255, 0);
	}

	.bar-3 {
		width: 10%;
		height: 18px;
		background-color: rgb(251, 255, 120);
	}

	.bar-2 {
		width: 4%;
		height: 18px;
		background-color: #ff9800;
	}

	.bar-1 {
		width: 15%;
		height: 18px;
		background-color: rgb(255, 0, 0);
	}

	/* Responsive layout - make the columns stack on top of each other instead of next to each other */
	@media (max-width: 400px) {

		.side,
		.middle {
			width: 100%;
		}

		/* Hide the right column on small screens */
		.right {
			display: none;
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
		<button class="btn btn-primary"><a href="<?php echo base_url('dokumen/pedoman_benefit.pdf'); ?>" style="color: white;">Pedoman Benefit</a></button>
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
			<div class="col-md-4">
				<div class="card custom-card">
					<div class="card-body">
						<h5 class="card-title">PANAH</h5>
						<img src="<?= base_url('gambar/panah.jpg') ?>" class="card-img-top img-fluid" alt="Panah">
						<br />
						<br />
						<button class="btn btn-primary"><a href="<?= base_url("home/panah") ?>" style="color: white;">Selengkapnya</a></button>
					</div>
				</div>
			</div>

		</div>

	</div>
	<div class="row justify-content-center">
		<div class="container mt-2">
			<div class="row justify-content-center">
				<div class="col-md-4">
					<div class="card page-view-card text-center mb-3">
						<div class="card-body p-1">
							<h6 class="card-title mb-1">Telah Dilihat</h6>
							<p class="card-text m-0"><?php echo $totalnya; ?></p>
						</div>
					</div>
					<div class="card page-view-card text-center">
						<div class="card-body">
							<h3>Berikan penilaian kepada BENEFIT</h3>
							<div class="rating">
								<span id="rating">0</span>/5
							</div>
							<div class="stars" id="stars">
								<span class="fa fa-star star" data-value="1"></span>
								<span class="fa fa-star star" data-value="2"></span>
								<span class="fa fa-star star" data-value="3"></span>
								<span class="fa fa-star star" data-value="4"></span>
								<span class="fa fa-star star" data-value="5"></span>
							</div>
							<p>Tulis pesan anda:</p>
							<textarea id="tulisan" placeholder="Tulis pesan disini"></textarea>
							<button id="submit">Simpan</button>
							<div class="reviews" id="reviews"></div>

							<!-- Indikator loading -->
							<div id="loading-indicator" style="display: none;">
								<div class="spinner-border text-primary" role="status">
									<span class="visually-hidden">Loading...</span>
								</div>
								<p>Loading...</p>
							</div>
							<p id="average-rating"> rata-rata dari review.</p>
							<hr style="border:3px solid #f1f1f1">

							<div class="row">
								<div class="side">
									<div>5 star</div>
								</div>
								<div class="middle">
									<div class="bar-container">
										<div class="bar-5"></div>
									</div>
								</div>
								<div class="side right">
									<div id="count-5"></div>
								</div>
								<div class="side">
									<div>4 star</div>
								</div>
								<div class="middle">
									<div class="bar-container">
										<div class="bar-4"></div>
									</div>
								</div>
								<div class="side right">
									<div id="count-4"></div>
								</div>
								<div class="side">
									<div>3 star</div>
								</div>
								<div class="middle">
									<div class="bar-container">
										<div class="bar-3"></div>
									</div>
								</div>
								<div class="side right">
									<div id="count-3"></div>
								</div>
								<div class="side">
									<div>2 star</div>
								</div>
								<div class="middle">
									<div class="bar-container">
										<div class="bar-2"></div>
									</div>
								</div>
								<div class="side right">
									<div id="count-2"></div>
								</div>
								<div class="side">
									<div>1 star</div>
								</div>
								<div class="middle">
									<div class="bar-container">
										<div class="bar-1"></div>
									</div>
								</div>
								<div class="side right">
									<div id="count-1"></div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<div class="container" style="margin-top: 30px;">
		<div class="row justify-content-center">
			<div class="col-md-4">

				<div class="card custom-card">
					<div class="card-body">
						<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-badge-ad" viewBox="0 0 16 16">
							<path d="m3.7 11 .47-1.542h2.004L6.644 11h1.261L5.901 5.001H4.513L2.5 11zm1.503-4.852.734 2.426H4.416l.734-2.426zm4.759.128c-1.059 0-1.753.765-1.753 2.043v.695c0 1.279.685 2.043 1.74 2.043.677 0 1.222-.33 1.367-.804h.057V11h1.138V4.685h-1.16v2.36h-.053c-.18-.475-.68-.77-1.336-.77zm.387.923c.58 0 1.002.44 1.002 1.138v.602c0 .76-.396 1.2-.984 1.2-.598 0-.972-.449-.972-1.248v-.453c0-.795.37-1.24.954-1.24z" />
							<path d="M14 3a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1zM2 2a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V4a2 2 0 0 0-2-2z" />
						</svg>
						<h5 class="card-title">Inovasi SPEED</h5>
						<img src="<?= base_url('gambar/logo_speed.jpg') ?>" class="card-img-top img-fluid" alt="Pusat informasi dan pengaduan">
						<br />
						<br />
						<button class="btn btn-primary"><a href="<?= base_url("home/speed") ?>" style="color: white;">Selengkapnya</a></button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script>
	var inovasinya = '<?php echo $inovasi; ?>';
</script>
<script src="<?php echo base_url('assets/js/custom.min.js'); ?>"></script>

<!-- Removed custom.js script from here to move to footer.php for conditional loading -->
