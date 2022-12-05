<html lang="pt-br" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <title>ErcSystem - Processamento de Dados</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= theme('assets/img/favicon/favicon.ico', SET_VIEW_THEME) ?>">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&amp;display=swap" rel="stylesheet">

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?= theme('assets/vendor/fonts/boxicons.css', SET_VIEW_THEME) ?>">



    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= theme('assets/vendor/css/core.css', SET_VIEW_THEME) ?>" class="template-customizer-core-css">
    <link rel="stylesheet" href="<?= theme('assets/vendor/css/theme-default.css', SET_VIEW_THEME) ?>" class="template-customizer-theme-css">
    <link rel="stylesheet" href="<?= theme('assets/css/demo.css', SET_VIEW_THEME) ?>">

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="<?= theme('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css', SET_VIEW_THEME) ?>">

    <link rel="stylesheet" href="<?= theme('assets/vendor/libs/apex-charts/apex-charts.css', SET_VIEW_THEME) ?>">
    <link rel="stylesheet" href="<?= theme('assets/vendor/libs/sweetalert2/sweetalert2.css', SET_VIEW_THEME) ?>">
    <link rel="stylesheet" href="<?= theme('assets/vendor/libs/dropzone/dropzone.css', SET_VIEW_THEME) ?>">

    <link rel="stylesheet" href="<?= theme('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css', SET_VIEW_THEME) ?>">
    <link rel="stylesheet" href="<?= theme('assets/vendor/libs/datatables-bs5/buttons.bootstrap5.css', SET_VIEW_THEME) ?>">
    <link rel="stylesheet" href="<?= theme('assets/vendor/libs/datatables-bs5/datatables.checkboxes.css', SET_VIEW_THEME) ?>">
    <link rel="stylesheet" href="<?= theme('assets/vendor/libs/datatables-bs5/responsive.bootstrap5.css', SET_VIEW_THEME) ?>">
    <link rel="stylesheet" href="<?= theme('assets/vendor/libs/datatables-bs5/rowgroup.bootstrap5.css', SET_VIEW_THEME) ?>">

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="<?= theme('assets/vendor/js/helpers.js', SET_VIEW_THEME) ?>"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="<?= theme('assets/vendor/js/template-customizer.js', SET_VIEW_THEME) ?>"></script>
    <script src="<?= theme('assets/js/config.js', SET_VIEW_THEME) ?>"></script>

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async="async" src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'GA_MEASUREMENT_ID');
    </script>
    <!-- Custom notification for demo -->
</head>

<body>

    <div class="ajax_load">
        <div class="ajax_load_box">
            <div class="ajax_load_box_circle"></div>
            <p class="ajax_load_box_title">Aguarde, carregando...</p>
        </div>
    </div>

    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar  ">
        <div class="layout-container">
            <?= $v->insert('views/sidebar.php') ?>
            <!-- Layout container -->

            <div class="layout-page">
                <!-- Navbar -->
                <?= $v->insert('views/sidebar-top.php') ?>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <?= $v->section("content"); ?>
                <!-- Content wrapper -->
            </div>
            <!-- / Layout page -->
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
        <input type="hidden" class="csrf" value="<?= strtotime(date('YmdHis')) ?>">
    </div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="<?= theme('assets/vendor/libs/jquery/jquery.js', SET_VIEW_THEME) ?>"></script>
    <script src="<?= theme('assets/vendor/libs/popper/popper.js', SET_VIEW_THEME) ?>"></script>
    <script src="<?= theme('assets/vendor/js/bootstrap.js', SET_VIEW_THEME) ?>"></script>
    <script src="<?= theme('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js', SET_VIEW_THEME) ?>"></script>
    <script src="<?= theme('assets/vendor/js/menu.js', SET_VIEW_THEME) ?>"></script>

    <script src="<?= theme("assets/js/jquery.form.js", SET_VIEW_THEME) ?>"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="<?= theme('assets/vendor/libs/apex-charts/apexcharts.js', SET_VIEW_THEME) ?>"></script>
    <script src="<?= theme('assets/vendor/libs/sweetalert2/sweetalert2.js', SET_VIEW_THEME) ?>"></script>
    <script src="<?= theme('assets/vendor/libs/dropzone/dropzone.js', SET_VIEW_THEME) ?>"></script>

    <!-- Main JS -->

    <script src="<?= theme('assets/js/main.js', SET_VIEW_THEME) ?>"></script>

    <!-- Page JS -->
    <script src="<?= theme('assets/js/dashboards-analytics.js', SET_VIEW_THEME) ?>"></script>
    <script src="<?= theme('assets/js/extended-ui-sweetalert2.js', SET_VIEW_THEME) ?>"></script>
    <script src="<?= theme('assets/js/tables-datatables-extensions.js', SET_VIEW_THEME) ?>"></script>

    <script type="text/javascript">
        $(document).ready(function() {});

        var a = `<div class="dz-preview dz-file-preview">
              <div class="dz-details">
                <div class="dz-thumbnail">
                  <img data-dz-thumbnail>
                  <span class="dz-nopreview">No preview</span>
                  <div class="dz-success-mark"></div>
                  <div class="dz-error-mark"></div>
                  <div class="dz-error-message"><span data-dz-errormessage></span></div>
                  <div class="progress">
                    <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuemin="0" aria-valuemax="100" data-dz-uploadprogress></div>
                  </div>
                </div>
                <div class="dz-filename" data-dz-name></div>
                <div class="dz-size" data-dz-size></div>
              </div>
              </div>`;

        Dropzone.autoDiscover = false;

        var myDropzone = new Dropzone("#dropzone-multi", {
            url: "../import/save",
            paramName: "file",
            previewTemplate: a,
            parallelUploads: 1,
            acceptedFiles: ".xlsx,.xls,.csv,.txt",
            maxFilesize: 5,
            addRemoveLinks: !0,
            init: function(e) {
                var _this = this;

                // Set up any event handlers
                this.on("sending", function(file, xhr, formData) {

                    $(".ajax_load")
                        .fadeIn(200)
                        .css("display", "flex")
                        .find(".ajax_load_box_title")
                        .text(`Aguarde, Processando arquivo - [${file.name}].`);
                    formData.append("csrf", document.querySelector('.csrf').value);
                });

                this.on("success", function(file, xhr) {

                    response = JSON.parse(xhr);

                    let position = 'top-end',
                        icon = 'success',
                        text = response.message;

                    if (response.type == 'error') {
                        position = 'top-end';
                        icon = response.type;
                        text = response.message;
                    }

                    Swal.fire({
                        position: position,
                        icon: icon,
                        text: text,
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });

                    $(".ajax_load").fadeOut(200);
                    this.removeFile(this.files[0]);
                })

                this.on("error", function(file, xhr) {
                    Swal.fire({
                        position: "top-end",
                        icon: 'error',
                        text: 'Ops, Erro ao processar dados...',
                        timer: 1500,
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    });
                    $(".ajax_load").fadeOut(200);
                })
            }
        })
    </script>
</body>

</html>