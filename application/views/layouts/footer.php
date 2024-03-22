<footer id="footer" class="footer bg-overlay">
    <div class="footer-main">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-lg-3 col-md-6 footer-widget footer-about">
                    <h3 class="widget-title">Contact Us</h3>
                    <img loading="lazy" class="footer-logo" src="<?= base_url(); ?>assets/images/logo/logo_atl.png" alt="ATL">
                    <p class="info-text">
                        <b>HEAD OFFICE :</b><br>
                        Jl Raya Kalimalang Kav. PTB DKI Blok G17 No. 4A-D Pondok Kelapa, Jakarta Timur 13450
                    </p>
                    <table class="table-borderless" width="100%">
                        <tr>
                            <td><i class="fas fa-phone-alt"></i></td>
                            <td>:</td>
                            <td>
                                <a class="text-light" href="tel:0218646506">(021) 864-6506</a>
                            </td>
                        </tr>
                        <tr>
                            <td><i class="far fa-envelope-open"></i></td>
                            <td>:</td>
                            <td>
                                <a class="text-light" href="mailto:info@roofonline.com">info@roof-online.com</a>
                            </td>
                        </tr>
                        <tr>
                            <td><i class="fab fa-chrome"></i></td>
                            <td>:</td>
                            <td><a href="https://roof-online.com/" class="text-home text-hov-white">www.roof-online.com</a></td>
                        </tr>
                    </table>
                    <div class="working-hours">
                        <hr class="my-3">
                        <b>Office Hours</b> <br>
                        Monday - Friday <span class=" text-right">08:30 - 16:30 </span>
                        <br> Saturday <span class="text-right">08:30 - 12:30</span>
                    </div>
                    <div class="footer-social">
                        <ul>
                            <li>
                                <a target="_blank" href="https://www.facebook.com/atapteduhlestari.pt" aria-label="Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://www.instagram.com/atapteduhlestari/" aria-label="Instagram">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://www.youtube.com/@atapteduhlestari7737" aria-label="Youtube">
                                    <i class="fab fa-youtube"></i>
                                </a>
                            </li>
                            <li>
                                <a target="_blank" href="https://twitter.com/roofatap" aria-label="Instagram">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0 footer-widget">
                    <h3 class="widget-title">
                        Navigate
                    </h3>
                    <ul class="list-arrow">
                        <li>
                            <a href="<?= base_url(); ?>product/kategori/1">
                                Roofing
                            </a>
                        </li>
                        <li>
                            <a href=" <?= base_url(); ?>product/kategori/2">
                                Waterproofing
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url(); ?>product/kategori/3">
                                Insulation
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url(); ?>product/kategori/4">
                                Structure
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url(); ?>product/kategori/7">
                                Ceiling & Wall
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url(); ?>product/kategori/8">
                                Windows & Doors
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url(); ?>project">
                                Gallery Project
                            </a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 footer-widget mt-5 mt-md-0">
                    <h3 class="widget-title">INFO</h3>
                    <ul class="list-arrow">
                        <li>
                            <a href="<?= base_url(); ?>home/about">
                                About
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url(); ?>home/contact">
                                Contact
                            </a>
                        </li>
                        <li>
                            <a href="#!">
                                FAQs </a>
                        </li>
                    </ul>
                    <div class="mt-5">
                        <h3 class="widget-title">
                            ATL SONG
                        </h3>
                        <a id="lyricsBtn" tabindex="0" role="button" class="btn btn-outline-light border-0 btn-sm mb-2" data-toggle="popover" data-trigger="focus" title="ATL Song" data-content="<?= atlSong(); ?>" data-placement="bottom" data-html="true">Lyrics</a>
                        <br>
                        <audio id="myAudio" controls style="width: 250px;">
                            <source src="<?= base_url(); ?>assets/audio/atl_song.ogg" type="audio/ogg">
                            <source src="<?= base_url(); ?>assets/audio/atl_song.mp3" type="audio/mpeg">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 mt-5 mt-lg-0 footer-widget">
                    <div class="fb-page" data-href="https://www.facebook.com/atapteduhlestari.pt/" data-tabs="timeline" data-width="" data-height="375" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                        <blockquote cite="https://www.facebook.com/atapteduhlestari.pt/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/atapteduhlestari.pt/">Atap Teduh Lestari, PT</a></blockquote>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="copyright">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="copyright-info text-center">
                        Copyright &copy;<span id="copyRightYear"></span>. PT Atap Teduh Lestari. All Rights Reserved
                    </div>
                </div>
            </div>

            <div id="back-to-top" data-spy="affix" data-offset-top="10" class="back-to-top position-fixed">
                <button class="btn btn-primary" title="Back to Top">
                    <i class="fa fa-angle-double-up"></i>
                </button>
            </div>

        </div>
    </div>
</footer>
</div>

<script src="<?= base_url(); ?>assets/plugins/jQuery/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="<?= base_url(); ?>assets/plugins/bootstrap/bootstrap.min.js" defer></script>
<script src="<?= base_url(); ?>assets/plugins/slick/slick.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/slick/slick-animation.min.js"></script>
<script src="<?= base_url(); ?>assets/plugins/colorbox/jquery.colorbox.js"></script>
<script src="<?= base_url(); ?>assets/plugins/shuffle/shuffle.min.js" defer></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCcABaamniA6OL5YvYSpB3pFMNrXwXnLwU" defer></script>
<script src="<?= base_url(); ?>assets/plugins/google-map/map.js" defer></script>
<script src="<?= base_url(); ?>assets/js/lightbox.js"></script>
<script src="<?= base_url(); ?>assets/js/script.js"></script>
</script>

<script>
    var Tawk_API = Tawk_API || {},
        Tawk_LoadStart = new Date();
    (function() {
        var s1 = document.createElement("script"),
            s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/57709a39d5ba37b66ff8a72e/default';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();

    let year = new Date().getFullYear();
    let copyright = document.getElementById('copyRightYear');
    copyright.innerHTML = year;

    $(document).ready(function() {
        $(document).on("click", '[data-toggle="lightbox"]', function(event) {
            event.preventDefault();
            $(this).ekkoLightbox();
        });
    });
</script>
</body>

</html>