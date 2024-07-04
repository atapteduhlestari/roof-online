<header id="header" class="header-one">
    <span id="top-bar" class="top-bar"></span>
    <div class="bg-white">
        <div class="container">
            <div class="logo-area">
                <div class="row align-items-center">
                    <div class="logo col-lg-3 text-center text-lg-left mb-3 mb-md-5 mb-lg-0">
                        <a class="d-block" href="<?= base_url(); ?>">
                            <img loading="lazy" src="<?= base_url(); ?>assets/images/logo/logo_atl.png" alt="ATL">
                        </a>
                    </div>

                    <div class="col-lg-9 header-right">
                        <ul class="top-info-box">
                            <li class="mt-2 navISO mt-n1">
                                <div class="info-box">
                                    <div class="info-box-content">
                                        <p class="info-box-subtitle text-center">
                                            <img height="47" src="<?= base_url(); ?>assets/images/logo/iaf.png" alt="logo-iaf">
                                            <img height="60" src="<?= base_url(); ?>assets/images/logo/iso-9001.png" alt="logo-iso9001">
                                            <!-- <img height="60" src="<?= base_url(); ?>assets/images/logo/iso.png" alt="logo-iso"> -->
                                            <img height="50" src="<?= base_url(); ?>assets/images/logo/tkdn.jpg" alt="logotkdn">
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="info-box">
                                    <div class="info-box-content">
                                        <p class="info-box-title">Hubungi Kami</p>
                                        <p class="info-box-subtitle">
                                            <a class="text-dark" href="tel:0218646506">(021) 864-6506</a>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="info-box">
                                    <div class="info-box-content">
                                        <p class="info-box-title">Email</p>
                                        <p class="info-box-subtitle">
                                            <a class="text-dark" href="mailto:info@roofonline.com">info@roof-online.com</a>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li class="header-get-a-quote">
                                <a id="btnSong" class="btn btn-primary" href="#myAudio">
                                    ATL Song
                                    <i class="fas fa-music"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="site-navigation">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-dark p-0">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbar-collapse" aria-controls="navbar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div id="navbar-collapse" class="collapse navbar-collapse">
                            <ul class="nav navbar-nav mr-auto">
                                <li class="nav-item"><a class="nav-link" href="<?= base_url(); ?>"><i class="fas fa-home"></i></a></li>

                                <li class="nav-item dropdown <?= $this->uri->segment(1) == 'product' ? 'active' : '' ?>">
                                    <a href="#!" id="productBtn" class=" nav-link dropdown-toggle" data-toggle="dropdown">Produk <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li class="dropdown-submenu <?= $this->uri->segment(2) == 'atap-dan-genteng' ? 'active' : '' ?>">
                                            <a href="<?= base_url(); ?>product" class="dropdown-toggle" data-toggle="dropdown">Atap/Genteng</a>
                                            <ul class="dropdown-menu">
                                                <li class="<?= $this->uri->segment(2) == 'atap-dan-genteng' && $this->uri->segment(3) == 'atap-bitumen' ? 'active' : '' ?>"><a href="<?= base_url(); ?>product/atap-dan-genteng/atap-bitumen">Atap Bitumen</a></li>
                                                <li class="<?= $this->uri->segment(2) == 'atap-dan-genteng' && $this->uri->segment(3) == 'atap-alang-alang-sintetis' ? 'active' : '' ?>"><a href="<?= base_url(); ?>product/atap-dan-genteng/atap-alang-alang-sintetis">Atap Alang-Alang Sintetis</a></li>
                                                <li class="<?= $this->uri->segment(2) == 'atap-dan-genteng' && $this->uri->segment(3) == 'membrane' ? 'active' : '' ?>"><a href="<?= base_url(); ?>product/atap-dan-genteng/membrane">Membrane Bakar</a></li>
                                                <li class="<?= $this->uri->segment(2) == 'atap-dan-genteng' && $this->uri->segment(3) == 'genteng-metal' ? 'active' : '' ?>"><a href="<?= base_url(); ?>product/atap-dan-genteng/genteng-metal">Genteng Metal</a></li>
                                                <li class="<?= $this->uri->segment(2) == 'atap-dan-genteng' && $this->uri->segment(3) == 'atap-slate' ? 'active' : '' ?>"><a href="<?= base_url(); ?>product/atap-dan-genteng/atap-slate">Atap Slate</a></li>
                                            </ul>
                                        </li>
                                        <li class="<?= $this->uri->segment(2) == 'waterproofing' ? 'active' : '' ?>"><a href="<?= base_url(); ?>product/waterproofing">Waterproofing</a></li>
                                        <li class="<?= $this->uri->segment(2) == 'insulasi' ? 'active' : '' ?>"><a href="<?= base_url(); ?>product/insulasi">Insulasi</a></li>
                                        <li class="<?= $this->uri->segment(2) == 'struktur-rangka' ? 'active' : '' ?>"><a href="<?= base_url(); ?>product/struktur-rangka">Struktur Rangka</a></li>
                                        <li class="<?= $this->uri->segment(2) == 'plafon-dan-dinding' ? 'active' : '' ?>"><a href="<?= base_url(); ?>product/plafon-dan-dinding">Plafon & Dinding</a></li>
                                        <li class="<?= $this->uri->segment(2) == 'pintu-dan-jendela' ? 'active' : '' ?>"><a href="<?= base_url(); ?>product/pintu-dan-jendela">Pintu & Jendela</a></li>
                                        <!-- <li><a href="http://lestarijendela.com/">Windows & Doors</a></li> -->
                                    </ul>
                                </li>

                                <li class="nav-item dropdown <?= $this->uri->segment(1) == 'project' ? 'active' : '' ?>">
                                    <a href="#!" class="nav-link dropdown-toggle" data-toggle="dropdown">Galeri <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li class="<?= $this->uri->segment(1) == 'project' && $this->uri->segment(2) != 'videos'  ? 'active' : '' ?>"><a href="<?= base_url(); ?>project">Galeri Proyek</a></li>
                                        <li class="<?= $this->uri->segment(2) == 'videos' ? 'active' : '' ?>"><a href="<?= base_url(); ?>project/videos">Galeri Video</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item <?= $this->uri->segment(1) == 'artikel' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url(); ?>artikel">Artikel</a></li>
                                <li class="nav-item <?= $this->uri->segment(1) == 'tentang' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url(); ?>tentang">Tentang</a></li>
                                <li class="nav-item <?= $this->uri->segment(1) == 'kontak' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url(); ?>kontak">Kontak</a></li>
                                <li class="nav-item <?= $this->uri->segment(1) == 'karir' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url(); ?>karir">Karir</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>

            <!-- <div class="nav-search">
                <span id="search"><i class="fa fa-search"></i></span>
            </div> -->

            <!-- <div class="search-block" style="display: none;">
                <form action="<?= base_url(); ?>product/search">
                    <label for="search-field" class="w-100 mb-0">
                        <input type="text" class="form-control" name="keywords" id="search-field" placeholder="Search product">
                    </label>
                    <span class="search-close">&times;</span>
                    <button type="submit">ok</button>
                </form>
            </div> -->
        </div>
    </div>

</header>
<div class="icon-bar rounded-circle">
    <a target="_blank" href="https://www.facebook.com/atapteduhlestari.pt" class="facebook">
        <i class="fab fa-facebook"></i>
    </a>
    <a target="_blank" href="https://www.instagram.com/atapteduhlestari/" class="instagram">
        <i class="fab fa-instagram"></i>
    </a>
    <a target="_blank" href="https://twitter.com/roofatap" class="twitter">
        <i class="fab fa-twitter"></i>
    </a>
    <a target="_blank" href="https://www.youtube.com/@atapteduhlestari7737" class="youtube">
        <i class="fab fa-youtube"></i>
    </a>
    <a role="button" class="song" id="songIcon" title="Play/Pause Song">
        <i class="fas fa-play"></i>
    </a>
</div>