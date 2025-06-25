<!-- SEO Meta Tags -->
<meta name="description" content="RSUD Genteng Banyuwangi - Rumah sakit umum daerah yang memberikan pelayanan kesehatan terpadu dengan dokter spesialis berpengalaman. Melayani 24 jam untuk keadaan darurat.">
<meta name="keywords" content="RSUD Genteng Banyuwangi, rumah sakit Banyuwangi, dokter spesialis banyuwangi, IGD 24 jam, pelayanan kesehatan Genteng banyuwangi">
<meta property="og:title" content="RSUD Genteng Banyuwangi - Pelayanan Kesehatan Terpadu">
<meta property="og:description" content="Rumah sakit umum daerah banyuwangi yang memberikan pelayanan kesehatan terpadu dengan dokter spesialis berpengalaman. Melayani 24 jam untuk keadaan darurat.">
<meta property="og:image" content="<?= base_url('assets/front/img/rs_malam.jpg') ?>">
<meta property="og:url" content="<?= current_url() ?>">
<link rel="canonical" href="<?= current_url() ?>">

<!-- Schema.org markup for Google -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Hospital",
  "name": "RSUD Genteng Banyuwangi",
  "image": "<?= base_url('assets/front/img/rs_malam.jpg') ?>",
  "description": "Rumah sakit umum daerah yang memberikan pelayanan kesehatan terpadu dengan dokter spesialis berpengalaman.",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "Jl. HASANUDIN 98",
    "addressLocality": "Genteng",
    "addressRegion": "Banyuwangi",
    "postalCode": "68465",
    "addressCountry": "ID"
  },
  "telephone": "+623338458390",
  "openingHours": "Mo-Su 00:00-24:00",
  "hasMap": "https://goo.gl/maps/YOUR-MAPS-URL"
}
</script>

