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
                                            <img height="47" src="<?= base_url(); ?>assets/images/logo/iaf.png" alt="">
                                            <img height="60" src="<?= base_url(); ?>assets/images/logo/iso-9001.png" alt="">
                                            <!-- <img height="60" src="<?= base_url(); ?>assets/images/logo/iso.png" alt=""> -->
                                            <img height="50" src="<?= base_url(); ?>assets/images/logo/tkdn.jpg" alt="">
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="info-box">
                                    <div class="info-box-content">
                                        <p class="info-box-title">Call Us</p>
                                        <p class="info-box-subtitle">
                                            <a class="text-dark" href="tel:0218646506">(021) 864-6506</a>
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="info-box">
                                    <div class="info-box-content">
                                        <p class="info-box-title">Our Email</p>
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
                                    <a href="#!" id="productBtn" class=" nav-link dropdown-toggle" data-toggle="dropdown">Product <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li class="dropdown-submenu">
                                            <a href="<?= base_url(); ?>product" class="dropdown-toggle" data-toggle="dropdown">Roofing</a>
                                            <ul class="dropdown-menu">
                                                <li><a href="<?= base_url(); ?>product/subkategori/1">Asphalt</a></li>
                                                <li><a href="<?= base_url(); ?>product/subkategori/5">Synthetic Thatch</a></li>
                                                <li><a href="<?= base_url(); ?>product/subkategori/2">Membrane</a></li>
                                                <li><a href="<?= base_url(); ?>product/subkategori/4">Slate</a></li>
                                                <li><a href="<?= base_url(); ?>product/subkategori/3">Metal</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="<?= base_url(); ?>product/kategori/2">Waterproofing</a></li>
                                        <li><a href="<?= base_url(); ?>product/kategori/3">Insulation</a></li>
                                        <li><a href="<?= base_url(); ?>product/kategori/4">Structure</a></li>
                                        <li><a href="<?= base_url(); ?>product/kategori/7">Ceiling & Wall</a></li>
                                        <li><a href="http://lestarijendela.com/">Windows & Doors</a></li>
                                    </ul>
                                </li>

                                <li class="nav-item dropdown <?= $this->uri->segment(1) == 'project' ? 'active' : '' ?>">
                                    <a href="#!" class="nav-link dropdown-toggle" data-toggle="dropdown">Gallery <i class="fa fa-angle-down"></i></a>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="<?= base_url(); ?>project">Gallery Project</a></li>
                                        <li><a href="<?= base_url(); ?>project/videos">Gallery Videos</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item <?= $this->uri->segment(1) == 'post' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url(); ?>post">News</a></li>
                                <li class="nav-item <?= $this->uri->segment(2) == 'about' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url(); ?>home/about">About</a></li>
                                <li class="nav-item <?= $this->uri->segment(2) == 'contact' ? 'active' : '' ?>"><a class="nav-link" href="<?= base_url(); ?>home/contact">Contact</a></li>
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