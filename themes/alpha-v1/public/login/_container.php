<!DOCTYPE html>
<html lang="pt-br" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title><?=CONF_SITE_TITLE.' - '.CONF_SITE_NAME?></title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= theme('assets/img/favicon/favicon.ico', SET_VIEW_THEME) ?>" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?= theme('assets/vendor/fonts/boxicons.css', SET_VIEW_THEME) ?>" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= theme('assets/vendor/css/core.css', SET_VIEW_THEME) ?>" class="template-customizer-core-css" />
    <link rel="stylesheet" href="<?= theme('assets/vendor/css/theme-default.css', SET_VIEW_THEME) ?>" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="<?= theme('assets/css/demo.css', SET_VIEW_THEME) ?>" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?= theme('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css', SET_VIEW_THEME) ?>" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="<?= theme('assets/vendor/css/pages/page-auth.css', SET_VIEW_THEME) ?>" />
    <!-- Helpers -->
    <script src="<?= theme('assets/vendor/js/helpers.js', SET_VIEW_THEME) ?>"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?= theme('assets/js/config.js', SET_VIEW_THEME) ?>"></script>
</head>

<body>

    <!-- Content -->
    <?= $v->section("content"); ?>
    <!-- / Content -->

    <!-- Core JS -->
    <script src="<?= theme('assets/vendor/libs/jquery/jquery.js', SET_VIEW_THEME) ?>"></script>
    <script src="<?= theme('assets/vendor/libs/popper/popper.js', SET_VIEW_THEME) ?>"></script>
    <script src="<?= theme('assets/vendor/js/bootstrap.js', SET_VIEW_THEME) ?>"></script>
    <script src="<?= theme('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js', SET_VIEW_THEME) ?>"></script>
    <script src="<?= theme('assets/vendor/js/menu.js', SET_VIEW_THEME) ?>"></script>
    <script src="<?= theme('assets/vendor/libs/FormValidation/FormValidation.min.js', SET_VIEW_THEME) ?>"></script>
    <script src="<?= theme('assets/js/main.js', SET_VIEW_THEME) ?>"></script>
    <script src="<?= theme('assets/js/custom.js', SET_VIEW_THEME) ?>"></script>
</body>

</html>