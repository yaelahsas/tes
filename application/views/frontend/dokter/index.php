<style>
	.card {
		border: none;
		border-radius: 10px;
		overflow: hidden;
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
		transition: transform 0.3s ease, box-shadow 0.3s ease;
	}

	.card:hover {
		transform: translateY(-10px);
		box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
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

	/* Shimmer effect */
	.shimmer {
		background: linear-gradient(to right,
				#f6f7f8 0%,
				#edeef1 20%,
				#f6f7f8 40%,
				#f6f7f8 100%);
		background-size: 200% 100%;
		animation: shimmer 1.5s infinite linear;
	}

	@keyframes shimmer {
		0% {
			background-position: 200% 0;
		}

		100% {
			background-position: -200% 0;
		}
	}

	.lozad {
		display: block;
		width: 100%;
		object-fit: cover;
	}
</style>
<script src="https://cdn.jsdelivr.net/npm/lozad@1.14.0/dist/lozad.min.js"></script>

<section class="breadcrumbs">
	<div class="container">

		<div class="d-flex justify-content-between align-items-center">


		</div>
</section><!-- End Breadcrumbs Section -->
<section class="inner-page">
	<div class="section-title">
		<h2>Dokter Kami</h2>

	</div>
	<div class="container mt-5">
		<div class="row">

			<?php foreach ($dokters as $key => $dokter) { ?>
				<div class="col-md-4 mb-4">
					<div class="card">
						<img src="<?= base_url("assets/img/avatar/avatar-5.png") ?>" data-src="<?= base_url("gambar/dokter/") . $dokter->img ?>" class="card-img-top lozad shimmer" alt="<?= $dokter->nama ?>">
						<div class="card-body member-info">
							<h4 class="card-title"><?= $dokter->nama ?></h4>
							<p class="card-text"><?= $dokter->spesialis ?></p>
						</div>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</section>
<script>
	document.addEventListener('DOMContentLoaded', function() {
		const observer = lozad('.lozad', {
			loaded: function(el) {
				el.classList.remove('shimmer');
			}
		});
		observer.observe();
	});
</script>