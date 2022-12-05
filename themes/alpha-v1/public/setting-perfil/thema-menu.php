<?php $v->layout('thema'); ?>

<div class="container-xxl flex-grow-1 container-p-y">


    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Account Settings /</span> Account
    </h4>

    <div class="row fv-plugins-icon-container">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item"><a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Conta</a></li>
                <li class="nav-item"><a class="nav-link" href="pages-account-settings-security.html"><i class="bx bx-map-alt me-1"></i> Mapa</a></li>
                <li class="nav-item"><a class="nav-link" href="pages-account-settings-billing.html"><i class="bx bx-detail me-1"></i> Billing &amp; Plans</a></li>
                <li class="nav-item"><a class="nav-link" href="pages-account-settings-notifications.html"><i class="bx bx-bell me-1"></i> Notifications</a></li>
                <li class="nav-item"><a class="nav-link" href="pages-account-settings-connections.html"><i class="bx bx-link-alt me-1"></i> Connections</a></li>
            </ul>
            <?= $v->section("content"); ?>
        </div>
    </div>



</div>