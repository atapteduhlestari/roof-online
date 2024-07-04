<section id="main-container" class="main-container">
    <div class="container">
        <div class="mb-5">
            <h5>Category</h5>
            <div class="row align-items-center">
                <div class="col-sm-6 col-md-3 mb-3">
                    <div class="dropdown">
                        <button class="btn btn-primary btn-block dropdown-toggle <?= activeMenu($this->uri->segment(2)) ?>" type="button" data-toggle="dropdown" aria-expanded="false">
                            Atap/Genteng
                        </button>
                        <div class="dropdown-menu product-items">
                            <a class="dropdown-item <?= $this->uri->segment(2) === 'atap-dan-genteng' && !  $this->uri->segment(3) ? 'active' : '' ?>" href="<?= base_url(); ?>product/atap-dan-genteng">Atap dan Genteng</a>
                            <a class="dropdown-item <?= $this->uri->segment(3) === 'atap-bitumen' ? 'active' : '' ?>" href="<?= base_url(); ?>product/atap-dan-genteng/atap-bitumen">Atap Bitumen</a>
                            <a class="dropdown-item <?= $this->uri->segment(3) === 'atap-alang-alang-sintetis' ? 'active' : '' ?>" href="<?= base_url(); ?>product/atap-dan-genteng/atap-alang-alang-sintetis">Atap Alang-Alang Sintetis</a>
                            <a class="dropdown-item <?= $this->uri->segment(3) === 'membrane' ? 'active' : '' ?>" href="<?= base_url(); ?>product/atap-dan-genteng/membrane">Membrane Bakar</a>
                            <a class="dropdown-item <?= $this->uri->segment(3) === 'genteng-metal' ? 'active' : '' ?>" href="<?= base_url(); ?>product/atap-dan-genteng/genteng-metal">Genteng Metal</a>
                            <a class="dropdown-item <?= $this->uri->segment(3) === 'atap-slate' ? 'active' : '' ?>" href="<?= base_url(); ?>product/atap-dan-genteng/atap-slate">Atap Slate</a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-md-3 mb-3">
                    <a href="<?= base_url(); ?>product/waterproofing" class="btn btn-primary btn-block <?= $this->uri->segment(2) === 'waterproofing' ? 'active' : '' ?>">
                        Waterproofing
                    </a>
                </div>
                <div class="col-sm-6 col-md-3 mb-3">
                    <a href="<?= base_url(); ?>product/insulasi" class="btn btn-primary btn-block <?= $this->uri->segment(2) === 'insulasi' ? 'active' : '' ?>">
                        Insulasi
                    </a>
                </div>
                <div class=" col-sm-6 col-md-3 mb-3">
                    <a href="<?= base_url(); ?>product/struktur-rangka" class="btn btn-primary btn-block <?= $this->uri->segment(2) === 'struktur-rangka' ? 'active' : '' ?>">
                        Struktur Rangka
                    </a>
                </div>
                <div class=" col-sm-6 col-md-3 mb-3">
                    <a href="<?= base_url(); ?>product/plafon-dan-dinding" class="btn btn-primary btn-block <?= $this->uri->segment(2) === 'plafon-dan-dinding' ? 'active' : '' ?>">
                        Plafon & Dinding
                    </a>
                </div>
                <div class=" col-sm-6 col-md-3 mb-3">
                    <a href="<?= base_url(); ?>product/pintu-dan-jendela" class="btn btn-primary btn-block <?= $this->uri->segment(2) === 'pintu-dan-jendela' ? 'active' : '' ?>">
                        Pintu & Jendela
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
                                    <?php if ($rec->slug == 'lestari-jendela') : ?>
                                        <a href="<?= 'https://lestarijendela.com/' ?>">
                                            <img loading="lazy" src="<?= $rec->gambar_produk; ?>" alt="<?= $rec->nama_produk; ?>" class=" rounded mb-4 col mx-auto img-thumbnail p-1 img-wrap" alt="<?= $rec->nama_produk ?>">
                                        </a>
                                    <?php else : ?>
                                        <a href="<?= base_url(); ?>product/<?= isset($rec->sub_slug) ? $rec->sub_slug : $rec->kategori_slug ?>/<?= $rec->slug ?>/detail">
                                            <img loading="lazy" src="<?= $rec->gambar_produk; ?>" alt="<?= $rec->nama_produk; ?>" class=" rounded mb-4 col mx-auto img-thumbnail p-1 img-wrap" alt="<?= $rec->nama_produk ?>">
                                        </a>
                                    <?php endif; ?>
                                    <div class="text-center">
                                        <img loading="lazy" class="mb-2" src="<?= base_url() . $rec->gambar_logo; ?>" style="height:37.5px;" alt="<?= $rec->nama_logo ?>">
                                        <h5>
                                            <a href="<?= base_url(); ?>product/<?= isset($rec->sub_slug) ? $rec->sub_slug : $rec->kategori_slug ?>/<?= $rec->slug ?>/detail" class="text-hov-white"><?= $rec->nama_produk; ?></a>
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