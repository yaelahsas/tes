<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Shimmer Effect Photos</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

	<style>
		.shimmer-wrapper {
			position: relative;
			overflow: hidden;
			background-color: #f6f7f8;
		}

		.shimmer-wrapper::after {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			background-image: linear-gradient(90deg,
					rgba(255, 255, 255, 0) 0,
					rgba(255, 255, 255, 0.8) 50%,
					rgba(255, 255, 255, 0) 100%);
			animation: shimmer 1.5s infinite;
		}

		@keyframes shimmer {
			0% {
				transform: translateX(-100%);
			}

			100% {
				transform: translateX(100%);
			}
		}

		.hidden {
			display: none;
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
</head>

<section class="breadcrumbs">
	<div class="container">

		<div class="d-flex justify-content-between align-items-center">


		</div>
</section><!-- End Breadcrumbs Section -->

<body>
	<!-- ======= About Us Section ======= -->
	<section id="about" class="about">
		<div class="container" data-aos="fade-up">

			<div class="section-title" style="text-align: center;">
				<h2>KARTINI</h2>
				<p>
					KARTINI (KiAt RSUD Genteng pedulI waNIta) adalah program inovatif RSUD Genteng yang menyediakan pemeriksaan organ sensitif wanita oleh petugas perempuan untuk meningkatkan kenyamanan dan mengatasi ketakutan pasien wanita saat diperiksa oleh lawan jenis. Program ini mendukung janji layanan RSUD Genteng yaitu “CANTIK” (Cepat, Aman, Nyaman, Tepat, Informatif, dan Komunikatif), dan dilakukan oleh tim khusus yang juga bertugas memberikan informasi serta edukasi melalui media cetak, media sosial, dan roadshow ke komunitas perempuan. Dengan didukung oleh banyaknya SDM perempuan di RSUD Genteng, program ini diharapkan mampu meningkatkan kesadaran dan keberanian perempuan dalam memeriksakan kondisi kesehatan organ sensitif mereka, sehingga penyakit kronis seperti kanker payudara dan kanker serviks dapat terdeteksi lebih dini dan angka kematian akibat penyakit ini menurun, sesuai dengan gerakan pemerintah untuk pencegahan dan deteksi dini kanker leher rahim dan kanker payudara.</p>
			</div>

			<div class="row">
				<div class="col-lg-6" data-aos="fade-right">
					<img src="<?= base_url('gambar/kartini.jpg'); ?>" style="height: 500px; width: 500px;" class="img-fluid" alt="">
				</div>
				<div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left">
					<h3>Melayani pemeriksaan dengan petugas perempuan yaitu :
					</h3>
					<!-- <p class="fst-italic">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
              dolore
              magna aliqua.
            </p> -->
					<ul>
						<li><i class="bi bi-check-circle"></i>Pemeriksaan USG Mamae.</li>
						<li><i class="bi bi-check-circle"></i>Pemeriksaan Iva</li>
						<li><i class="bi bi-check-circle"></i>Pemeriksaan PAPSMEAR</li>
						<li><i class="bi bi-check-circle"></i>Pemeriksaan HSG</li>
						<li><i class="bi bi-check-circle"></i>Pemeriksann Kulit dan Kelamin</li>
						<li><i class="bi bi-check-circle"></i>Operasi sectio caesarea (syarat & ketentuan berlaku)</li>

					</ul>
					<a class="btn btn-primary" target="_blank" href="https://wa.me/6281329651321?text=Halo,%20saya%20ingin%20bertanya%20mengenai%20Kartini%20RSUD%20Genteng.
">Hubungi Kami</a>
					<a class="btn btn-primary" href="<?php echo base_url('dokumen/pedoman_kartini.pdf'); ?>
">Pedoman</a>
				</div>
			</div>

		</div>
	</section><!-- End About Us Section -->


	<!-- ======= Gallery Section ======= -->
	<section id="gallery" class="gallery">
		<div class="container" data-aos="fade-up">
			<div class="section-title">
				<h2>Gallery</h2>
				<p>Beberapa foto kegiatan-kegiatan yang telah dilakukan Inovasi Kartini</p>
			</div>

			<div class="gallery-slider swiper">
				<div class="swiper-wrapper align-items-center">
					<?php for ($i = 1; $i <= 18; $i++) : ?>
						<div class="swiper-slide">
							<a class="gallery-lightbox" href="<?php echo base_url('gambar/kartini/' . $i . '.jpg'); ?>">
								<img src="<?php echo base_url('gambar/kartini/' . $i . '.jpg'); ?>" class="img-fluid lozad" alt="Gallery Image <?= $i ?>">
							</a>
						</div>
					<?php endfor; ?>
				</div>
				<div class="swiper-pagination"></div>
			</div>
		</div>

		<div class="row justify-content-center">
			<div class="container mt-2">
				<div class="row justify-content-center">
					<div class="col-md-4">
						<div class="card page-view-card text-center mb-3">

						</div>
						<div class="card page-view-card text-center">
							<div class="card-body">
								<h3>Berikan penilaian kepada KARTINI</h3>
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
	</section><!-- End Gallery Section -->


	<script src="<?php echo base_url('assets/js/custom.js'); ?>"></script>

	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>