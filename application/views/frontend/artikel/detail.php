<!-- ======= Breadcrumbs Section ======= -->
<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2><?= htmlspecialchars($judul) ?></h2>
            <ol>
                <li><a href="<?= base_url() ?>">Home</a></li>
                <li><a href="<?= base_url('berita') ?>">Artikel</a></li>
                <li><?= htmlspecialchars($judul) ?></li>
            </ol>
        </div>
    </div>
</section><!-- End Breadcrumbs Section -->

<section class="blog-detail">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8">
                <article class="blog-detail-content">
                    <!-- Featured Image -->
                    <div class="featured-image">
                        <img src="<?= base_url('gambar/artikel/') . $sampul ?>" 
                             alt="<?= htmlspecialchars($judul) ?>" 
                             class="img-fluid rounded">
                    </div>

                    <!-- Meta Information -->
                    <div class="meta-info mt-4">
                        <span class="date">
                            <i class="bi bi-calendar-event me-2"></i><?= $tanggal ?>
                        </span>
                    </div>

                    <!-- Article Content -->
                    <div class="content mt-4">
                        <?= $isi ?>
                    </div>

                    <!-- Keywords -->
                    <?php if (!empty($keywords)): ?>
                    <div class="keywords mt-4">
                        <h5>Keywords:</h5>
                        <div>
                            <?php foreach ($keywords as $keyword): ?>
                                <a href="<?= base_url('berita?search=' . urlencode($keyword)) ?>" class="badge bg-primary me-1 mb-1"><?= htmlspecialchars($keyword) ?></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Share Buttons -->
                    <div class="share-buttons mt-5">
                        <h5>Bagikan Artikel</h5>
                        <div class="d-flex gap-2 mt-3">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?= current_url() ?>" 
                               class="btn btn-primary" target="_blank">
                                <i class="bi bi-facebook"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url=<?= current_url() ?>&text=<?= urlencode($judul) ?>" 
                               class="btn btn-info text-white" target="_blank">
                                <i class="bi bi-twitter"></i>
                            </a>
                            <a href="https://wa.me/?text=<?= urlencode($judul . ' ' . current_url()) ?>" 
                               class="btn btn-success" target="_blank">
                                <i class="bi bi-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar">
                    <!-- Recent Posts -->
                    <div class="sidebar-item recent-posts">
                        <h3 class="sidebar-title">Artikel Terkait</h3>
                        <div class="mt-3">
                            <?php 
                            // Assuming you pass related_articles from controller
                            if(isset($related_articles)): 
                                foreach($related_articles as $related): 
                            ?>
                            <div class="post-item mt-3">
                                <img src="<?= base_url('gambar/artikel/' . $related->sampul) ?>" 
                                     alt="<?= htmlspecialchars($related->judul) ?>"
                                     class="flex-shrink-0">
                                <div>
                                    <h4>
                                        <a href="<?= base_url('berita/read/' . $related->id) ?>">
                                            <?= htmlspecialchars($related->judul) ?>
                                        </a>
                                    </h4>
                                    <time><?= date('d M Y', strtotime($related->created_at ?? date('Y-m-d'))) ?></time>
                                </div>
                            </div>
                            <?php 
                                endforeach; 
                            endif; 
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.blog-detail {
    padding: 40px 0;
}

.blog-detail-content {
    background: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 0 30px rgba(0,0,0,0.05);
}

.featured-image img {
    width: 100%;
    max-height: 500px;
    object-fit: cover;
}

.meta-info {
    color: #777;
    font-size: 0.9rem;
}

.content {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #444;
}

.content p {
    margin-bottom: 1.5rem;
}

.content img {
    max-width: 100%;
    height: auto;
    margin: 20px 0;
    border-radius: 8px;
}

.share-buttons h5 {
    color: #2c4964;
    font-weight: 600;
}

.sidebar-item {
    margin-bottom: 30px;
    padding: 30px;
    box-shadow: 0 0 30px rgba(0,0,0,0.05);
    border-radius: 8px;
    background: #fff;
}

.sidebar-title {
    font-size: 20px;
    font-weight: 700;
    padding: 0;
    margin: 0;
    color: #2c4964;
}

.recent-posts img {
    width: 80px;
    height: 60px;
    object-fit: cover;
    margin-right: 15px;
    border-radius: 5px;
}

.recent-posts .post-item {
    display: flex;
    align-items: flex-start;
    margin-bottom: 15px;
}

.recent-posts h4 {
    font-size: 15px;
    font-weight: 600;
    margin-bottom: 5px;
}

.recent-posts h4 a {
    color: #2c4964;
    text-decoration: none;
    transition: 0.3s;
}

.recent-posts h4 a:hover {
    color: #1977cc;
}

.recent-posts time {
    display: block;
    font-size: 14px;
    color: #777;
}

@media (max-width: 768px) {
    .blog-detail-content {
        padding: 20px;
    }
    
    .featured-image img {
        max-height: 300px;
    }
}
</style>
