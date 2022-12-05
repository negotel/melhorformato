<?php $v->layout('_container'); ?>

<div class="content-wrapper">

    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Definir /</span> Lista Postagem
        </h4>
        <div class="row">
            <div class="col-xxl">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title header-elements">
                            <h5 class="m-0 me-2">Lista de postagem</h5>
                            <div class="card-title-elements ms-auto">
                                <a class="dt-button create-new btn btn-info" href="<?=url('app/importacao/arquivo')?>">
                                    <span>
                                        <i class="bx bx-plus me-sm-2"></i>
                                        <span class="d-none d-sm-inline-block">Importa Planilha</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover datatables-basic">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Lote</th>
                                    <th>Arquivo</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php if ($posts) : ?>
                                    <?php $c = 1;
                                    foreach ($posts as $post) : ?>
                                        <tr>
                                            <td><?= $c++; ?></td>
                                            <td><?= $post->lote ?></td>
                                            <td><?= $post->arquivo ?></td>
                                            <td><?= totalRegistro($post->lote) ?></td>
                                            <td><span class="badge bg-label-<?= $post->status == 'ativo' ? 'primary' : 'info' ?> me-1"><i class="menu-icon tf-icons bx bx-layer"></i> <?= $post->status ?></span></td>
                                            <td>
                                                <span class="text-nowrap">
                                                    <button type="button" class="btn btn-icon btn-info" onclick="location.href='<?= url('/app/postagens/' . $post->lote) ?>'">
                                                        <span class="tf-icons bx bx-arrow-to-right"></span>
                                                    </button>
                                                    <button type="button" href="#" class="btn btn-icon btn-danger">
                                                        <span class="tf-icons bx bx-trash"></span>
                                                    </button>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>