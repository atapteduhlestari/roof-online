<section id="main-container" class="main-container pb-2">
    <div class="container">
        <form action="<?= base_url() ?>project/search" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" title="Search project" placeholder="Project name">
                        <div class="input-group-btn">
                            <button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php if ($discover_name) : ?>
            <h5 class="mt-5">Product covered with <a class="text-home" href="<?= base_url() ?>product/detail/<?= $project_data[0]->id_produk ?>"><?= $discover_name ?></a></h5>
        <?php endif; ?>
        <div class="row mt-3" id="list-projects">
            <?php if (!$project_data) : ?>
                <div class="col-md-6">
                    Sorry we couldn't find what you're looking for <i class="far fa-frown"></i>
                </div>
            <?php endif; ?>
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
    </div>
</section>