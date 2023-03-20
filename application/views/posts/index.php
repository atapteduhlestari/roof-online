<section id="main-container" class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="sidebar sidebar-left" id="newsArchiveWidget">
                    <div class="widget">
                        <h3 class="widget-title">Archive</h3>
                        <?php foreach ($archives as $year => $archive) : ?>
                            <button class="btn btn-primary btn-block btn-archive-collapse text-left" type="button" data-toggle="collapse" data-target="#collapse<?= $year ?>" aria-expanded="false" aria-controls="collapse">
                                <?= $year ?> <span class="float-right">
                                    <i class="caret-icon fas  <?= ($this->uri->segment(3) == $year) ? 'fa-caret-down' : 'fa-caret-right' ?>"></i>
                                </span>
                            </button>
                            <div class="collapse <?= $this->uri->segment(3) == $year ? 'show' : '' ?>" id="collapse<?= $year ?>">
                                <div class="card card-body">
                                    <ul class="arrow nav nav-tabs">
                                        <?php foreach ($archive as $month) : ?>
                                            <li class="<?= ($this->uri->segment(4) == $month->month) && ($this->uri->segment(3) == $year) ? 'active' : '' ?>">
                                                <a href="<?= base_url() . 'post/date/' . $month->year . '/' . $month->month ?>">
                                                    <?= $month->month ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div class="col-md">
                <div class="row mb-3">
                    <?php foreach ($news_data as $news) : ?>
                        <div class="col-md-6 mb-4">
                            <div class="latest-post home-recent-posts h-100">
                                <div class="latest-post-media card-img-wrap">
                                    <a href="<?= base_url(); ?>post/detail/<?= $news->id_newsletter ?>" class="latest-post-img">
                                        <img loading="lazy" class="img-fluid rounded" height="100" src="<?= $news->gambar_url ?>" alt="<?= $news->judul ?>">
                                    </a>
                                </div>
                                <div class="post-body p-3">
                                    <h4 class="post-title">
                                        <a href="<?= base_url(); ?>post/detail/<?= $news->id_newsletter ?>" class="d-inline-block">
                                            <?= $news->judul ?>
                                        </a>
                                    </h4>
                                    <div class="my-2 limit-text">
                                        <?= $news->isi ?>
                                    </div>
                                    <div class="latest-post-meta">
                                        <span class="post-item-date">
                                            <i class="far fa-clock"></i>
                                            <?= changeDateFormat('d F Y', $news->tanggal) ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="col-md-12"><br><?= $this->pagination->create_links(); ?></div>
            </div>
        </div>
    </div>
</section>