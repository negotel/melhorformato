<?php $v->layout('thema'); ?>
<div class="content-wrapper">
    <div id="sidebar" class="py-1 ps ps--active-y" style="display: none">
        <div class="row mt-2">
        <div class="col-lg-6 col-md-6 col-sm-6 mb-1">

            <div class="card">
                <div class="card-body">
                    <div class="report-list">
                        <div class="report-list-item rounded-2 mb-1">
                            <div class="d-flex align-items-start">
                                <div class="d-flex justify-content-between align-items-end w-100 flex-wrap gap-2">
                                    <div class="d-flex flex-column">
                                        <span class="fo">Tempo da Rota</span>
                                        <h5 class="mb-0" id="tempo">00h 00m</h5>
                                    </div>
                                </div>
                                <div class="report-list-icon me-2">
                                    <div class="card-icon">
                                        <span class="badge bg-label-info p-2">
                                          <i class="bx bx-timer bx-sm"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

            <div class="col-lg-6 col-md-6 col-sm-6 mb-1">

                <div class="card">
                    <div class="card-body">
                        <div class="report-list">
                            <div class="report-list-item rounded-2 mb-1">
                                <div class="d-flex align-items-start">
                                    <div class="d-flex justify-content-between align-items-end w-100 flex-wrap gap-2">
                                        <div class="d-flex flex-column">
                                            <span>KM da Rota</span>
                                            <h5 class="mb-0" id="distancia">000 km</h5>
                                        </div>
                                    </div>
                                    <div class="report-list-icon me-2">
                                        <div class="card-icon">
                                        <span class="badge bg-label-info p-2">
                                          <i class="bx bx-map-pin bx-sm"></i>
                                        </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div id="directions-panel"></div>
    </div>
    <div id="map"></div>
</div>

<div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel4">Importa Planilhar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col mb-3">
                        <label for="nameExLarge" class="form-label">Descrição:</label>
                        <input type="text" id="nameExLarge" class="form-control" name="nameExLarge" placeholder="Digite o nome da rota">
                    </div>
                </div>

                <form class="row" id="formImport" method="post" action="<?= url('/importacao') ?>"
                      enctype="multipart/form-data">
                    <?= codigo_input() ?>
                    <div class="col mb-3">
                        <label for="nameExLarge" class="form-label">Arquivo:</label>
                        <div class="input-group">
                            <input type="file" name="inputGroupFile04" class="form-control" id="inputGroupFile04"
                                   aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                            <button class="btn btn-outline-primary" id="inputGroupFileAddon04">Validar
                                Arquivo
                            </button>
                        </div>
                    </div>
                </form>

                <div class="row py-5">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>NOME</th>
                            <th>Endereço</th>
                            <th>Latitude</th>
                            <th>Longitude</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody class="table-border-bottom-0" id="result-table">
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="mostrarMarcadoreMapa()">Mostar no Mapa</button>
            </div>
        </div>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6CNtCA3B6fGiTWBQy3L4OgHC9GAvmdmE&libraries=&v=weekly&callback=init"
        async defer></script>
<!--<script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/50/12a/intl/pt_br/common.js"></script>-->
<!--<script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/50/12a/intl/pt_br/util.js"></script>-->
<!--<script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/50/12a/intl/pt_br/map.js"></script>-->
<!--<script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/50/12a/intl/pt_br/overlay.js"></script>-->
<!--<script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/50/12a/intl/pt_br/onion.js"></script>-->
<!--<script type="text/javascript" charset="UTF-8" src="https://maps.googleapis.com/maps-api-v3/api/js/50/12a/intl/pt_br/controls.js"></script>-->
<script src="<?= theme('assets/mapa/mapa.js', SET_VIEW_THEME) ?>"></script>