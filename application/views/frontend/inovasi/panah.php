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

			<div class="section-title">
				<h2>PANAH</h2>
				<p>
					PANAH adalah suatu inovasi layanan pengantaran obat yang dilakukan oleh instalasi farmasi raud genteng yang kerja sama dengan aplikasi JOKER dengan sistem pembayaran COD oleh pasien.
					Malas antri obat PANAHIN aja
				</p>
			</div>


			<div class="row">
				<div class="col-lg-6" data-aos="fade-right">
					<img src="<?= base_url('gambar/panah.jpg'); ?>" style="height: 500px; width: 500px;" class="img-fluid" alt="">
				</div>
				<div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left">
					<h3>Kelebihan menggunakan PANAH: :
					</h3>
					<!-- <p class="fst-italic">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
              dolore
              magna aliqua.
            </p> -->
					<ul>
						<li><i class="bi bi-check-circle"></i>Obat diantar kerumah pasien</li>
						<li><i class="bi bi-check-circle"></i>Harga sesuai dengan jarak</li>
						<li><i class="bi bi-check-circle"></i>Pengantaran Cepat dan Aman</li>

					</ul>

					<a class="btn btn-primary" href="<?php echo base_url('dokumen/pedoman_panah.pdf'); ?>
">Pedoman</a>
					<a class="btn btn-primary" href="<?php echo base_url('dokumen/alur_panah.pdf'); ?>
">Alur</a>
				</div>
			</div>
		</div>
	</section><!-- End About Us Section -->


	<!-- ======= Gallery Section ======= -->
	<section id="gallery" class="gallery">
		<div class="container" data-aos="fade-up">
			<div class="section-title">
				<h2>Gallery</h2>
				<p>Beberapa foto masyarakat yang telah menggunakan Inovasi Hostren</p>
			</div>

			<div class="gallery-slider swiper">
				<div class="swiper-wrapper align-items-center">
					<?php for ($i = 1; $i <= 6; $i++) : ?>
						<div class="swiper-slide">
							<a class="gallery-lightbox" href="<?php echo base_url('gambar/panah/panah_' . $i . '.jpg'); ?>">
								<img src="<?php echo base_url('gambar/panah/panah_' . $i . '.jpg'); ?>" class="img-fluid lozad" alt="Gallery Image <?= $i ?>">
							</a>
						</div>
					<?php endfor; ?>
				</div>
				<div class="swiper-pagination"></div>
			</div>
		</div>
	</section><!-- End Gallery Section -->



	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
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

			<div class="section-title">
				<h2>PANAH</h2>
				<p>
					PANAH adalah suatu inovasi layanan pengantaran obat yang dilakukan oleh instalasi farmasi raud genteng yang kerja sama dengan aplikasi JOKER dengan sistem pembayaran COD oleh pasien.
					Malas antri obat PANAHIN aja
				</p>
			</div>


			<div class="row">
				<div class="col-lg-6" data-aos="fade-right">
					<img src="<?= base_url('gambar/panah.jpg'); ?>" style="height: 500px; width: 500px;" class="img-fluid" alt="">
				</div>
				<div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left">
					<h3>Kelebihan menggunakan PANAH: :
					</h3>
					<!-- <p class="fst-italic">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
              dolore
              magna aliqua.
            </p> -->
					<ul>
						<li><i class="bi bi-check-circle"></i>Obat diantar kerumah pasien</li>
						<li><i class="bi bi-check-circle"></i>Harga sesuai dengan jarak</li>
						<li><i class="bi bi-check-circle"></i>Pengantaran Cepat dan Aman</li>
						<li><i class="bi bi-check-circle"></i>Driver Ramah</li>

					</ul>

					<a class="btn btn-primary" href="<?php echo base_url('dokumen/pedoman_panah.pdf'); ?>
">Pedoman</a>
					<a class="btn btn-primary" href="<?php echo base_url('dokumen/alur_panah.pdf'); ?>
">Alur</a>
				</div>
			</div>
		</div>
	</section><!-- End About Us Section -->


	<!-- ======= Gallery Section ======= -->
	<section id="gallery" class="gallery">
		<div class="container" data-aos="fade-up">
			<div class="section-title">
				<h2>Gallery</h2>
				<p>Beberapa foto masyarakat yang telah menggunakan Inovasi Hostren</p>
			</div>

			<div class="gallery-slider swiper">
				<div class="swiper-wrapper align-items-center">
					<?php for ($i = 1; $i <= 6; $i++) : ?>
						<div class="swiper-slide">
							<a class="gallery-lightbox" href="<?php echo base_url('gambar/panah/panah_' . $i . '.jpg'); ?>">
								<img src="<?php echo base_url('gambar/panah/panah_' . $i . '.jpg'); ?>" class="img-fluid lozad" alt="Gallery Image <?= $i ?>">
							</a>
						</div>
					<?php endfor; ?>
				</div>
				<div class="swiper-pagination"></div>
			</div>
		</div>
	</section><!-- End Gallery Section -->



	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>