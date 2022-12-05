<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Meu Planejamento de Rota!</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= theme('assets/img/favicon/favicon.ico', SET_VIEW_THEME) ?>"/>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
          rel="stylesheet"/>

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="<?= theme('assets/vendor/fonts/boxicons.css', SET_VIEW_THEME) ?>"/>
    <!-- Core CSS -->
    <link rel="stylesheet" href="<?= theme('assets/vendor/css/core.css', SET_VIEW_THEME) ?>"
          class="template-customizer-core-css"/>
    <link rel="stylesheet" href="<?= theme('assets/vendor/css/theme-default.css', SET_VIEW_THEME) ?>"
          class="template-customizer-theme-css"/>
    <link rel="stylesheet" href="<?= theme('assets/css/demo.css', SET_VIEW_THEME) ?>"/>

    <!-- Vendors CSS -->
    <link rel="stylesheet"
          href="<?= theme('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css', SET_VIEW_THEME) ?>"/>

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="<?= theme('assets/vendor/css/pages/page-auth.css', SET_VIEW_THEME) ?>"/>
    <link rel="stylesheet" href="<?= theme('assets/mapa/mapa.css', SET_VIEW_THEME) ?>"/>
    <link rel="stylesheet" href="<?= theme('assets/vendor/libs/dropzone/dropzone.css', SET_VIEW_THEME) ?>">
</head>
<body>

<div class="ajax_load">
    <div class="ajax_load_box">
        <div class="ajax_load_box_circle"></div>
        <p class="ajax_load_box_title">Aguarde, carregando...</p>
    </div>
</div>

<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <div class="layout-page">
            <nav class="layout-navbar navbar navbar-expand-xl" id="layout-navbar">


                <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0   d-xl-none ">
                    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                        <i class="bx bx-menu bx-sm"></i>
                    </a>
                </div>


                <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                    <ul class="navbar-nav flex-row align-items-center ms-auto">

                        <!-- Quick links  -->
                        <li class="nav-item dropdown-shortcuts navbar-dropdown dropdown me-2 me-xl-0">
                            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                               data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                <i class="bx bx-grid-alt bx-sm"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end py-0">
                                <div class="dropdown-menu-header border-bottom">
                                    <div class="dropdown-header d-flex align-items-center py-3">
                                        <h5 class="text-body mb-0 me-auto">Atalhos</h5>
                                        <a href="javascript:void(0)" class="dropdown-shortcuts-add text-body"
                                           data-bs-toggle="tooltip" data-bs-placement="top"
                                           aria-label="Add shortcuts"><i class="bx bx-sm bx-plus-circle"></i></a>
                                    </div>
                                </div>
                                <div class="dropdown-shortcuts-list scrollable-container ps">
                                    <div class="row row-bordered overflow-visible g-0">
                                        <div class="dropdown-shortcuts-item col" data-bs-toggle="modal"
                                             data-bs-target="#modalCenter">
                                            <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                                              <i class="bx bx-upload fs-4"></i>
                                            </span>
                                            <a href="#" class="stretched-link">Carregar Arquivo</a>
                                            <small class="text-muted mb-0">Upload de planilhas</small>
                                        </div>
                                        <div class="dropdown-shortcuts-item col" onclick="otimizarRota(this)">
                                            <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                                              <i class="bx bx-map-pin fs-4"></i>
                                            </span>
                                            <a href="#" class="stretched-link">Otimizar</a>
                                            <small class="text-muted mb-0">Melhor Rota</small>
                                        </div>
                                    </div>
                                    <div class="row row-bordered overflow-visible g-0">
                                        <div class="dropdown-shortcuts-item col">
                                            <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                                              <i class="bx bx-pie-chart-alt-2 fs-4"></i>
                                            </span>
                                            <a href="index.html" class="stretched-link">Dashboard</a>
                                            <small class="text-muted mb-0">User Profile</small>
                                        </div>
                                        <div class="dropdown-shortcuts-item col">
                                            <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                                              <i class="bx bx-cog fs-4"></i>
                                            </span>
                                            <a href="<?=url("/setting")?>"
                                               class="stretched-link">Setting</a>
                                            <small class="text-muted mb-0">Account Settings</small>
                                        </div>
                                    </div>

                                    <div class="row row-bordered overflow-visible g-0">
                                        <div class="dropdown-shortcuts-item col">
                                            <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                                              <i class="bx bx-user fs-4"></i>
                                            </span>
                                            <a href="app-user-list.html" class="stretched-link">User App</a>
                                            <small class="text-muted mb-0">Manage Users</small>
                                        </div>
                                        <div class="dropdown-shortcuts-item col">
                                            <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                                              <i class="bx bx-check-shield fs-4"></i>
                                            </span>
                                            <a href="app-access-roles.html" class="stretched-link">Role Management</a>
                                            <small class="text-muted mb-0">Permission</small>
                                        </div>
                                    </div>

                                    <div class="row row-bordered overflow-visible g-0">
                                        <div class="dropdown-shortcuts-item col">
                                            <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                                              <i class="bx bx-help-circle fs-4"></i>
                                            </span>
                                            <a href="pages-help-center-landing.html" class="stretched-link">Help
                                                Center</a>
                                            <small class="text-muted mb-0">FAQs &amp; Articles</small>
                                        </div>
                                        <div class="dropdown-shortcuts-item col">
                                            <span class="dropdown-shortcuts-icon bg-label-secondary rounded-circle mb-2">
                                              <i class="bx bx-window-open fs-4"></i>
                                            </span>
                                            <a href="modal-examples.html" class="stretched-link">Modals</a>
                                            <small class="text-muted mb-0">Useful Popups</small>
                                        </div>
                                    </div>
                                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                    </div>
                                    <div class="ps__rail-y" style="top: 0px; right: 0px;">
                                        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Quick links -->

                        <!-- Notification -->
                        <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
                            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                               data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                                <i class="bx bx-map bx-sm"></i>
                                <!--                                <span class="badge bg-danger rounded-pill badge-notifications">5</span>-->
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end py-0">
                                <li class="dropdown-menu-header border-bottom">
                                    <div class="dropdown-header d-flex align-items-center py-3">
                                        <h5 class="text-body mb-0 me-auto">Minhas Rotas</h5>
                                        <a href="javascript:void(0)" class="dropdown-notifications-all text-body"
                                           data-bs-toggle="tooltip" data-bs-placement="top"
                                           aria-label="Mark all as read"><i class="bx fs-4 bx-list-ol"></i></a>
                                    </div>
                                </li>
                                <li class="dropdown-notifications-list scrollable-container ps">
                                    <ul class="list-group list-group-flush" id="result-rota-menu-li">

                                    </ul>
                                    <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                                        <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                                    </div>
                                    <div class="ps__rail-y" style="top: 0px; right: 0px;">
                                        <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 0px;"></div>
                                    </div>
                                </li>
                                <li class="dropdown-menu-footer border-top">
                                    <a href="javascript:void(0);"
                                       class="dropdown-item d-flex justify-content-center p-3">
                                        View all notifications
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!--/ Notification -->

                        <!-- User -->
                        <li class="nav-item navbar-dropdown dropdown-user dropdown">
                            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                               data-bs-toggle="dropdown">
                                <div class="avatar avatar-online">
                                    <img src="<?= theme('assets/img/avatars/1.png', SET_VIEW_THEME) ?>" alt=""
                                         class="w-px-40 h-auto rounded-circle">
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="pages-account-settings-account.html">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar avatar-online">
                                                    <img src="<?= theme('assets/img/avatars/1.png', SET_VIEW_THEME) ?>"
                                                         alt="" class="w-px-40 h-auto rounded-circle">
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <span class="fw-semibold d-block">John Doe</span>
                                                <small class="text-muted">Admin</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="pages-profile-user.html">
                                        <i class="bx bx-user me-2"></i>
                                        <span class="align-middle">My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="pages-account-settings-account.html">
                                        <i class="bx bx-cog me-2"></i>
                                        <span class="align-middle">Settings</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="pages-account-settings-billing.html">
                                      <span class="d-flex align-items-center align-middle">
                                        <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                                        <span class="flex-grow-1 align-middle">Billing</span>
                                        <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                                      </span>
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="pages-help-center-landing.html">
                                        <i class="bx bx-support me-2"></i>
                                        <span class="align-middle">Help</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="pages-faq.html">
                                        <i class="bx bx-help-circle me-2"></i>
                                        <span class="align-middle">FAQ</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="pages-pricing.html">
                                        <i class="bx bx-dollar me-2"></i>
                                        <span class="align-middle">Pricing</span>
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="auth-login-cover.html" target="_blank">
                                        <i class="bx bx-power-off me-2"></i>
                                        <span class="align-middle">Log Out</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!--/ User -->
                    </ul>
                </div>
            </nav>
            <?= $v->section("content"); ?>
        </div>
    </div>
