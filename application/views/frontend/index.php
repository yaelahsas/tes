<section id="hero">
	<div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">
		<ol class="carousel-indicators" id="hero-carousel-indicators"></ol>
		<div class="carousel-inner" role="listbox">
			<?php foreach ($profil as $key => $prof) { ?>
				<div class="d-block w-100 carousel-item <?= $key === 0 ? 'active' : '' ?>">
					<img class="d-block w-100 h-100 lozad" data-src="<?= base_url('gambar/profil/') . $prof->img_profil ?>">
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

	<section id="services" class="services services">
		<div class="container" data-aos="fade-up">


			<div class="row">
				<div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="100">

					<div class="icon"><i class="fas fa-calendar-days"></i></div>

					<h4 class="title"><a href="https://rsudgenteng.id:8888/e-reservasi/" target="_blank">Pendaftaran Online</a></h4>

				</div>
				<div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="200">
					<div class="icon"><i class="fas fa-user-doctor"></i></div>
					<h4 class="title"><a href="<?= base_url('home/jadwal_dokter') ?>">Jadwal Dokter & Poliklinik</a></h4>

				</div>

				<div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="300">
					<div class="icon"><i class="fas fa-bed-pulse"></i></div>
					<h4 class="title"><a href="<?php echo base_url('home/tempat_tidur'); ?>" target="_blank">Ketersediaan Bed</a></h4>

				</div>
				<div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="400">
					<div class="icon"><i class="fas fa-envelope"></i></div>
					<h4 class="title"><a href="<?php echo base_url('home/pengaduan'); ?>" target="_blank">Layanan Pengaduan</a></h4>

				</div>
				<div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="500">
					<div class="icon"><i class="fas fa-hand"></i></div>
					<h4 class="title"><a href="#">Whistleblowing System</a></h4>

				</div>
				<div class="col-lg-4 col-md-6 icon-box" data-aos="zoom-in" data-aos-delay="500">
					<div class="icon"><i class="fas fa-bullhorn"></i></div>
					<h4 class="title"><a href="<?php echo base_url('home/maklumat'); ?>" target="_blank">Maklumat</a></h4>

				</div>

			</div>

		</div>
	</section><!-- End Services Section -->
	<!-- ======= Featured Services Section ======= -->
	<section class="featured-services">
		<div class="container">

			<div class="section-title">
				<h2>Layanan Unggulan</h2>
			</div>
			<?php
			$delay = 500; // Mulai dengan delay awal 500
			foreach (array_chunk($layanan, 4) as $row_services) { ?>
				<div class="row">
					<?php foreach ($row_services as $service) { ?>

						<div class="col-md-6 col-lg-3 d-flex align-items-stretch mb-5 mb-lg-0">
							<div class="icon-box" data-aos="fade-up" data-aos-delay="<?= $delay ?>">
								<div class="icon"><img src="<?= base_url('/gambar/layanan/') . $service->img ?>"></div>
								<h4 class="title"><a href=""><?= $service->judul ?></a></h4>
								<p class="description"><?= $service->ket ?></p>
							</div>
						</div>
						<?php
						$delay += 100; // Tambahkan 100 ke delay setiap perulangan
						?>
					<?php } ?>
				</div>
				<br>
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
					<?php foreach ($artikel as  $value) {
					?>
						<div class="col-sm-6 col-md-4">
							<div class="card fixed-artikel">
								<img src="<?php echo base_url('gambar/artikel/') . $value->sampul ?>" class="card-img-top" style="height: 250px;" alt="...">
								<div class="card-body">
									<h5 class="card-title"><?php echo  $value->judul ?></h5>

									<a href="<?= base_url('home/read/') . $value->id ?>" target="_blank" class="btn btn-primary">Lihat Selengkapnya</a>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>


		</div>
	</section><!-- End Appointment Section -->

	<!-- ======= Departments Section ======= -->



	<!-- ======= Doctors Section ======= -->
	<section id="doctors" class="doctors section-bg">
		<div class="container" data-aos="fade-up">

			<div class="section-title">
				<h2>Dokter</h2>
				<p>Dokter spesialis rumah sakit memiliki pengetahuan yang luas dan mendalam tentang kondisi medis tertentu,
					serta mampu melakukan prosedur dan teknik medis yang rumit dan kompleks. Mereka bekerja sama dengan tim
					medis lainnya, seperti perawat, ahli terapi, dan farmasis, untuk memberikan perawatan yang terbaik dan
					terintegrasi bagi pasien.</p>
			</div>

			<div class="gallery-slider swiper">
				<div class="swiper-wrapper align-items-center">
					<?php foreach ($dokters as $key => $dokter) { ?>
						<div class="swiper-slide">
							<div class="member" data-aos="fade-up" data-aos-delay="100">
								<div class="member-img">
									<a class="gallery-lightbox" href="gambar/dokter/<?= $dokter->img ?>">
										<img src="gambar/dokter/<?= $dokter->img ?>" class="img-fluid member-image fixed-height lozad" alt="">
									</a>

								</div>
								<div class="member-info">
									<h4><?= $dokter->nama ?></h4>
									<span><?= $dokter->spesialis ?></span>
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
				<div class="swiper-pagination"></div>
			</div>

		</div>
	</section><!-- End Doctors Section -->



	<!-- ======= Gallery Section ======= -->
	<section id="gallery" class="gallery">
		<div class="container" data-aos="fade-up">

			<div class="section-title">
				<h2>Gallery</h2>
				<p>Beberapa foto kegiatan-kegiatan yang telah dilakukan RSUD Genteng</p>
			</div>

			<div class="gallery-slider swiper">
				<div class="swiper-wrapper align-items-center">
					<?php foreach ($galeri as $key => $gal) { ?>
						<div class="swiper-slide"><a class="gallery-lightbox" href="gambar/galeri/<?= $gal->img_galeri ?>"><img src="gambar/galeri/<?= $gal->img_galeri ?>" class="img-fluid lozad" alt=""></a></div>


					<?php } ?>
				</div>
				<div class="swiper-pagination"></div>
			</div>

		</div>
	</section><!-- End Gallery Section -->



	<!-- ======= Frequently Asked Questioins Section ======= -->
	<section id="faq" class="faq section-bg">
		<div class="container" data-aos="fade-up">

			<div class="section-title">
				<h2>Frequently Asked Questioins</h2>
				<p>Berikut beberapa pertanyaan yang sering ditanyakan oleh pasien.</p>
			</div>

			<ul class="faq-list">

				<li>
					<div data-bs-toggle="collapse" class="collapsed question" href="#faq1">Apa yang harus saya lakukan jika saya membutuhkan perawatan medis di RSUD Genteng ? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
					<div id="faq1" class="collapse" data-bs-parent=".faq-list">
						<p>
							Anda dapat mengunjungi RSUD Genteng langsung atau menghubungi layanan informasi dan pendaftaran untuk mendapatkan petunjuk lebih lanjut tentang cara menerima perawatan medis.
						</p>
					</div>
				</li>

				<li>
					<div data-bs-toggle="collapse" href="#faq2" class="collapsed question">Bagaimana cara membuat janji dengan dokter spesialis di RSUD Genteng? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
					<div id="faq2" class="collapse" data-bs-parent=".faq-list">
						<p>
							Anda dapat membuat janji dengan dokter spesialis di RSUD Genteng dengan menghubungi layanan pendaftaran atau melalui sistem pendaftaran online yang tersedia.
						</p>
					</div>
				</li>

				<li>
					<div data-bs-toggle="collapse" href="#faq3" class="collapsed question">Bagaimana cara menghubungi layanan IGD RSUD Genteng dalam situasi darurat? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
					<div id="faq3" class="collapse" data-bs-parent=".faq-list">
						<p>
							Anda dapat menghubungi nomor darurat RSUD Genteng di +628113439904 untuk mendapatkan bantuan segera.
						</p>
					</div>
				</li>

				<li>
					<div data-bs-toggle="collapse" href="#faq4" class="collapsed question">Apakah RSUD Genteng buka 24 jam? <i class="bi bi-chevron-down icon-show"></i><i class="bi bi-chevron-up icon-close"></i></div>
					<div id="faq4" class="collapse" data-bs-parent=".faq-list">
						<p>
							Ya, IGD RSUD Genteng melayani pasien selama 24 jam.
						</p>
					</div>
				</li>

			</ul>

		</div>
	</section><!-- End Frequently Asked Questioins Section -->

	<!-- ======= Contact Section ======= -->
	<section id="contact" class="contact">
		<div class="container">

			<div class="section-title">
				<h2>Alamat</h2>

			</div>

		</div>

		<div>
			<iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3947.36612391686!2d114.16167411421677!3d-8.365597886634978!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd155233b0568df%3A0xbdb65442f3878c9d!2sRumah+Sakit+Umum+Daerah+(RSUD)+Genteng!5e0!3m2!1sen!2sid!4v1503459515647" frameborder="0" allowfullscreen></iframe>
		</div>

		<div class="container">

			<div class="row mt-5">

				<div class="col-lg-6">

					<div class="row">
						<div class="col-md-12">
							<div class="info-box">
								<i class="bx bx-map"></i>
								<h3>Alamat</h3>
								<p>Jl. HASANUDIN 98 GENTENG - BANYUWANGI, 68465</p>
							</div>
						</div>
						<div class="col-md-6">
							<div class="info-box mt-4">
								<i class="bx bx-envelope"></i>
								<h3>Email</h3>
								<p>rsudgenteng@banyuwangikab.go.id

								</p>
							</div>
						</div>
						<div class="col-md-6">
							<div class="info-box mt-4">
								<i class="bx bx-phone-call"></i>
								<h3>Telepon</h3>
								<p>(0333) 845839 </p>
							</div>
						</div>
					</div>

				</div>

			</div>

		</div>
	</section><!-- End Contact Section -->

</main><!-- End #main -->