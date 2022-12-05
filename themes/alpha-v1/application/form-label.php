<?php $v->layout('_container'); ?>

<div class="content-wrapper">

    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Cadastros /</span> Etiqueta
        </h4>
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="mb-0">Cadastrar Etiquetas</h5> <small class="text-muted float-end">Cadastre o ranger de etiqueta que os correios disponibilizou.</small>
                    </div>

                    <div class="card-body">
                        <div class="col-xl">
                            <form class="needs-validation" method="post" action="<?= url('/app/label/save') ?>" enctype="multipart/form-data">
                                <?= csrf_input() ?>
                                <input type="hidden" name="action" value="<?= $action_form ?>">
                                <input type="hidden" name="id" value="<?= empty($rangerID) ? '' : $rangerID->id ?>">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="ranger-start">Ranger Inicial:</label>
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text"><i class="bx bx-tag-alt"></i></span>
                                                <input type="text" name="label_start" class="form-control" id="ranger-start" placeholder="Exem: BR00000010BR" required value="<?= empty($rangerID) ? '' : $rangerID->label_start ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="ranger-end">Ranger Final:</label>
                                            <div class="input-group input-group-merge">
                                                <span id="basic-icon-default-company2" class="input-group-text"><i class="bx bx-tag-alt"></i></span>
                                                <input type="text" name="label_end" class="form-control" id="ranger-end" placeholder="Exem: BR00000020BR" required value="<?= empty($rangerID) ? '' : $rangerID->label_end ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlSelect1" class="form-label">Status</label>
                                        <select class="form-select" id="exampleFormControlSelect1" name="status" aria-label="Default select example">
                                            <option selected="">Open this select menu</option>
                                            <option <?= selected_current(empty($rangerID) ? '' : $rangerID->status, 'ativo') ?> value="ativo">Ativo</option>
                                            <option <?= selected_current(empty($rangerID) ? '' : $rangerID->status, 'inativo') ?> value="inativo">Inativo</option>
                                        </select>
                                    </div>

                                </div>
                                <div class="row justify-content-start">
                                    <div class="col-xl-10">
                                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl">
                <div class="card">
                    <div class="card-header header-elements">
                        <span class=" me-2">Lista de Ranges</span>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="dt-fixedheader table border-top">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Etiqueta Inicial</th>
                                    <th>Etiqueta Final</th>
                                    <th>Total</th>
                                    <th>Em uso</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="table-border-bottom-0">
                                <?php if ($labels) : $t = 1;?>
                                    <?php foreach ($labels as $label) : ?>
                                        <tr <?= (!empty($rangerID) ? ($rangerID->id === $label->id ? 'class="table-secondary"' : '') : '') ?>>
                                            <td><?= $t++ ?></td>
                                            <td><?= $label->label_start ?></td>
                                            <td><?= $label->label_end ?></td>
                                            <td><?= $label->total ?? 0 ?></td>
                                            <td><?= $label->stock ?? 0 ?></td>
                                            <td><span class="badge bg-label-<?= $label->status == 'ativo' ? 'success' : 'danger' ?> me-1"><?= $label->status ?></span></td>
                                            <td>
                                                <span class="text-nowrap">

                                                    <button type="button" <?=(!empty($rangerID) ? ($rangerID->id === $label->id ? 'disabled':''):'')?> class="btn btn-icon btn-info" onclick="location.href='<?= url('/app/etiqueta/edit/'.$label->id) ?>'">
                                                        <span class="tf-icons bx bx-message-square-edit"></span>
                                                    </button>

                                                    <?php if ($label->status == 'ativo') : ?>
                                                        <button type="button" <?=(!empty($rangerID) ? ($rangerID->id === $label->id ? 'disabled':''):'')?> class="btn btn-icon btn-warning" data-url-action="<?= url("/app/etiqueta/edit/action/{$label->id}") ?>" data-form-action="status" data-type-action="inativo">
                                                            <span class="tf-icons bx bx-block"></span>
                                                        </button>
                                                    <?php elseif ($label->status == 'inativo') : ?>
                                                        <button type="button" <?=(!empty($rangerID) ? ($rangerID->id === $label->id ? 'disabled':''):'')?> class="btn btn-icon btn-success" data-url-action="<?= url("/app/etiqueta/edit/action/{$label->id}") ?>" data-form-action="status" data-type-action="ativo">
                                                            <span class="tf-icons bx bx-check"></span>
                                                        </button>
                                                    <?php endif; ?>

                                                    <button type="button" <?=(!empty($rangerID) ? ($rangerID->id === $label->id ? 'disabled':''):'')?> href="#" class="btn btn-icon btn-danger">
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