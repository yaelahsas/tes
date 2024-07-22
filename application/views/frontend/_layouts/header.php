<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>RSUD Genteng - Rumah Sakit Umum Daerah Terbaik</title>
	<meta content="Rumah Sakit Umum Daerah Genteng adalah rumah sakit umum daerah yang menyediakan pelayanan kesehatan terbaik dengan berbagai fasilitas medis dan dokter spesialis." name="description">
	<meta content="Rumah Sakit Umum Daerah Genteng, RSUD Genteng, rumah sakit, pelayanan kesehatan, dokter spesialis, fasilitas medis, rumah sakit umum daerah" name="keywords">

	<!-- Favicons -->
	<link href="<?php echo base_url('assets/img/logo_bwi_small.png'); ?>" rel="shortcut icon">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="<?php echo base_url('assets/front/vendor/fontawesome-free/css/all.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/front/vendor/animate.css/animate.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/front/vendor/aos/aos.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/front/vendor/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/front/vendor/bootstrap-icons/bootstrap-icons.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/front/vendor/boxicons/css/boxicons.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/front/vendor/glightbox/css/glightbox.min.css'); ?>" rel="stylesheet">
	<link href="<?php echo base_url('assets/front/vendor/swiper/swiper-bundle.min.css'); ?>" rel="stylesheet">

	<!-- Template Main CSS File -->
	<link href="<?php echo base_url('assets/front/css/style.css'); ?>" rel="stylesheet">

	<style>
		/* Tambahkan di dalam tag <style> atau dalam file CSS terpisah */
		.fixed-height {
			height: 300px;
			object-fit: cover;
			width: 100%;
		}

		.fixed-artikel {
			height: 400px;
			object-fit: cover;
			width: 100%;
		}

		.member {
			display: flex;
			flex-direction: column;
			align-items: center;
			text-align: center;
			height: 400px !important;
		}

		.member-img {
			width: 100%;
		}

		.member-info {
			padding: 10px;
		}

		.iframe-wrapper {
			position: relative;
			padding-bottom: 56.25%;
			height: 900px;
			overflow: hidden;
		}

		.iframe-wrapper iframe {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
		}

		@media (min-width: 1023px) {
			#hero {
				height: 720px !important;
			}
		}

		@media (min-width: 768px) and (max-width: 1023px) {
			#hero {
				height: 67vh;
			}
		}

		@media (max-width: 768px) {
			#hero {
				height: 57vh;
			}
		}

		@media (max-width: 576px) {
			#hero {
				height: 40vh;
			}
		}
	</style>
</head>

<body>

	<!-- ======= Top Bar ======= -->
	<div id="topbar" class="d-flex align-items-center fixed-top">
		<div class="container d-flex align-items-center justify-content-center justify-content-md-between">
			<div class="align-items-center d-none d-md-flex">
				<i class="bi bi-clock"></i> Senin - Sabtu, 07.00 - 12.00, IGD 24 Jam
			</div>
			<div class="d-flex align-items-center">
				<i class="bi bi-phone"></i> Hubungi Kami 081329651321
			</div>
		</div>
	</div>

	<!-- ======= Header ======= -->
	<header id="header" class="fixed-top">
		<div class="container d-flex align-items-center">
			<a href="<?= base_url() ?>" class="logo me-auto"><img src="<?php echo base_url('assets/front/img/logo-dark.png') ?>" alt="Logo RSUD Genteng" title="RSUD Genteng"></a>
			<nav id="navbar" class="navbar order-last order-lg-0">
				<ul>
					<li><a class="nav-link scrollto" href="<?= base_url() ?>">Home</a></li>
					<li class="dropdown"><a href="#"><span>Tentang</span> <i class="bi bi-chevron-down"></i></a>
						<ul>
							<li><a href="<?= base_url('tentang/struktur_organisasi') ?>">Struktur Organisasi</a></li>
						</ul>
					</li>
					<li><a class="nav-link scrollto" href="<?= base_url() ?>#services">Pelayanan</a></li>
					<li><a class="nav-link scrollto" href="<?= base_url() ?>#doctors">Dokter</a></li>
					<li><a class="nav-link scrollto" href="<?= base_url() ?>#contact">Kontak</a></li>
					<li><a class="nav-link" href="<?= base_url('home/inovasi') ?>">Inovasi</a></li>
				</ul>
				<i class="bi bi-list mobile-nav-toggle"></i>
			</nav><!-- .navbar -->
		</div>
	</header>