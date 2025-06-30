

<!-- SEO Meta Tags -->
<meta name="description" content="<?= $description ?>">
<meta name="keywords" content="<?= $keywords ?>">
<meta property="og:title" content="<?= $title ?>">
<meta property="og:description" content="<?= $description ?>">
<meta property="og:type" content="website">
<meta property="og:image" content="<?= base_url('assets/img/doctors-team.jpg') ?>">

<main id="main">
<br>
<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Tim Dokter Spesialis dan Umum</h2>
            <ol>
                <li><a href="<?= base_url() ?>">Beranda</a></li>
                <li>Tim Dokter</li>
            </ol>
        </div>
    </div>
</section>

<section id="doctors" class="doctors">
    <div class="container">
        <!-- Filter Section -->
        <div class="row mb-5">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="filterSpesialisasi">Filter berdasarkan Spesialisasi:</label>
                    <select class="form-control" id="filterSpesialisasi">
                        <option value="">Semua Spesialisasi</option>
                        <?php foreach ($spesialisasi as $s): ?>
                            <option value="<?= $s->spesialis ?>"><?= $s->spesialis ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="searchDokter">Cari Dokter:</label>
                    <input type="text" class="form-control" id="searchDokter" placeholder="Masukkan nama dokter...">
                </div>
            </div>
        </div>

        <!-- Doctors Grid -->
        <div class="row" id="doctorsGrid">
            <?php foreach ($dokter as $d): ?>
                <div class="col-lg-4 col-md-6 mb-4 doctor-card"
                     data-spesialisasi="<?= strtolower($d->spesialis) ?>"
                     data-nama="<?= strtolower($d->nama) ?>">
                    <div class="card h-100">
                        <div class="card-img-wrapper">
                            <div class="doctor-image-wrapper">
                                <img src="<?= base_url('assets/img/placeholder-doctor.jpg') ?>"
                                     class="card-img-top lazy"
                                     data-src="<?= base_url('gambar/dokter/' . ($d->img ?? 'placeholder-doctor.jpg')) ?>"
                                     alt="<?= htmlspecialchars($d->nama, ENT_QUOTES, 'UTF-8') ?>"
                                     loading="lazy">
                            </div>
                            <div class="img-overlay">
                                <a href="<?= site_url('Medis/detail/' . $d->id) ?>" class="btn btn-primary">Lihat Detail</a>
                            </div>
                        </div>
                        <div class="card-body text-center">
                            <h3 class="card-title h5"><?= $d->nama ?></h3>
                            <p class="card-text text-muted"><?= $d->spesialis ?></p>
                            <div class="doctor-schedule mt-3 pt-3 border-top px-3">
                                <?php if (!empty($d->jadwal)): ?>
                                    <?php foreach ($d->jadwal as $jadwal): ?>
                                        <div class="schedule-item mb-2 d-flex justify-content-between">
                                            <small class="text-primary mb-0">
                                                <i class="fas fa-calendar-alt me-1"></i>
                                                <?= $jadwal['hari_awal'] === $jadwal['hari_akhir']
                                                    ? $jadwal['hari_awal']
                                                    : $jadwal['hari_awal'] . ' - ' . $jadwal['hari_akhir'] ?>
                                            </small>
                                            <small class="text-muted mb-0">
                                                <i class="fas fa-clock me-1"></i>
                                                <?= substr($jadwal['jam_mulai'], 0, 5) ?> - <?= substr($jadwal['jam_selesai'], 0, 5) ?>
                                            </small>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <small class="text-muted">Tidak ada jadwal</small>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div id="noResults" class="text-center py-5 d-none">
            <h3>Tidak ada dokter yang ditemukan</h3>
            <p>Silakan coba dengan kata kunci lain</p>
        </div>
    </div>
</section>
</main>

<!-- Styles dan Script sama seperti versi kamu sebelumnya -->
