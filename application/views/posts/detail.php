<section id="main-container" class="main-container">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="sidebar sidebar-left">
                    <div class="widget">
                        <h3 class="widget-title">Archive</h3>
                        <?php foreach ($archives as $year => $archive) : ?>
                            <button class="btn btn-primary btn-block btn-archive-collapse text-left" type="button" data-toggle="collapse" data-target="#collapse<?= $year ?>" aria-expanded="false" aria-controls="collapse">
                                <?= $year ?> <span class="float-right">
                                    <i class="caret-icon fas fa-caret-right"></i>
                                </span>
                            </button>
                            <div class="collapse <?= $this->uri->segment(3) == $year ? 'show' : '' ?>" id="collapse<?= $year ?>">
                                <div class="card card-body">
                                    <ul class="arrow nav nav-tabs">
                                        <?php foreach ($archive as $month) : ?>
                                            <li class="<?= $this->uri->segment(4) == $month->month ? 'active' : '' ?>">
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
            <div class="col-md-8 mb-5 mb-lg-0">
                <div class="post-content post-single">
                    <div class="post-media post-image">
                        <img loading="lazy" class="img-fluid" src="<?= $news->gambar_url ?>" alt="<?= $news->judul ?>">
                    </div>
                    <div class="post-body">
                        <div class="entry-header">
                            <div class="post-meta">
                                <i class="far fa-calendar"></i> <?= changeDateFormat('d F Y', $news->tanggal) ?>
                            </div>
                            <h2 class="entry-title">
                                <?= $news->judul ?>
                            </h2>
                        </div>
                        <div class="entry-content">
                            <?= $news->isi ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>