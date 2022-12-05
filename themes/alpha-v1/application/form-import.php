<?php $v->layout('_container'); ?>

<div class="content-wrapper">

    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Processamento /</span> Importação
        </h4>
        <div class="row">
            <div class="col-xxl">
                <div class="card mb-4">
                    <div class="card-body">
                        <div data-action="<?= url('/app/import/file') ?>" class="dropzone needsclick dz-clickable" id="dropzone-multi">
                            <div class="dz-message needsclick">
                                Solte os arquivos aqui ou clique para fazer upload
                                <span class="note needsclick">(Seus arquivos seram processados automaticamente...)</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl">
                    <div class="card">
                        <div class="table-responsive text-nowrap">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Arquivo</th>
                                        <th>Total Registro</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="table-border-bottom-0">
                                    <tr>
                                        <td>prevent_00124552.xksd</td>
                                        <td>5255</td>
                                        <td>Aberto</td>
                                        <td><span class="badge bg-label-primary me-1"><i class="menu-icon tf-icons bx bx-layer"></i> Aberto</span></td>
                                        <td>
                                            <span class="text-nowrap">
                                                <a class="btn btn-sm btn-icon delete-record" href="#"><i class="bx bx-arrow-to-right"></i></a>
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>