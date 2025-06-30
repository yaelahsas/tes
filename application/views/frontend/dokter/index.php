<!-- SEO Meta Tags -->
<meta name="description" content="<?= $description ?>">
<meta name="keywords" content="<?= $keywords ?>">
<meta property="og:title" content="<?= $title ?>">
<meta property="og:description" content="<?= $description ?>">
<meta property="og:type" content="website">
<meta property="og:image" content="<?= base_url('assets/img/doctors-team.jpg') ?>">

<main id="main">
<br>
    <!-- Breadcrumbs -->
    <section class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Dokter Spesialis dan Umum</h2>
                <ol>
                    <li><a href="<?= base_url() ?>">Beranda</a></li>
                    <li>Dokter</li>
                </ol>
            </div>
        </div>
    </section>

    <!-- Doctors Section -->
    <section id="doctors" class="doctors">
        <div class="container">
            <!-- Filter Section -->
            <div class="row mb-5">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="filterPoli">Filter berdasarkan Poli:</label>
                        <select class="form-control" id="filterPoli">
                            <option value="">Semua Poli</option>
                            <?php 
                            $unique_poli = array_unique(array_column($dokter, 'poli'));
                            foreach ($unique_poli as $poli) : ?>
                                <option value="<?= $poli ?>"><?= $poli ?></option>
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
                <?php foreach ($dokter as $d) : ?>
                    <div class="col-lg-4 col-md-6 mb-4 doctor-card" 
                         data-spesialisasi="<?= $d->spesialis ?>" 
                         data-nama="<?= $d->nama ?>"
						 data-poli="<?= $d->poli ?>">
                        <div class="card h-100">
                            <div class="card-img-wrapper">
                                <!-- Lazy loading with blur-up technique -->
                                <div class="doctor-image-wrapper">
                                    <img src="<?= base_url('assets/img/placeholder-doctor.jpg') ?>"
                                         class="card-img-top lazy"
                                         data-src="<?= base_url('gambar/dokter/') . $d->img ?>"
                                         alt="<?= htmlspecialchars($d->nama) ?>"
                                         style="width: 100%; height: auto; display: block;">
                                </div>
                                <div class="img-overlay">
                                    <a href="<?= site_url('Medis/detail/' . $d->id) ?>" 
                                       class="btn btn-primary">Lihat Detail</a>
                                </div>
                            </div>
                            <div class="card-body text-center">
                                <h3 class="card-title h5"><?= $d->nama ?></h3>
                                <div class="poli-badge-container mb-3">
                                    <span class="poli-badge">
                                        <i class="fas fa-hospital-alt"></i>
                                        <?= $d->poli ?>
                                    </span>
                                </div>
                            <div class="doctor-schedule mt-3 pt-3 border-top px-3">
                                <?php if ($d->id == 12): ?>
                                    <div class="schedule-item mb-2 text-center">
                                        <small class="text-primary mb-0">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            Dengan Perjanjian
                                        </small>
                                    </div>
                                <?php elseif (!empty($d->jadwal)): ?>
                                    <?php foreach ($d->jadwal as $jadwal): ?>
                                        <div class="schedule-item mb-2 d-flex justify-content-between">
                                            <small class="text-primary mb-0">
                                                <i class="fas fa-calendar-alt me-1"></i>
                                                <?php
                                                    if ($jadwal['hari_awal'] == $jadwal['hari_akhir']) {
                                                        echo $jadwal['hari_awal'];
                                                    } else {
                                                        echo $jadwal['hari_awal'] . ' - ' . $jadwal['hari_akhir'];
                                                    }
                                                ?>
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

            <!-- No Results Message -->
            <div id="noResults" class="text-center py-5 d-none">
                <h3>Tidak ada dokter yang ditemukan</h3>
                <p>Silakan coba dengan kata kunci lain</p>
            </div>
        </div>
    </section>
</main>

<!-- Custom Styles -->
<style>
    .doctor-card .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        border-radius: 15px;
        overflow: hidden;
    }

    .doctor-card .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .doctor-image-wrapper {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
    }

    .doctor-image-wrapper img {
        width: 100%;
        height: auto;
        display: block;
        transition: transform 0.3s ease;
    }

    .card-img-wrapper:hover img {
        transform: scale(1.05);
    }

    .img-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .card-img-wrapper:hover .img-overlay {
        opacity: 1;
    }

    .doctor-schedule {
        padding-top: 1rem;
        border-top: 1px solid #eee;
        margin-top: 1rem;
    }

    /* Poli Badge Styles */
    .poli-badge-container {
        margin: 0.75rem 0;
    }

    .poli-badge {
        display: inline-block;
        background: #3fbbc0;
        color: white;
        padding: 8px 16px;
        border-radius: 25px;
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 15px rgba(63, 187, 192, 0.3);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .poli-badge::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }

    .poli-badge:hover::before {
        left: 100%;
    }

    .poli-badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(63, 187, 192, 0.4);
    }

    .poli-badge i {
        margin-right: 6px;
        font-size: 0.8rem;
    }


    /* Lazy Loading Styles */
    .lazy {
        opacity: 0;
        transition: opacity 0.3s ease-in;
    }

    .lazy.loaded {
        opacity: 1;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .doctor-card {
            margin-bottom: 2rem;
        }
        
        .poli-badge {
            font-size: 0.8rem;
            padding: 6px 12px;
        }
    }
</style>

<!-- Custom Scripts -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Lazy Loading Implementation
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

    // Filter and Search Implementation
    const doctorCards = document.querySelectorAll('.doctor-card');
    const filterSelect = document.getElementById('filterPoli');
    const searchInput = document.getElementById('searchDokter');
    const noResults = document.getElementById('noResults');

    function filterDoctors() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedPoli = filterSelect.value.toLowerCase();
        let hasResults = false;

        doctorCards.forEach(card => {
            const nama = card.dataset.nama.toLowerCase();
            const poli = card.dataset.poli.toLowerCase();
            
            const matchesSearch = nama.includes(searchTerm);
            const matchesFilter = !selectedPoli || poli === selectedPoli;

            if (matchesSearch && matchesFilter) {
                card.style.display = '';
                hasResults = true;
            } else {
                card.style.display = 'none';
            }
        });

        noResults.classList.toggle('d-none', hasResults);
    }

    filterSelect.addEventListener('change', filterDoctors);
    searchInput.addEventListener('input', filterDoctors);

    // Preload critical images
    const criticalImages = [
        '<?= base_url("assets/img/placeholder-doctor.jpg") ?>'
    ];
    criticalImages.forEach(src => {
        const img = new Image();
        img.src = src;
    });

    // Keep all poli badges with the same color #3fbbc0 (already set in CSS)
    const poliBadges = document.querySelectorAll('.poli-badge');
    
    poliBadges.forEach((badge, index) => {
        // Add pulse animation on hover
        badge.addEventListener('mouseenter', function() {
            this.style.animation = 'pulse 0.6s ease-in-out';
        });
        
        badge.addEventListener('mouseleave', function() {
            this.style.animation = '';
        });
    });

    // Add pulse keyframes
    const style = document.createElement('style');
    style.textContent = `
        @keyframes pulse {
            0% { transform: scale(1) translateY(-2px); }
            50% { transform: scale(1.05) translateY(-2px); }
            100% { transform: scale(1) translateY(-2px); }
        }
    `;
    document.head.appendChild(style);
});
</script>
