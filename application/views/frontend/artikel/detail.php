		<style>
			.article {
				padding-bottom: 20px;
			}

			.article h1 {
				margin-top: 0;
			}

			.article p {
				margin: 10px 0;
			}

			.article img {
				max-width: 50%;
				height: auto;
				display: block;
				margin: 10px auto;
			}
		</style>
		<!-- ======= Breadcrumbs Section ======= -->
		<section class="breadcrumbs">
			<div class="container">

				<div class="d-flex justify-content-between align-items-center">


				</div>
		</section><!-- End Breadcrumbs Section -->

		<section class="inner-page">
			<div class="container">
				<div class="article">
					<h1><?= $judul ?></h1>
					<p><em><?= $tanggal ?></em></p>
					<img src="<?= base_url('gambar/artikel/') . $sampul ?>" alt="Gambar Artikel">
					<?= $isi ?>
				</div>
			</div>



		</section>