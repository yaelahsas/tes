<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>RSUD Genteng</title>
	<meta content="" name="description">
	<meta content="" name="keywords">

	<!-- Favicons -->
	<link href="<?php echo base_url('assets/img/logo_bwi_small.png'); ?>" rel="icon">



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

	<!-- =======================================================
  * Template Name: Medicio - v4.10.0
  * Template URL: https://bootstrapmade.com/medicio-free-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
	<style>
		/* Tambahkan di dalam tag <style> atau dalam file CSS terpisah */
		.fixed-height {
			height: 300px;
			/* Ubah angka sesuai dengan ketinggian yang Anda inginkan */
			object-fit: cover;
			/* Gambar akan diatur untuk mengisi ruang dengan menjaga proporsi */
			width: 100%;
			/* Pastikan gambar mengisi lebar elemen parent */
		}

		.fixed-artikel {
			height: 400px;
			/* Ubah angka sesuai dengan ketinggian yang Anda inginkan */
			object-fit: cover;
			/* Gambar akan diatur untuk mengisi ruang dengan menjaga proporsi */
			width: 100%;
			/* Pastikan gambar mengisi lebar elemen parent */
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
			/* Pastikan gambar mengisi lebar elemen parent */
		}

		.member-info {
			padding: 10px;
			/* Atur jarak antara nama dokter dan gambar */
		}

		.iframe-wrapper {
			position: relative;
			padding-bottom: 56.25%;
			/* Aspek rasio 16:9 */
			height: 900px;
			overflow: hidden;
		}

		.iframe-wrapper iframe {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			/* Tetapkan tinggi iframe 100% */
		}



		@media (min-width: 1023px) {

			/* Gaya untuk layar antara 768px dan 1023px */
			#hero {
				height: 720px !important;
				/* Set the height to 50% of the viewport height */
			}
		}

		@media (min-width: 768px) and (max-width: 1023px) {

			/* Gaya untuk layar antara 768px dan 1023px */
			#hero {
				height: 67vh;
				/* Set the height to 50% of the viewport height */
			}
		}


		/* Adjust the carousel height for mobile devices */
		/* For screens smaller than 768px (tablets, phones) */
		@media (max-width: 768px) {
			#hero {
				height: 57vh;
				/* Set the height to 50% of the viewport height */
			}
		}

		/* For screens smaller than 576px (small phones) */
		@media (max-width: 576px) {
			#hero {
				height: 40vh;
				/* Set the height to 40% of the viewport height */
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
				<i class="bi bi-phone"></i> Hubungi Kami 08113439905
			</div>
		</div>
	</div>

	<!-- ======= Header ======= -->
	<header id="header" class="fixed-top">
		<div class="container d-flex align-items-center">

			<a href<?= base_url() ?>"" class="logo me-auto"><img src="<?php echo base_url('assets/front/img/logo-dark.png') ?>" alt=""></a>
			<!-- Uncomment below if you prefer to use an image logo -->
			<!-- <h1 class="logo me-auto"><a href="index.html">Medicio</a></h1> -->

			<nav id="navbar" class="navbar order-last order-lg-0">
				<ul>
					<li><a class="nav-link scrollto " href="<?= base_url() ?>#hero">Home</a></li>
					<li><a class="nav-link scrollto" href="<?= base_url() ?>#about">Tentang</a></li>
					<li><a class="nav-link scrollto" href="<?= base_url() ?>#services">Pelayanan</a></li>
					<li><a class="nav-link scrollto" href="<?= base_url() ?>#doctors">Dokter</a></li>
					<li><a class="nav-link scrollto" href="<?= base_url() ?>#contact">Kontak</a></li>
				</ul>
				<i class="bi bi-list mobile-nav-toggle"></i>
			</nav><!-- .navbar -->


		</div>
	</header><!-- End Header -->