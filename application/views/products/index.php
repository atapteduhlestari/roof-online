<section id="main-container" class="main-container">
    <div class="container">
        <div class="mb-5">
            <h5>Category</h5>
            <div class="row align-items-center">
                <div class="col-sm-6 col-md-3 mb-3">
                    <div class="dropdown">
                        <button class="btn btn-primary btn-block dropdown-toggle <?= activeMenu($this->uri->segment(2), $this->uri->segment(3)) ?>" type="button" data-toggle="dropdown" aria-expanded="false">
                            Roofing
                        </button>
                        <div class="dropdown-menu product-items">
                            <a class="dropdown-item" href="<?= base_url(); ?>product/kategori/1">All</a>
                            <a class="dropdown-item" href="<?= base_url(); ?>product/subkategori/1">Asphalt</a>
                            <a class="dropdown-item" href="<?= base_url(); ?>product/subkategori/5">Synthetic Thatch</a>
                            <a class="dropdown-item" href="<?= base_url(); ?>product/subkategori/2">Membrane</a>
                            <a class="dropdown-item" href="<?= base_url(); ?>product/subkategori/3">Metal</a>
                            <a class="dropdown-item" href="<?= base_url(); ?>product/subkategori/4">Slate</a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3 mb-3">
                    <a href="<?= base_url(); ?>product/kategori/2" class="btn btn-primary btn-block <?= ($this->uri->segment(3) == 2) && ($this->uri->segment(2) == 'kategori') ? 'active' : '' ?>">
                        waterproofing
                    </a>
                </div>
                <div class="col-sm-6 col-md-3 mb-3">
                    <a href="<?= base_url(); ?>product/kategori/3" class="btn btn-primary btn-block <?= ($this->uri->segment(3) == 3) && ($this->uri->segment(2) == 'kategori') ? 'active' : '' ?>">
                        insulation
                    </a>
                </div>
                <div class=" col-sm-6 col-md-3 mb-3">
                    <a href="<?= base_url(); ?>product/kategori/4" class="btn btn-primary btn-block <?= ($this->uri->segment(3) == 4) && ($this->uri->segment(2) == 'kategori') ? 'active' : '' ?>">
                        structure
                    </a>
                </div>
                <div class=" col-sm-6 col-md-3 mb-3">
                    <a href="<?= base_url(); ?>product/kategori/7" class="btn btn-primary btn-block <?= ($this->uri->segment(3) == 7) && ($this->uri->segment(2) == 'kategori') ? 'active' : '' ?>">
                        ceiling & wall
                    </a>
                </div>
                <div class=" col-sm-6 col-md-3 mb-3">
                    <a href="https://lestarijendela.com/" class="btn btn-primary btn-block">
                        windows & doors
                    </a>
                </div>
            </div>
        </div>
        <div class=" row">
            <div class="col-12">
                <div class="row mb-5">
                    <?php foreach ($product_data as $rec) : ?>
                        <div class="col-lg-4 col-md-6 mb-3">
                            <div class="card border-0 list-product-catalog h-100">
                                <div class="card-body">
                                    <a href="<?= base_url(); ?>product/detail/<?= $rec->id_produk ?>">
                                        <img loading="lazy" src="<?= $rec->gambar_produk; ?>" alt="<?= $rec->nama_produk; ?>" class=" rounded mb-4 col mx-auto img-thumbnail p-1 img-wrap" alt="<?= $rec->nama_produk ?>">
                                    </a>
                                    <div class="text-center">
                                        <img loading="lazy" class="mb-2" src="<?= base_url() . $rec->gambar_logo; ?>" style="height:37.5px;" alt="<?= $rec->nama_logo ?>">
                                        <h5>
                                            <a href="<?= base_url(); ?>product/detail/<?= $rec->id_produk; ?>" class="text-hov-white"><?= $rec->nama_produk; ?></a>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-md-12"><br><?= $this->pagination->create_links(); ?></div>
        </div>
    </div>
</section>