<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= pageTitle($title); ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="title" content="<?= metaDescription($meta_desc); ?>">
    <meta name="description" content="<?= metaDescription($meta_desc); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <meta name='author' content='Edward'>
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://roof-online.com/">
    <meta property="og:title" content="<?= pageTitle($title); ?>">
    <meta property="og:description" content="<?= metaDescription($meta_desc); ?>">
    <meta property="og:image" content="<?= base_url(); ?>assets/images/logo/logo_.png">
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://roof-online.com/">
    <meta property="twitter:title" content="<?= pageTitle($title); ?>">
    <meta property="twitter:description" content="<?= metaDescription($meta_desc); ?>">
    <meta property="twitter:image" content="<?= base_url(); ?>assets/images/logo/logo_.png">

    <link rel="icon" sizes="16x16" href="<?= base_url(); ?>assets/images/logo/logo_.png">
    <link rel="apple-touch-icon" sizes="16x16" href="<?= base_url(); ?>assets/images/logo/logo_.png">

    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/animate-css/animate.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/slick/slick.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/slick/slick-theme.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/colorbox/colorbox.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/home.css">
    <link rel="stylesheet" href="<?= base_url(); ?>assets/css/lightbox.css">

    <link rel="canonical" href="https://roof-online.com/" />
    <link rel='shortlink' href='https://roof-online.com/' />

    <style>
        .bg-page {
            background-color: #8bc34a;
            background: url("<?= base_url(); ?>assets/images/banner/bg-page-1.svg");
            background-attachment: fixed;
            background-size: cover;
        }

        .bg-cambridge {
            height: 100vh;
            background-color: #8bc34a;
            background: url("<?= base_url(); ?>assets/images/home/cambridge.webp");
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: right -250px bottom 45%;
            -webkit-filter: brightness(90%);
            filter: brightness(90%);
        }

        .bg-marathon {
            height: 100vh;
            background-color: #8bc34a;
            background: url("<?= base_url(); ?>assets/images/home/marathon.webp");
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: top 100% right 250px;
            -webkit-filter: brightness(90%);
            filter: brightness(90%);
        }

        .bg-palmex {
            height: 100vh;
            background-color: #8bc34a;
            background: url("<?= base_url(); ?>assets/images/home/palmex.webp");
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: top 65% left 450px;
            -webkit-filter: brightness(90%);
            filter: brightness(90%);
        }

        .bg-duo {
            height: 100vh;
            background-color: #8bc34a;
            background: url("<?= base_url(); ?>assets/images/home/duo.webp");
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: top -110px right 250px;
            -webkit-filter: brightness(90%);
            filter: brightness(90%);
        }

        .bg-lj {
            height: 100vh;
            background-color: #8bc34a;
            background: url("<?= base_url(); ?>assets/images/home/lj.webp");
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: right -250px bottom 95%;
            -webkit-filter: brightness(90%);
            filter: brightness(90%);
        }

        .bg-truss {
            height: 85vh;
            background-color: #8bc34a;
            background: url("<?= base_url(); ?>assets/images/home/12truss.webp");
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-position: 0 100%;
            -webkit-filter: brightness(90%);
            filter: brightness(90%);
        }

        .bg-hands {
            position: relative;
            height: 100vh;
            background: url(' <?= base_url(); ?>assets/images/home/about/4.webp');
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: top -110px right 0;
            -webkit-filter: brightness(75%);
            filter: brightness(75%);
        }

        .bg-shake-hands {
            position: relative;
            height: 100vh;
            background: url(' <?= base_url(); ?>assets/images/home/about/3.webp');
            background-attachment: fixed;
            background-repeat: no-repeat;
            background-size: cover;
            background-position: top -110px right 0;
            -webkit-filter: brightness(75%);
            filter: brightness(75%);
        }
    </style>

</head>

<body>
    <div class="loader-frame">
        <span class="loader"></span>
    </div>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v16.0" nonce="zEbx31Ls"></script>
    <div class="body-inner">