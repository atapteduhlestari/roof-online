<section id="main-container" class="main-container pb-2">
    <div class="container">
        <div class="row" id="list-projects">
            <?php foreach ($project_data as $rec) : ?>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card text-white list-project-catalog border-0 gallery-catalog h-100">
                        <div class="img-project-catalog p-1">
                            <a href="<?= $rec->gambar_project ?>" data-max-width="750" data-toggle="lightbox" data-gallery="example-gallery">
                                <img class="card-img" loading="lazy" height="250" src="<?= $rec->gambar_project ?>" alt="<?= $rec->judul_project ?>">
                            </a>
                        </div>
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <h5 class="card-text">
                                    <?= $rec->judul_project ?>
                                </h5>
                            </div>
                            <img loading="lazy" class="mb-2" src="<?= base_url() . $rec->gambar_logo; ?>" style="height:37.5px;" alt="<?= $rec->nama_logo ?>">
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="col-md-12"><br><?= $this->pagination->create_links(); ?></div>

    </div><!-- Container end -->
</section><!-- Main container end -->