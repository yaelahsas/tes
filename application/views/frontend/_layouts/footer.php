	<!-- ======= Footer ======= -->
	<footer id="footer">
		<div class="footer-top">
			<div class="container">
				<div class="row">

					<div class="col-lg-3 col-md-6">
						<div class="footer-info">
							<h3>RSUD Genteng</h3>
							<p>
								Jl. Hasanudin No. 98 Genteng - Banyuwangi <br>
								68465<br><br>
								<strong>Phone:</strong> (0333) 845839 <br>
								<strong>Email:</strong> rsudgenteng@banyuwangikab.go.id<br>
							</p>
							<div class="social-links mt-3">
								<a href="https://twitter.com/rsudgenteng" class="twitter"><i class="fab fa-twitter"></i></a>
								<a href="https://www.facebook.com/rsudgenteng" class="facebook"><i class="fab fa-facebook-f"></i></a>
								<a href="https://www.instagram.com/rsudgenteng.bwi/" class="instagram"><i class="fab fa-instagram"></i></a>
							</div>
						</div>
					</div>


				</div>
			</div>
		</div>

		<div class="container">
			<div class="copyright">
				&copy; Copyright <strong><span>RSUD Genteng</span></strong>. All Rights Reserved
			</div>
			<div class="credits">
				Made with <svg viewBox="0 0 1792 1792" preserveAspectRatio="xMidYMid meet" xmlns="http://www.w3.org/2000/svg" style="height: 0.8rem;">
					<path d="M896 1664q-26 0-44-18l-624-602q-10-8-27.5-26T145 952.5 77 855 23.5 734 0 596q0-220 127-344t351-124q62 0 126.5 21.5t120 58T820 276t76 68q36-36 76-68t95.5-68.5 120-58T1314 128q224 0 351 124t127 344q0 221-229 450l-623 600q-18 18-44 18z" fill="#e25555"></path>
				</svg> <strong>Tim IT RSUD Genteng</strong> 
				</a>
			</div>
		</div>
	</footer><!-- End Footer -->
	<a href="https://wa.me/628113439905?text=Halo,%20saya%20ingin%20mendaftar%20poliklinik%20RSUD%20Genteng" target="_blank" class="daftar-float d-flex align-items-center justify-content-center">
		<img src="<?= base_url('gambar/date.png'); ?>" alt="Pendaftaran Online WhatsApp">
	</a>
	<a href="https://wa.me/6281329651321?text=Halo,%20saya%20ingin%20bertanya%20tentang%20layanan%20RSUD%20Genteng" target="_blank" class="whatsapp-float d-flex align-items-center justify-content-center">
		<img src="<?= base_url('gambar/customer-service.png'); ?>" alt="Pengaduan WhatsApp">
	</a>
	<a href="https://wa.me/628113439904?text=Halo IGD RSUD Genteng,%20Saya%20ingin%20bertanya" target="_blank" class="emergency-float d-flex align-items-center justify-content-center">
		<img src="<?= base_url('gambar/ambulance.png'); ?>" alt="Layanan Darurat WhatsApp">
	</a>
	<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

	<!-- Essential Scripts -->
	<script src="<?php echo base_url('assets/front/vendor/bootstrap/js/bootstrap.bundle.min.js'); ?>"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/lozad/dist/lozad.min.js"></script>
	<script src="<?php echo base_url('assets/front/js/main.min.js'); ?>"></script>

	<?php
	$uri = $this->uri->segment(1);
	$uri2 = $this->uri->segment(2);

	// Homepage specific scripts
	if (!$uri || $uri === 'home' && !$uri2) {
		?>
		<script src="<?php echo base_url('assets/front/vendor/purecounter/purecounter_vanilla.js'); ?>"></script>
		<script src="<?php echo base_url('assets/front/vendor/glightbox/js/glightbox.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/front/vendor/swiper/swiper-bundle.min.js'); ?>"></script>
		<script>
		document.addEventListener('DOMContentLoaded', function() {
			// Initialize Swiper
			new Swiper('.gallery-slider', {
				slidesPerView: 1,
				spaceBetween: 20,
				pagination: {
					el: '.swiper-pagination',
					clickable: true,
				},
				navigation: {
					nextEl: '.swiper-button-next',
					prevEl: '.swiper-button-prev',
				},
				breakpoints: {
					768: {
						slidesPerView: 2,
					},
					992: {
						slidesPerView: 3,
					}
				}
			});

			// Initialize GLightbox
			GLightbox({
				selector: '.gallery-lightbox'
			});

			// Initialize PureCounter
			new PureCounter();
		});
		</script>
		<?php
	}

	// Inovasi page specific scripts
	if ($uri === 'inovasi') {
		echo '<script src="' . base_url('assets/js/custom.js') . '"></script>';
	}
	?>
	</body>

	</html>