<style>
    /* Performance Optimizations */
    .card {
        border: none;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        will-change: transform;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        contain: content;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    /* Optimize Images */
    img {
        max-width: 100%;
        height: auto;
        object-fit: cover;
    }

    /* Optimize Layout Shifts */
    .carousel-item img {
        aspect-ratio: 16/9;
    }

    .doctor-card img {
        aspect-ratio: 4/3;
    }

    /* Optimize Animations */
    @media (prefers-reduced-motion: reduce) {
        .card {
            transition: none;
        }
    }

    /* Critical CSS */
    .section-title {
        margin-bottom: 2rem;
        text-align: center;
    }

    .section-title h2 {
        font-size: 2rem;
        font-weight: 600;
        color: #2c4964;
        margin-bottom: 1rem;
    }

    .lazy {
        opacity: 0;
        transition: opacity 0.3s;
    }

    .lazy.loaded {
        opacity: 1;
    }

	.card-img-top {
		border-bottom: 1px solid #ddd;
	}

	.member-info {
		padding: 15px;
	}

	.member-info h4 {
		font-size: 1.2rem;
		margin-bottom: 5px;
	}

	.member-info span {
		color: #6c757d;
		font-size: 0.9rem;
	}
</style>
<!-- Hero Section -->
<section id="hero">
	<div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">
		<ol class="carousel-indicators" id="hero-carousel-indicators"></ol>
		<div class="carousel-inner" role="listbox">
			<?php foreach ($profil as $key => $prof) { ?>
				<div class="d-block w-100 carousel-item <?= $key === 0 ? 'active' : '' ?>">
					<img class="d-block w-100 h-100 lazy" 
						 data-src="<?= base_url('gambar/profil/') . $prof->img_profil ?>"
						 src="<?= base_url('assets/front/img/placeholder.jpg') ?>"
						 alt="<?= htmlspecialchars($prof->judul ?? 'RSUD Genteng Slide') ?>"
						 width="1920" height="1080">
					<div class="carousel-caption d-none d-md-block">
						<h2 class="animate__animated animate__fadeInDown"><?= htmlspecialchars($prof->judul ?? '') ?></h2>
						<p class="animate__animated animate__fadeInUp"><?= htmlspecialchars($prof->deskripsi ?? '') ?></p>
					</div>
				</div>
			<?php } ?>
		</div>
		<a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
			<span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
		</a>
		<a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
			<span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
		</a>
	</div>
</section>

<main id="main">

	<!-- Services Section -->
	<section id="services" class="services services" aria-label="Layanan Utama">
		<div class="container">


			<div class="section-title">
				<h2>Layanan Utama</h2>
				<p>Layanan kesehatan terpadu RSUD Genteng untuk masyarakat</p>
			</div>

			<div class="row">
				<div class="col-lg-4 col-md-6 icon-box">

					<div class="icon" aria-hidden="true"><i class="fas fa-calendar-days"></i></div>
					<h3 class="title"><a href="https://rsudgenteng.id:8888/e-reservasi/" target="_blank" rel="noopener">Pendaftaran Online</a></h3>
					<p>Daftar kunjungan rumah sakit secara online tanpa antrian</p>

				</div>
				<div class="col-lg-4 col-md-6 icon-box">
					<div class="icon" aria-hidden="true"><i class="fas fa-user-doctor"></i></div>
					<h3 class="title"><a href="<?= base_url('home/jadwal_dokter') ?>">Jadwal Dokter & Poliklinik</a></h3>
					<p>Informasi jadwal praktik dokter dan layanan poliklinik</p>
				</div>

				<div class="col-lg-4 col-md-6 icon-box">
					<div class="icon" aria-hidden="true"><i class="fas fa-bed-pulse"></i></div>
					<h3 class="title"><a href="<?= base_url('home/tempat_tidur') ?>" target="_blank" rel="noopener">Ketersediaan Bed</a></h3>
					<p>Informasi ketersediaan tempat tidur secara real-time</p>
				</div>

				<div class="col-lg-4 col-md-6 icon-box">
					<div class="icon" aria-hidden="true"><i class="fas fa-envelope"></i></div>
					<h3 class="title"><a href="<?= base_url('home/pengaduan') ?>" target="_blank" rel="noopener">Layanan Pengaduan</a></h3>
					<p>Sampaikan keluhan dan saran untuk pelayanan lebih baik</p>
				</div>

				<div class="col-lg-4 col-md-6 icon-box">
					<div class="icon" aria-hidden="true"><i class="fas fa-hand"></i></div>
					<h3 class="title"><a href="#" rel="noopener">Whistleblowing System</a></h3>
					<p>Sistem pelaporan pelanggaran secara anonim</p>
				</div>

				<div class="col-lg-4 col-md-6 icon-box">
					<div class="icon" aria-hidden="true"><i class="fas fa-bullhorn"></i></div>
					<h3 class="title"><a href="<?= base_url('home/maklumat') ?>" target="_blank" rel="noopener">Maklumat</a></h3>
					<p>Informasi dan pengumuman resmi RSUD Genteng</p>
				</div>

			</div>

		</div>
	</section>

	<!-- Featured Services Section -->
	<section class="featured-services" aria-label="Layanan Unggulan">
		<div class="container">
			<div class="section-title">
				<h2>Layanan Unggulan</h2>
				<p>Berbagai layanan spesialis unggulan RSUD Genteng</p>
			</div>

			<?php foreach (array_chunk($layanan, 4) as $row_services) { ?>
				<div class="row">
					<?php foreach ($row_services as $service) { ?>
						<div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
							<div class="icon-box">
								<div class="icon">
									<img src="<?= base_url('/gambar/layanan/') . $service->img ?>" 
										 alt="<?= htmlspecialchars($service->judul) ?>"
										 width="64" height="64"
										 loading="lazy">
								</div>
								<h3 class="title">
									<a href="<?= base_url('layanan/detail/' . ($service->id ?? '')) ?>">
										<?= htmlspecialchars($service->judul) ?>
									</a>
								</h3>
								<p class="description"><?= htmlspecialchars($service->ket) ?></p>
							</div>
						</div>
					<?php } ?>
				</div>
			<?php } ?>

		</div>
	</section><!-- End Featured Services Section -->

	<!-- ======= Cta Section ======= -->
	<section id="cta" class="cta">
		<div class="container" data-aos="zoom-in">

			<div class="text-center">
				<h3>Dalam keadaan darurat? Memerlukan bantuan sekarang?</h3>
				<p>Layanan IGD RSUD Genteng tersedia 24 jam untuk memberikan perawatan dan bantuan medis yang diperlukan kapan saja. Tim kami siap melayani Anda dalam setiap situasi darurat dan keadaan yang membutuhkan perhatian segera. Keamanan dan kesejahteraan pasien adalah prioritas utama kami.</p>
				<a class="cta-btn scrollto" target="_blank" href="https://wa.me/628113439904?text=Halo,%20saya%20ingin%20bertanya%20tentang%20layanan%20IGD%20RSUD%20Genteng.
">Hubungi Kami</a>
			</div>

		</div>
	</section><!-- End Cta Section -->

	<!-- ======= About Us Section ======= -->
	<section id="about" class="about">
		<div class="container" data-aos="fade-up">

			<div class="section-title">
				<h2>Tentang Kami</h2>
				<p>
					RSUD Genteng dilengkapi dengan berbagai fasilitas medis dan peralatan modern yang mendukung penanganan
					berbagai macam penyakit dan kondisi kesehatan. Selain itu, RSUD Genteng juga memiliki tenaga medis yang
					terampil dan berpengalaman dalam memberikan pelayanan kesehatan.<br>

					Komitmen RSUD Genteng adalah memberikan pelayanan kesehatan yang terbaik dan berorientasi pada pasien. RSUD
					Genteng berusaha untuk senantiasa meningkatkan kualitas pelayanan kesehatan dengan melakukan inovasi dan
					pengembangan terbaru. RSUD Genteng menjadi pilihan utama masyarakat untuk mendapatkan pelayanan kesehatan
					yang berkualitas dan terpercaya.</p>
			</div>

			<div class="row">
				<div class="col-lg-6" data-aos="fade-right">
					<img src="<?= base_url('assets/front/img/rs_malam.jpg'); ?>" class="img-fluid" alt="">
				</div>
				<div class="col-lg-6 pt-4 pt-lg-0 content" data-aos="fade-left">
					<h3>Komitmen RSUD Genteng adalah memberikan pelayanan kesehatan yang terbaik dan berorientasi pada pasien.
					</h3>
					<!-- <p class="fst-italic">
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
              dolore
              magna aliqua.
            </p> -->
					<ul>
						<li><i class="bi bi-check-circle"></i>Cepat.</li>
						<li><i class="bi bi-check-circle"></i>Aman</li>
						<li><i class="bi bi-check-circle"></i>Nyaman</li>
						<li><i class="bi bi-check-circle"></i>Tepat</li>
						<li><i class="bi bi-check-circle"></i>Informatif</li>
						<li><i class="bi bi-check-circle"></i>Komunikatif</li>

					</ul>
					<p>
						Terwujudnya Masyarakat Banyuwangi yang Semakin Sejahtera, Mandiri, dan Berakhlak Mulia Melalui Peningkatan
						Perekonomian
						dan Kualitas Sumber Daya Manusia Visi kami
						Misi : Mewujudkan Aksesibilitas dan Kualitas Pelayanan Bidang Pendidikan, Kesehatan dan Kebutuhan Dasar
						Lainnya
					</p>
				</div>
			</div>

		</div>
	</section><!-- End About Us Section -->

	<!-- ======= Counts Section ======= -->
	<section id="counts" class="counts">
		<div class="container" data-aos="fade-up">

			<div class="row no-gutters">

				<div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
					<div class="count-box">
						<i class="fas fa-user-md"></i>
						<span data-purecounter-start="0" data-purecounter-end="24" data-purecounter-duration="1" class="purecounter"></span>

						<p><strong>Dokter</strong> spesialis yang
							terampil dan berpengalaman dalam memberikan pelayanan kesehatan</p>
						<!-- <a href="#">Find out more &raquo;</a> -->
					</div>
				</div>

				<div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
					<div class="count-box">
						<i class="far fa-hospital"></i>
						<span data-purecounter-start="0" data-purecounter-end="22" data-purecounter-duration="1" class="purecounter"></span>
						<p><strong>Poliklinik</strong> untuk melayani berbagai penyakit</p>

					</div>
				</div>

				<div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
					<div class="count-box">
						<i class="fas fa-user-nurse"></i>
						<span data-purecounter-start="0" data-purecounter-end="189" data-purecounter-duration="1" class="purecounter"></span>
						<p><strong>Paramedis</strong> dalam memberikan pelayanan kesehatan</p>

					</div>
				</div>

				<div class="col-lg-3 col-md-6 d-md-flex align-items-md-stretch">
					<div class="count-box">
						<i class="fas fa-bed-pulse"></i>
						<span data-purecounter-start="0" data-purecounter-end="165" data-purecounter-duration="1" class="purecounter"></span>
						<p><strong>Tempat Tidur</strong> yang ada didalam rumah sakit</p>

					</div>
				</div>

			</div>

		</div>
	</section><!-- End Counts Section -->
	<!-- ======= Appointment Section ======= -->
	<section id="appointment" class="appointment section-bg">
		<div class="container" data-aos="fade-up">

			<div class="section-title">
				<h2>Artikel</h2>
			</div>
			<div class="container">
				<div class="row">
					<?php foreach ($artikel as $value) { ?>
						<div class="col-sm-6 col-md-4">
							<div class="card fixed-artikel">
								<img src="<?= base_url('gambar/artikel/') . $value->sampul ?>" 
									 class="card-img-top lazy" 
									 data-src="<?= base_url('gambar/artikel/') . $value->sampul ?>"
									 style="height: 250px;" 
									 alt="<?= htmlspecialchars($value->judul) ?>">
								<div class="card-body">
									<h5 class="card-title"><?= htmlspecialchars($value->judul) ?></h5>
									<a href="<?= base_url('berita/read/') . $value->id ?>" class="btn btn-primary">Lihat Selengkapnya</a>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
				
				<div class="text-center mt-4">
					<a href="<?= base_url('berita') ?>" class="btn btn-primary btn-lg">
						Lihat Semua Artikel
						<i class="fas fa-arrow-right ms-2"></i>
					</a>
				</div>
			</div>
		</div>
	</section><!-- End Appointment Section -->
	<section id="appointment" class="appointment section-bg">
		<div class="container" data-aos="fade-up">

			<div class="section-title">
				<h2>Media Sosial</h2>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-sm-6 col-md-4">
						<div class="card fixed-ig">
							<blockquote class="instagram-media" data-instgrm-permalink="https://www.instagram.com/reel/DFmBslXzHpG/?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);">
								<div style="padding:16px;"> <a href="https://www.instagram.com/reel/DFmBslXzHpG/?utm_source=ig_embed&amp;utm_campaign=loading" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank">
										<div style=" display: flex; flex-direction: row; align-items: center;">
											<div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div>
											<div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;">
												<div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div>
												<div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div>
											</div>
										</div>
										<div style="padding: 19% 0;"></div>
										<div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink">
												<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
													<g transform="translate(-511.000000, -20.000000)" fill="#000000">
														<g>
															<path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path>
														</g>
													</g>
												</g>
											</svg></div>
										<div style="padding-top: 8px;">
											<div style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">View this post on Instagram</div>
										</div>
										<div style="padding: 12.5% 0;"></div>
										<div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;">
											<div>
												<div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div>
												<div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div>
												<div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div>
											</div>
											<div style="margin-left: 8px;">
												<div style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div>
												<div style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div>
											</div>
											<div style="margin-left: auto;">
												<div style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div>
												<div style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div>
												<div style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div>
											</div>
										</div>
										<div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;">
											<div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div>
											<div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div>
										</div>
									</a>
									<p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;"><a href="https://www.instagram.com/reel/DFmBslXzHpG/?utm_source=ig_embed&amp;utm_campaign=loading" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">A post shared by RSUD Genteng Banyuwangi (@rsudgenteng.bwi)</a></p>
								</div>
							</blockquote>
						</div>
					</div>
					<div class="col-sm-6 col-md-4">
						<div class="card fixed-ig">
							<blockquote class="instagram-media" data-instgrm-permalink="https://www.instagram.com/p/DFMD_iQTKMV/?utm_source=ig_embed&amp;utm_campaign=loading" data-instgrm-version="14" style=" background:#FFF; border:0; border-radius:3px; box-shadow:0 0 1px 0 rgba(0,0,0,0.5),0 1px 10px 0 rgba(0,0,0,0.15); margin: 1px; max-width:540px; min-width:326px; padding:0; width:99.375%; width:-webkit-calc(100% - 2px); width:calc(100% - 2px);"><div style="padding:16px;"> <a href="https://www.instagram.com/p/DFMD_iQTKMV/?utm_source=ig_embed&amp;utm_campaign=loading" style=" background:#FFFFFF; line-height:0; padding:0 0; text-align:center; text-decoration:none; width:100%;" target="_blank"> <div style=" display: flex; flex-direction: row; align-items: center;"> <div style="background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 40px; margin-right: 14px; width: 40px;"></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 100px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 60px;"></div></div></div><div style="padding: 19% 0;"></div> <div style="display:block; height:50px; margin:0 auto 12px; width:50px;"><svg width="50px" height="50px" viewBox="0 0 60 60" version="1.1" xmlns="https://www.w3.org/2000/svg" xmlns:xlink="https://www.w3.org/1999/xlink"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g transform="translate(-511.000000, -20.000000)" fill="#000000"><g><path d="M556.869,30.41 C554.814,30.41 553.148,32.076 553.148,34.131 C553.148,36.186 554.814,37.852 556.869,37.852 C558.924,37.852 560.59,36.186 560.59,34.131 C560.59,32.076 558.924,30.41 556.869,30.41 M541,60.657 C535.114,60.657 530.342,55.887 530.342,50 C530.342,44.114 535.114,39.342 541,39.342 C546.887,39.342 551.658,44.114 551.658,50 C551.658,55.887 546.887,60.657 541,60.657 M541,33.886 C532.1,33.886 524.886,41.1 524.886,50 C524.886,58.899 532.1,66.113 541,66.113 C549.9,66.113 557.115,58.899 557.115,50 C557.115,41.1 549.9,33.886 541,33.886 M565.378,62.101 C565.244,65.022 564.756,66.606 564.346,67.663 C563.803,69.06 563.154,70.057 562.106,71.106 C561.058,72.155 560.06,72.803 558.662,73.347 C557.607,73.757 556.021,74.244 553.102,74.378 C549.944,74.521 548.997,74.552 541,74.552 C533.003,74.552 532.056,74.521 528.898,74.378 C525.979,74.244 524.393,73.757 523.338,73.347 C521.94,72.803 520.942,72.155 519.894,71.106 C518.846,70.057 518.197,69.06 517.654,67.663 C517.244,66.606 516.755,65.022 516.623,62.101 C516.479,58.943 516.448,57.996 516.448,50 C516.448,42.003 516.479,41.056 516.623,37.899 C516.755,34.978 517.244,33.391 517.654,32.338 C518.197,30.938 518.846,29.942 519.894,28.894 C520.942,27.846 521.94,27.196 523.338,26.654 C524.393,26.244 525.979,25.756 528.898,25.623 C532.057,25.479 533.004,25.448 541,25.448 C548.997,25.448 549.943,25.479 553.102,25.623 C556.021,25.756 557.607,26.244 558.662,26.654 C560.06,27.196 561.058,27.846 562.106,28.894 C563.154,29.942 563.803,30.938 564.346,32.338 C564.756,33.391 565.244,34.978 565.378,37.899 C565.522,41.056 565.552,42.003 565.552,50 C565.552,57.996 565.522,58.943 565.378,62.101 M570.82,37.631 C570.674,34.438 570.167,32.258 569.425,30.349 C568.659,28.377 567.633,26.702 565.965,25.035 C564.297,23.368 562.623,22.342 560.652,21.575 C558.743,20.834 556.562,20.326 553.369,20.18 C550.169,20.033 549.148,20 541,20 C532.853,20 531.831,20.033 528.631,20.18 C525.438,20.326 523.257,20.834 521.349,21.575 C519.376,22.342 517.703,23.368 516.035,25.035 C514.368,26.702 513.342,28.377 512.574,30.349 C511.834,32.258 511.326,34.438 511.181,37.631 C511.035,40.831 511,41.851 511,50 C511,58.147 511.035,59.17 511.181,62.369 C511.326,65.562 511.834,67.743 512.574,69.651 C513.342,71.625 514.368,73.296 516.035,74.965 C517.703,76.634 519.376,77.658 521.349,78.425 C523.257,79.167 525.438,79.673 528.631,79.82 C531.831,79.965 532.853,80.001 541,80.001 C549.148,80.001 550.169,79.965 553.369,79.82 C556.562,79.673 558.743,79.167 560.652,78.425 C562.623,77.658 564.297,76.634 565.965,74.965 C567.633,73.296 568.659,71.625 569.425,69.651 C570.167,67.743 570.674,65.562 570.82,62.369 C570.966,59.17 571,58.147 571,50 C571,41.851 570.966,40.831 570.82,37.631"></path></g></g></g></svg></div><div style="padding-top: 8px;"> <div style=" color:#3897f0; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:550; line-height:18px;">View this post on Instagram</div></div><div style="padding: 12.5% 0;"></div> <div style="display: flex; flex-direction: row; margin-bottom: 14px; align-items: center;"><div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(0px) translateY(7px);"></div> <div style="background-color: #F4F4F4; height: 12.5px; transform: rotate(-45deg) translateX(3px) translateY(1px); width: 12.5px; flex-grow: 0; margin-right: 14px; margin-left: 2px;"></div> <div style="background-color: #F4F4F4; border-radius: 50%; height: 12.5px; width: 12.5px; transform: translateX(9px) translateY(-18px);"></div></div><div style="margin-left: 8px;"> <div style=" background-color: #F4F4F4; border-radius: 50%; flex-grow: 0; height: 20px; width: 20px;"></div> <div style=" width: 0; height: 0; border-top: 2px solid transparent; border-left: 6px solid #f4f4f4; border-bottom: 2px solid transparent; transform: translateX(16px) translateY(-4px) rotate(30deg)"></div></div><div style="margin-left: auto;"> <div style=" width: 0px; border-top: 8px solid #F4F4F4; border-right: 8px solid transparent; transform: translateY(16px);"></div> <div style=" background-color: #F4F4F4; flex-grow: 0; height: 12px; width: 16px; transform: translateY(-4px);"></div> <div style=" width: 0; height: 0; border-top: 8px solid #F4F4F4; border-left: 8px solid transparent; transform: translateY(-4px) translateX(8px);"></div></div></div> <div style="display: flex; flex-direction: column; flex-grow: 1; justify-content: center; margin-bottom: 24px;"> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; margin-bottom: 6px; width: 224px;"></div> <div style=" background-color: #F4F4F4; border-radius: 4px; flex-grow: 0; height: 14px; width: 144px;"></div></div></a><p style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; line-height:17px; margin-bottom:0; margin-top:8px; overflow:hidden; padding:8px 0 7px; text-align:center; text-overflow:ellipsis; white-space:nowrap;"><a href="https://www.instagram.com/p/DFMD_iQTKMV/?utm_source=ig_embed&amp;utm_campaign=loading" style=" color:#c9c8cd; font-family:Arial,sans-serif; font-size:14px; font-style:normal; font-weight:normal; line-height:17px; text-decoration:none;" target="_blank">A post shared by RSUD Genteng Banyuwangi (@rsudgenteng.bwi)</a></p></div></blockquote>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section><!-- End Appointment Section -->
	<!-- ======= Departments Section ======= -->

	<!-- ======= Doctors Section ======= -->
	<!-- Doctors Section -->
	<section id="doctors" class="doctors section-bg" aria-label="Tim Dokter">
		<div class="container">
			<div class="section-title">
				<h2>Tim Dokter Spesialis</h2>
				<p>Tim dokter spesialis kami memiliki pengalaman dan keahlian dalam berbagai bidang medis untuk memberikan pelayanan kesehatan terbaik.</p>
			</div>

			<div class="row">
				<?php foreach ($dokters as $dokter) : ?>
					<div class="col-md-4 mb-4">
						<article class="card h-100 doctor-card">
							<img src="<?= base_url("gambar/dokter/") . $dokter->img ?>" 
								 class="card-img-top lazy" 
								 data-src="<?= base_url("gambar/dokter/") . $dokter->img ?>"
								 alt="<?= htmlspecialchars($dokter->nama) ?>"
								 width="400" height="300">
							<div class="card-body member-info">
								<h3 class="card-title h5"><?= htmlspecialchars($dokter->nama) ?></h3>
								<p class="card-text"><?= htmlspecialchars($dokter->spesialis) ?></p>
								<a href="<?= base_url('medis/detail/') . $dokter->id ?>" 
								   class="btn btn-outline-primary btn-sm">Lihat Detail</a>
							</div>
						</article>
					</div>
				<?php endforeach; ?>
			</div>

			<div class="text-center mt-4">
				<a href="<?= base_url("medis") ?>" class="btn btn-primary">
					Lihat Semua Dokter
					<i class="fas fa-arrow-right ms-2"></i>
				</a>
			</div>
		</div>
	</section>



	<!-- Gallery Section -->
	<section id="gallery" class="gallery" aria-label="Galeri Kegiatan">
		<div class="container">
			<div class="section-title">
				<h2>Galeri Kegiatan</h2>
				<p>Dokumentasi kegiatan dan pelayanan RSUD Genteng</p>
			</div>

			<div class="gallery-slider swiper">
				<div class="swiper-wrapper align-items-center">
					<?php foreach ($galeri as $key => $gal) { ?>
						<div class="swiper-slide">
							<a class="gallery-lightbox" 
							   href="<?= base_url('gambar/galeri/' . $gal->img_galeri) ?>" 
							   title="<?= htmlspecialchars($gal->judul ?? 'Kegiatan RSUD Genteng') ?>">
								<img src="<?= base_url('assets/front/img/placeholder-gallery.jpg') ?>" 
									 data-src="<?= base_url('gambar/galeri/' . $gal->img_galeri) ?>"
									 class="img-fluid lazy"
									 alt="<?= htmlspecialchars($gal->judul ?? 'Kegiatan RSUD Genteng') ?>"
									 width="800" height="600">
							</a>
						</div>
					<?php } ?>
				</div>
				<div class="swiper-pagination"></div>
				<div class="swiper-button-prev"></div>
				<div class="swiper-button-next"></div>
			</div>
		</div>
	</section>



	<!-- FAQ Section -->
	<section id="faq" class="faq section-bg" aria-label="Pertanyaan Umum">
		<div class="container">
			<div class="section-title">
				<h2>Pertanyaan yang Sering Diajukan</h2>
				<p>Informasi umum yang sering ditanyakan oleh pasien RSUD Genteng</p>
			</div>

			<div class="accordion" id="faqAccordion">
				<div class="accordion-item">
					<h3 class="accordion-header">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
							Apa yang harus saya lakukan jika membutuhkan perawatan medis di RSUD Genteng?
						</button>
					</h3>
					<div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
						<div class="accordion-body">
							<p>Anda dapat mengunjungi RSUD Genteng langsung atau menghubungi layanan informasi dan pendaftaran untuk mendapatkan petunjuk lebih lanjut tentang cara menerima perawatan medis.</p>
						</div>
					</div>
				</div>

				<div class="accordion-item">
					<h3 class="accordion-header">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
							Bagaimana cara membuat janji dengan dokter spesialis?
						</button>
					</h3>
					<div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
						<div class="accordion-body">
							<p>Anda dapat membuat janji dengan dokter spesialis melalui:</p>
							<ul>
								<li>Sistem pendaftaran online di <a href="https://rsudgenteng.id:8888/e-reservasi/">e-reservasi RSUD Genteng</a></li>
								<li>Menghubungi layanan pendaftaran di (0333) 845839</li>
								<li>Datang langsung ke loket pendaftaran RSUD Genteng</li>
							</ul>
						</div>
					</div>
				</div>

				<div class="accordion-item">
					<h3 class="accordion-header">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
							Bagaimana cara menghubungi layanan IGD dalam situasi darurat?
						</button>
					</h3>
					<div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
						<div class="accordion-body">
							<p>Untuk situasi darurat, Anda dapat:</p>
							<ul>
								<li>Menghubungi hotline IGD: <a href="tel:+628113439904">+62 811-3439-904</a></li>
								<li>Langsung menuju IGD RSUD Genteng yang buka 24 jam</li>
							</ul>
						</div>
					</div>
				</div>

				<div class="accordion-item">
					<h3 class="accordion-header">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
							Apakah RSUD Genteng buka 24 jam?
						</button>
					</h3>
					<div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
						<div class="accordion-body">
							<p>Ya, IGD RSUD Genteng beroperasi 24 jam setiap hari termasuk hari libur untuk menangani kasus darurat.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Contact Section -->
	<section id="contact" class="contact" aria-label="Kontak dan Lokasi">
		<div class="container">
			<div class="section-title">
				<h2>Lokasi dan Kontak</h2>
				<p>Temukan kami di pusat kota Genteng, Banyuwangi</p>
			</div>

			<div class="row gy-4">
				<div class="col-lg-6">
					<div class="map-container">
						<iframe 
							src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3947.36612391686!2d114.16167411421677!3d-8.365597886634978!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd155233b0568df%3A0xbdb65442f3878c9d!2sRumah+Sakit+Umum+Daerah+(RSUD)+Genteng!5e0!3m2!1sen!2sid!4v1503459515647"
							style="border:0; width: 100%; height: 350px;"
							loading="lazy"
							referrerpolicy="no-referrer-when-downgrade"
							title="Lokasi RSUD Genteng di Google Maps"
							allowfullscreen>
						</iframe>
					</div>
				</div>

				<div class="col-lg-6">
					<div class="contact-info">
						<div class="info-item">
							<i class="fas fa-map-marker-alt"></i>
							<div>
								<h3>Alamat</h3>
								<p>Jl. HASANUDIN 98<br>GENTENG - BANYUWANGI, 68465</p>
							</div>
						</div>

						<div class="info-item">
							<i class="fas fa-envelope"></i>
							<div>
								<h3>Email</h3>
								<p><a href="mailto:rsudgenteng@banyuwangikab.go.id">rsudgenteng@banyuwangikab.go.id</a></p>
							</div>
						</div>

						<div class="info-item">
							<i class="fas fa-phone-alt"></i>
							<div>
								<h3>Telepon</h3>
								<p>
									<a href="tel:+623338458390">(0333) 845839</a><br>
									IGD: <a href="tel:+628113439904">+62 811-3439-904</a>
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

</main>

<!-- Performance Optimization Scripts -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Lazy loading for images
    const lazyImages = document.querySelectorAll('img.lazy');
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                img.src = img.dataset.src;
                img.classList.add('loaded');
                observer.unobserve(img);
            }
        });
    });

    lazyImages.forEach(img => imageObserver.observe(img));

    // Preload critical images
    const criticalImages = [
        '<?= base_url("assets/front/img/rs_malam.jpg") ?>',
        '<?= base_url("assets/front/img/placeholder.jpg") ?>'
    ];
    criticalImages.forEach(src => {
        const img = new Image();
        img.src = src;
    });

    // Remove AOS animations on mobile for better performance
    if (window.innerWidth < 768) {
        const aosElements = document.querySelectorAll('[data-aos]');
        aosElements.forEach(el => el.removeAttribute('data-aos'));
    }

    // Add smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});

// Optimize third-party script loading
function loadScript(src, async = true) {
    const script = document.createElement('script');
    script.src = src;
    script.async = async;
    document.body.appendChild(script);
}

// Load non-critical scripts after page load
window.addEventListener('load', function() {
    // Load Instagram embed script only if needed
    if (document.querySelector('.instagram-media')) {
        loadScript('//www.instagram.com/embed.js');
    }
});
</script>

<!-- Preconnect to external domains -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://maps.googleapis.com">
