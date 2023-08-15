<section id="main-container" class="main-container">
    <div class="container">
        <div class="col-md-12">
            <div class="content-inner-page">
                <div class="d-flex">
                    <h5>
                        <a href="<?= base_url(); ?>product/kategori/<?= $product->id_kategori ?>">
                            Category : <?= $product->nama_kategori ?>
                        </a>
                    </h5>
                </div>
                <div class="mt-2">
                    <img loading="lazy" class="mb-2" src="<?= base_url() . $product->gambar_logo; ?>" style="height:50px;" alt="<?= $product->nama_logo ?>">
                </div>
                <h2 class="column-title mrt-0"><?= $product->nama_produk ?></h2>
                <div class="row">
                    <div class="col-xl-8 col-lg-6">
                        <div id="page-slider" class="page-slider">
                            <div class="item img-detail-product">
                                <img loading="lazy" class="img-fluid col mx-auto img-wrap" src=" <?= $product->gambar_produk; ?>" alt="<?= $product->nama_produk ?>" />
                            </div>
                            <?php foreach ($gambar_product as $gambar) : ?>
                                <div class="item img-detail-product">
                                    <img loading="lazy" class="img-fluid col mx-auto img-wrap" src=" <?= $gambar->url_gambar; ?>" alt="<?= $product->nama_produk ?>" />
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="gap-40"></div>
                        <nav>
                            <div class="nav nav-tabs border-0 mb-3" id="nav-tab" role="tablist">
                                <a class="nav-link btn btn-primary border-0 active mb-1 mr-1" id="nav-deskripsi-tab" data-toggle="tab" href="#nav-deskripsi" role="tab" aria-controls="nav-deskripsi" aria-selected="true">
                                    Description
                                </a>
                                <a class="nav-link btn btn-primary border-0 mb-1 mr-1" id="nav-spesifikasi-tab" data-toggle="tab" href="#nav-spesifikasi" role="tab" aria-controls="nav-spesifikasi" aria-selected="false">
                                    Spesification
                                </a>
                                <?php if ($gambar_project) : ?>
                                    <a class="nav-link btn btn-primary border-0 mb-1 mr-1" id="nav-references-tab" data-toggle="tab" href="#nav-references" role="tab" aria-controls="nav-references" aria-selected="false">
                                        Project References
                                    </a>
                                <?php endif; ?>
                            </div>
                        </nav>
                    </div>
                    <div class="col-lg-4 mt-5 mt-lg-0">
                        <div class="sidebar sidebar-right">
                            <div class="widget">
                                <h3 class="widget-title">
                                    Category
                                </h3>
                                <ul class="nav service-menu">
                                    <li class="<?= $product->id_kategori == 1 ? 'active' : ''; ?>">
                                        <a href="<?= base_url(); ?>product/kategori/1">Roofing</a>
                                    </li>
                                    <li class="<?= $product->id_kategori == 2 ? 'active' : ''; ?>">
                                        <a href="<?= base_url(); ?>product/kategori/2">Waterproofing</a>
                                    </li>
                                    <li class="<?= $product->id_kategori == 3 ? 'active' : ''; ?>">
                                        <a href="<?= base_url(); ?>product/kategori/3">Insulation</a>
                                    </li>
                                    <li class="<?= $product->id_kategori == 4 ? 'active' : ''; ?>">
                                        <a href="<?= base_url(); ?>product/kategori/4">Structure</a>
                                    </li>
                                    <li class="<?= $product->id_kategori == 7 ? 'active' : ''; ?>">
                                        <a href="<?= base_url(); ?>product/kategori/7">Ceiling & Wall</a>
                                    </li>
                                    <li>
                                        <a href="https://lestarijendela.com/">Windows & Doors</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="gap-20"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-deskripsi" role="tabpanel" aria-labelledby="nav-home">
                                <h3 class="column-title-small">
                                    Description
                                </h3>
                                <?= $product->deskripsi_id; ?>
                            </div>

                            <div class="tab-pane fade" id="nav-spesifikasi" role="tabpanel">
                                <h3 class="column-title-small">
                                    Spesification
                                </h3>
                                <?= $product->spesifikasi_id; ?>
                            </div>
                            <?php if ($gambar_project) : ?>
                                <div class="tab-pane fade" id="nav-references" role="tabpanel">
                                    <h3 class="column-title-small">
                                        Project References
                                    </h3>
                                    <div class="row justify-content-center" id="list-projects">
                                        <?php if (count($gambar_project) > 0) : ?>
                                            <?php foreach ($gambar_project as $gbp) : ?>
                                                <div class="col-lg-4 col-md-6 mb-4">
                                                    <div class="card text-white list-project-catalog border-0 dark-bg gallery-catalog h-100">
                                                        <div class="img-project-catalog p-1">
                                                            <a href="<?= $gbp->gambar_project ?>" data-max-width="750" data-toggle="lightbox" data-gallery="example-gallery">
                                                                <img class="card-img" loading="lazy" height="250" src="<?= $gbp->gambar_project ?>">
                                                            </a>
                                                        </div>
                                                        <div class="card-body">
                                                            <h5 class="card-text text-white text-center">
                                                                <?= $gbp->judul_project ?>
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>

                                    </div>
                                    <div class="d-flex mt-5">
                                        <a class="btn btn-primary mx-auto" href="<?= base_url(); ?>project/discover/<?= $product->nama_produk ?>"> Discover more</a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>