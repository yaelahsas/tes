<!-- SEO Meta Tags -->
<meta name="description" content="<?= $description ?>">
<meta name="keywords" content="<?= $keywords ?>">
<meta property="og:title" content="<?= $title ?>">
<meta property="og:description" content="<?= $description ?>">
<meta property="og:type" content="website">
<meta property="og:image" content="<?= base_url('assets/img/doctors-team.jpg') ?>">

<main id="main">
    <!-- Breadcrumbs -->
    <section class="breadcrumbs">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h2>Tim Dokter Spesialis</h2>
                <ol>
                    <li><a href="<?= base_url() ?>">Beranda</a></li>
                    <li>Tim Dokter</li>
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
                        <label for="filterSpesialisasi">Filter berdasarkan Spesialisasi:</label>
                        <select class="form-control" id="filterSpesialisasi">
                            <option value="">Semua Spesialisasi</option>
                            <?php foreach ($spesialisasi as $s) : ?>
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
                <?php foreach ($dokter as $d) : ?>
                    <div class="col-lg-4 col-md-6 mb-4 doctor-card" 
                         data-spesialisasi="<?= $d->spesialis ?>" 
                         data-nama="<?= $d->nama ?>">
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
                                    <a href="#" 
                                       class="btn btn-primary">Lihat Detail</a>
                                </div>
                            </div>
                            <div class="card-body text-center">
                                <h3 class="card-title h5"><?= $d->nama ?></h3>
                                <p class="card-text text-muted"><?= $d->spesialis ?></p>
                                <div class="doctor-schedule">
                                    <small class="d-block mb-2">
                                        <i class="fas fa-calendar-alt"></i> 
                                        <!-- Jadwal Praktik: <?= $d->hari_praktik ?> -->
                                    </small>
                                    <small>
                                        <i class="fas fa-clock"></i>
                                        <!-- <?= $d->jam_mulai ?> - <?= $d->jam_selesai ?> -->
                                    </small>
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
    const filterSelect = document.getElementById('filterSpesialisasi');
    const searchInput = document.getElementById('searchDokter');
    const noResults = document.getElementById('noResults');

    function filterDoctors() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedSpesialisasi = filterSelect.value.toLowerCase();
        let hasResults = false;

        doctorCards.forEach(card => {
            const nama = card.dataset.nama.toLowerCase();
            const spesialisasi = card.dataset.spesialisasi.toLowerCase();
            
            const matchesSearch = nama.includes(searchTerm);
            const matchesFilter = !selectedSpesialisasi || spesialisasi === selectedSpesialisasi;

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
});
</script>
