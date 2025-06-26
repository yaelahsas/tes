<!-- ======= Breadcrumbs Section ======= -->
<br>
<section class="breadcrumbs">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Artikel & Berita</h2>
            <ol>
                <li><a href="<?= base_url() ?>">Home</a></li>
                <li>Artikel</li>
            </ol>
        </div>
    </div>
</section><!-- End Breadcrumbs Section -->

<section class="blog">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!-- Articles Grid -->
                <div class="row gy-4 posts-list">
                    <?php foreach ($articles as $article): ?>
                    <div class="col-md-6">
                        <article class="card h-100">
                            <div class="post-img position-relative overflow-hidden">
                                <img src="<?= base_url('gambar/artikel/' . $article->sampul) ?>" 
                                     alt="<?= htmlspecialchars($article->judul) ?>"
                                     class="img-fluid w-100"
                                     style="height: 250px; object-fit: cover;">
                                <span class="post-date position-absolute top-0 start-0 bg-primary text-white p-2 m-3">
                                    <?= date('d M Y', strtotime($article->created_at ?? date('Y-m-d'))) ?>
                                </span>
                            </div>
                            <div class="card-body">
                                <h3 class="card-title h5">
                                    <a href="<?= base_url('berita/read/' . $article->slug) ?>" class="text-dark text-decoration-none">
                                        <?= htmlspecialchars($article->judul) ?>
                                    </a>
                                </h3>
                                <div class="meta mb-3">
                                    <span class="text-muted">
                                        <i class="bi bi-folder me-1"></i>
                                        <?= htmlspecialchars($article->kategori) ?>
                                    </span>
                                </div>
                                <p class="card-text">
                                    <?= substr(strip_tags($article->isi), 0, 120) ?>...
                                </p>
                                <a href="<?= base_url('berita/read/' . $article->slug) ?>" 
                                   class="btn btn-primary btn-sm">
                                   Baca Selengkapnya <i class="bi bi-arrow-right"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Pagination -->
                <div class="blog-pagination mt-5">
                    <ul class="justify-content-center">
                        <?php if(isset($pagination)): ?>
                            <?= $pagination ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar">
                    <!-- Search -->
                    <div class="sidebar-item search-form">
                        <h3 class="sidebar-title">Cari Artikel</h3>
                        <form action="" method="get" class="mt-3">
                            <input type="text" name="search" class="form-control">
                            <button type="submit"><i class="bi bi-search"></i></button>
                        </form>
                    </div>

                    <!-- Categories -->
                    <div class="sidebar-item categories">
                        <h3 class="sidebar-title">Kategori</h3>
                        <ul class="mt-3">
                            <?php foreach ($categories as $category): ?>
                            <li>
                                <a href="<?= base_url('berita/kategori/' . $category->id) ?>" 
                                   class="<?= isset($current_category) && $current_category->id == $category->id ? 'active' : '' ?>">
                                    <?= htmlspecialchars($category->nama) ?>
                                    <?php if(isset($current_category) && $current_category->id == $category->id): ?>
                                        <i class="bi bi-check-circle-fill text-primary ms-1"></i>
                                    <?php endif; ?>
                                </a>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <!-- Recent Posts -->
                    <div class="sidebar-item recent-posts">
                        <h3 class="sidebar-title">Artikel Terbaru</h3>
                        <div class="mt-3">
                            <?php foreach (array_slice($articles, 0, 5) as $recent): ?>
                            <div class="post-item mt-3 d-flex align-items-start">
                                <img src="<?= base_url('gambar/artikel/' . $recent->sampul) ?>" 
                                     alt="<?= htmlspecialchars($recent->judul) ?>"
                                     class="flex-shrink-0 me-3" style="width:80px; height:60px; object-fit:cover;">
                                <div>
                                    <h4>
                                        <a href="<?= base_url('berita/read/' . $recent->slug) ?>">
                                            <?= htmlspecialchars($recent->judul) ?>
                                        </a>
                                    </h4>
                                    <time>
                                        <?= date('d M Y', strtotime($recent->created_at ?? date('Y-m-d'))) ?>
                                    </time>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.blog {
    padding: 40px 0;
}
.posts-list article {
    transition: all 0.3s ease;
}
.posts-list article:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}
.post-img {
    border-radius: 5px 5px 0 0;
}
.sidebar-item {
    margin-bottom: 30px;
    padding: 30px;
    box-shadow: 0 0 30px rgba(0,0,0,0.05);
    border-radius: 5px;
}
.sidebar-title {
    font-size: 20px;
    font-weight: 700;
    padding: 0;
    margin: 0;
    color: #2c4964;
}
.search-form {
    position: relative;
}
.search-form button {
    position: absolute;
    right: 0;
    top: 0;
    border: 0;
    padding: 10px 25px;
    background: #1977cc;
    color: #fff;
    transition: 0.3s;
    border-radius: 0 5px 5px 0;
    line-height: 1.5;
}
.search-form button:hover {
    background: #1c84e3;
}
.categories ul {
    list-style: none;
    padding: 0;
}
.categories ul li {
    padding: 8px 0;
    border-bottom: 1px solid #ddd;
}
.categories ul a {
    color: #2c4964;
    text-decoration: none;
}
.categories ul a:hover {
    color: #1977cc;
}
.recent-posts img {
    width: 80px;
    height: 60px;
    object-fit: cover;
    margin-right: 15px;
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
</style>