</div>
</body>



<!-- Core JS -->
<script src="<?= theme('assets/vendor/libs/jquery/jquery.js', SET_VIEW_THEME) ?>"></script>
<script src="<?= theme('assets/vendor/libs/popper/popper.js', SET_VIEW_THEME) ?>"></script>
<script src="<?= theme('assets/vendor/js/bootstrap.js', SET_VIEW_THEME) ?>"></script>
<script src="<?= theme('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js', SET_VIEW_THEME) ?>"></script>
<script src="<?= theme('assets/vendor/js/menu.js', SET_VIEW_THEME) ?>"></script>
<script src="<?= theme("assets/js/jquery.form.js", SET_VIEW_THEME) ?>"></script>
<script src="<?= theme('assets/js/config.js', SET_VIEW_THEME) ?>"></script>
<script src="<?= theme('assets/vendor/libs/apex-charts/apexcharts.js', SET_VIEW_THEME) ?>"></script>
<script src="<?= theme('assets/vendor/libs/sweetalert2/sweetalert2.js', SET_VIEW_THEME) ?>"></script>
<script src="<?= theme('assets/vendor/libs/dropzone/dropzone.js', SET_VIEW_THEME) ?>"></script>
<script src="<?= theme('assets/js/main.js', SET_VIEW_THEME) ?>"></script>
<script src="<?= theme('assets/js/dashboards-analytics.js', SET_VIEW_THEME) ?>"></script>
<script src="<?= theme('assets/js/extended-ui-sweetalert2.js', SET_VIEW_THEME) ?>"></script>
<script src="<?= theme('assets/js/tables-datatables-extensions.js', SET_VIEW_THEME) ?>"></script>
<script src="<?= theme('assets/mapa/dropzoneUpdate.js', SET_VIEW_THEME) ?>"></script>
<script src="<?= theme('assets/vendor/js/template-customizer.js', SET_VIEW_THEME) ?>"></script>
</html>