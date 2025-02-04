<br>
<section class="inner-page">
	<div class="container my-5 iframe-wrapper">
		<?php
		// Deteksi alamat IP lokal
		$localIP = '::1'; // Ganti dengan awalan alamat IP lokal Anda

		// Ambil alamat IP pengunjung saat ini
		$visitorIP = $_SERVER['REMOTE_ADDR'];

		// Set URL berdasarkan deteksi
		if (strpos($visitorIP, $localIP) === 0) {
			$iframeUrl = 'https://10.46.1.6/e-reservasi';
		} else {
			$iframeUrl = 'https://rsudgenteng.id:8888/e-reservasi/';
		}
		?>
		<iframe loading="lazy"
			frameborder="0"
			scrolling="no"
			allowtransparency="true" src="<?php echo $iframeUrl; ?>" width="1500" height="900" frameborder="0" allowfullscreen></iframe>

	</div>


</section>

</main><!-- End #main -->
