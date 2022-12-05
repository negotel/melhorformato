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
                            <h5 class="m-0 me-2">Lista de registro de postagem</h5>
                            <div class="card-title-elements ms-auto">
                                <button type="button" class="btn btn-info">
                                    Registro(s)
                                    <span class="badge bg-white text-primary"><?= totalRegistro($post->lote) ?></span>
                                </button>
                                <?php if ($post->status == 'aberto') : ?>
                                    <button class="dt-button btn-sm create-new btn btn-primary" data-action="add-tag" data-csrf="<?= $post->lote ?>" data-data-count="<?= $posts_objects_count ?>" data-url="<?= url("/app/postagens/{$post->lote}") ?>" data-count-tag="">
                                        <span>
                                            <i class="bx bx-purchase-tag-alt me-sm-2"></i>
                                            <span class="d-none d-sm-inline-block">Adicionar Etiquetas</span>
                                        </span>
                                    </button>
                                <?php endif; ?>
                                <button class="dt-button create-new btn btn-success" data-export="export-data" data-csrf="<?= $post->lote ?>" data-url="<?= url("/app/postagens/export/{$post->lote}") ?>">
                                    <span>
                                        <i class="bx bx-export me-sm-2"></i>
                                        <span class="d-none d-sm-inline-block">Exporta Planilha</span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Destinatario</th>
                                    <th>Etiqueta</th>
                                    <th>Cep</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php if ($posts_objects) : ?>
                                    <?php foreach ($posts_objects as $post) : ?>
                                        <tr>
                                            <td><?= $post->seq ?></td>
                                            <td><?= $post->nome ?></td>
                                            <td><?= $post->etiq ?></td>
                                            <td><?= str_pad($post->cep, 8, 0, STR_PAD_LEFT) ?></td>
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