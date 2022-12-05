"use_strict"

function init() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString).get('marker');

    // if (urlParams)
    //     otimizarRota(this);
    // else
    //     criar_map();

    criar_map();
}

const mostrarMarcadoreMapa = (e) => {

    console.log(carregar_registro_storage('rotas'));
    return false;

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const c = urlParams.get('marker');
    var codigo = c;//document.getElementById("codigo");
    var table = document.getElementById("result-table");

    $("#exLargeModal").modal("hide");
    table.innerHTML = "";

    //monta o map com os marcadores
    var map = new google.maps.Map(document.getElementById("map"), {
        zoom: 12,
        center: new google.maps.LatLng(-23.54, -46.61), // default to London
        disableDefaultUI: true,
        styles: options_maps.styles,
        suppressInfoWindows: true,
        suppressMarkers: true,
        markerOptions: ({
            clickable: true,
            zIndex: 3
        })
    })

    const marcadoresJSON = JSON.parse(localStorage.getItem(codigo));
    if (marcadoresJSON === null) {
        console.log('Voce precisa fazer upload do endereços')
        return false
    }
    marcadoresJSON.forEach((marcadores, i) => {
        var marker = new google.maps.Marker({
            position: new google.maps.LatLng(marcadores.latitude, marcadores.longitude),
            map: map,
            //icon: './themes/alpha-v1/assets/mapa/3210042.png'
        });

        var infoWindow = new google.maps.InfoWindow({
            content: `<div class="card mb-4">
                          <div class="card-body">
                            <h5 class="card-title">${marcadores.descricao}</h5>
                            <div class="card-subtitle mb-3">${marcadores.nome_rota} - ${marcadores.codigo_rota}</div>
                            <p class="card-text">
                              ${marcadores.endereco_completo}
                            </p>
                            <a href="javascript:void(0)" class="card-link">Card link</a>
                            <a href="javascript:void(0)" class="card-link">Another link</a>
                          </div>
                        </div>`
        });

        marker.addListener("click", () => {
            infoWindow.open(map, marker);
        });

        // google.maps.event.addListener(infoWindow, 'closeclick', () => {
        //     marker.setMap(null);
        // })
    });


}

const otimizarRota = (e) => {

    const directionsService = new google.maps.DirectionsService();
    const directionsDisplay = new google.maps.DirectionsRenderer({
        suppressMarkers: true,
        polylineOptions: {strokeColor: "#0b7cc7 "}
    });

    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString).get('marker');

    if (urlParams) {
        const json = JSON.parse(localStorage.getItem('rotas'));
        directions(resultado_busca(json, urlParams), urlParams);

        window.tour.loadMap(directionsDisplay)
        window.tour.fitBounds()
        window.tour.calcRoute(directionsService, directionsDisplay);
    } else {
        triggerModal({
            icon: 'bx-shocked',
            message: "Ops, você precisa selecionar um das suas rotas para usar esta opção.",
            color: 'red',
            title: 'Ops, Algo de errado',
            button: false,
            next_page: null
        })
    }
}

const getParamUrl = () => {
    return new URLSearchParams(window.location.search).get('marker');
}
const resultado_busca = (data, index) => {
    const jsonArray = [];
    for (let i = 0; i < data.length; i++) {
        if (data[i].chave === index) {
            jsonArray.push(data[i].registros);
        }
    }
    return jsonArray[0];
}

const name_route_init = (update = false) => {
    var lastNameRoute = JSON.parse(localStorage.getItem('lastNameRoute'));

    if (lastNameRoute === null) {

        localStorage.setItem('lastNameRoute', JSON.stringify({
            number: 1,
            routeName: "ROTA",
            routeNameFull: "ROTA 1",
            status: 'aberto'
        }));

    } else {

        let n = (parseFloat(lastNameRoute.number) + parseFloat(1));

        if (lastNameRoute.status !== 'aberto') {
            localStorage.setItem('lastNameRoute', JSON.stringify({
                number: n,
                routeName: "ROTA",
                routeNameFull: "ROTA " + n,
                status: 'aberto'
            }));
        } else {

            if (update) {
                localStorage.setItem('lastNameRoute', JSON.stringify({
                    number: n,
                    routeName: "ROTA",
                    routeNameFull: "ROTA " + n,
                    status: 'finalizar'
                }));
            }

        }

    }
    lastNameRoute = JSON.parse(localStorage.getItem('lastNameRoute'));
    document.querySelector("#nameExLarge").value = (lastNameRoute.routeNameFull);

}
name_route_init();

const directions = (stops, chave) => {

    var map = criar_map();

    if (!window.tour) window.tour = {
        updateStops: (newStops) => {
            //console.log('updateStops')
        },
        loadMap: (directionsDiplay) => {
            directionsDiplay.setMap(map)
        },
        fitBounds: () => {
            // console.log('fitBounds');
            var bounds = new google.maps.LatLngBounds();
            stops.forEach((item, i) => {
                var latitudeLongetude = new google.maps.LatLng(item.latitude, item.longitude);
                bounds.extend(latitudeLongetude);
            });
            map.fitBounds(bounds);
        },
        getMarker: (stations, map) => {
            //console.log('getMarker')
        },
        calcRoute: (directionsService, directionsDisplay) => {
            //console.log('calcRoute')
            var batches = [],
                itemsPerBatch = 50,
                itemsCounter = 0,
                wayptsExist = stops.length > 0;

            while (wayptsExist) {
                var subBatch = [],
                    subItemsCounter = 0;

                for (let i = itemsCounter; i < stops.length; i++) {
                    subItemsCounter++;
                    subBatch.push({
                        location: new window.google.maps.LatLng(stops[i].latitude, stops[i].longitude),
                        stopover: true
                    });
                    if (subItemsCounter === itemsPerBatch) break;
                }

                itemsCounter += subItemsCounter;
                batches.push(subBatch);
                wayptsExist = itemsCounter < stops.length;
                itemsCounter--;
            }

            for (let k = 0; k < batches.length; k++) {
                const lastIndex = batches[k].length - 1,
                    start = batches[k][0].location,
                    end = batches[k][lastIndex].location;

                let waypts = []; //pega os pontos restante
                waypts = batches[k];
                waypts.splice(0, 1);
                waypts.splice(waypts.length - 1, 1);

                const legs = [];
                ((kk) => {

                    const otimizado = JSON.parse(localStorage.getItem(chave));
                    if (otimizado) {
                        console.log('recuperado...')
                        toOtimizar(kk, otimizado, batches, directionsDisplay, map, chave);
                    } else {
                        console.log('inserindo...')
                        const request = {
                            origin: start,
                            destination: end,
                            waypoints: waypts,
                            optimizeWaypoints: true,
                            avoidHighways: true,
                            travelMode: google.maps.TravelMode.DRIVING,
                        }

                        directionsService.route(request, (result, status) => {
                            if (status === google.maps.DirectionsStatus.OK) { console.log('inserindo...')
                                toOtimizar(kk, result, batches, directionsDisplay, map, chave);
                                localStorage.setItem(chave, JSON.stringify(result));
                            } else {
                                triggerModal({
                                    icon: 'bx-shocked',
                                    message: "Ops, algo aconteceu de errado: " + status,
                                    color: 'red',
                                    title: 'Ops, Algo de errado',
                                    button: false,
                                    next_page: null
                                })
                            }
                        });
                    }
                })(k);
            }

        },

        calcTempo: (tempo) => {
            console.log('calcTempo')
        }
    }
}

//calcular distancia em km
const calcDistancia = (distac) => {
    console.log(distac)
    let totalDistancia = 0;
    const rotas = distac.routes[0];
    for (let i = 0; i < rotas.legs.length; i++) {
        totalDistancia += rotas.legs[i].distance.value;
    }

    return parseInt(parseInt(totalDistancia) / 1000)+" km";
}

//calcular tempo
const calcularTempo = (duration) => {

    let totalTime = 0;
    const time = duration.routes[0];

    for (let i = 0; i < time.legs.length; i++) {
        totalTime += time.legs[i].duration.value;
    }

    var hours = Math.floor(totalTime / 3600);
    var minutes = Math.floor((totalTime % 3600) / 60);
    var seconds = totalTime % 60;

    minutes = minutes < 10 ? '0' + minutes : minutes;
    seconds = seconds < 10 ? '0' + seconds : seconds;
    hours = hours < 10 ? '0' + hours : hours;

    return hours + "h " + minutes + "m";
}

//CRIAR MAP
const criar_map = () => {
    const map = new google.maps.Map(document.getElementById('map'), {
        zoom: 12,
        center: new google.maps.LatLng(-23.54, -46.61), // default to London
        disableDefaultUI: true,
        styles: options_maps.styles,
        suppressInfoWindows: true,
        suppressMarkers: true,
        markerOptions: ({
            clickable: true,
            zIndex: 3
        })
    });

    return map;
}

const toOtimizar = (kk, result, batches, directionsDisplay, map, chave) => {

    const unsortedResults = [{}];
    let directionsResultsReturned = 0;

    const unsortedResult = {order: kk, result: result};
    unsortedResults.push(unsortedResult);
    directionsResultsReturned++;

    if (directionsResultsReturned === batches.length) {

        const combinedResults = nao_triado_waypoint(unsortedResults)
        directionsDisplay.setDirections(combinedResults);


        const load_ajax = $(".ajax_load");
        load_ajax.fadeIn(200).css("display", "flex").find(".ajax_load_box_title").text("Aguarde, Otimizando sua rota...");

        // const routes = combinedResults.routes[0];
        // for (let m = 0; m < routes.legs.length; m++) {
        //     const routeSegment = m + 1
        //     summaryPanel.innerHTML += painel_resumo_html(routes, m, routeSegment);
        //     adicionar_marker(routes.legs[m].start_location, `${m + 1}`, '<h1>Ola Mundo</h1>', map);
        // }
        // const lastLeg = routes.legs.length;
        // adicionar_marker(routes.legs[lastLeg - 1].end_location, `${lastLeg + 1}`, '<h1>Ola Mundo</h1>', map);
        load_ajax.fadeOut(200);

        //arruma aqui erro
        //marker
        chave = getParamUrl();
        if(chave) {
            adicionar_marker(combinedResults.routes[0].legs[0].start_location, 'start', {descricao: "Ponto de Partida"}, map);

            let markersData = cruzamento_dados_com_waypoint_order(chave);

            for (let indexMarker = 0; indexMarker < markersData.length; indexMarker++) {
                directions_panel_card(markersData[indexMarker], indexMarker);
                adicionar_marker(new google.maps.LatLng(markersData[indexMarker].latitude, markersData[indexMarker].longitude), indexMarker, markersData[indexMarker], map);
            }

            const lastLeg = combinedResults.routes[0].legs.length;
            adicionar_marker(combinedResults.routes[0].legs[lastLeg - 1].end_location, 'end', {descricao: "Ponto de Final"}, map);
        }
       const tempo = calcularTempo(result);
       const tempo_result = document.getElementById("tempo");
       tempo_result.innerText = tempo;


        const distancia = calcDistancia(result);
        console.log(distancia)
        const distancia_result = document.getElementById("distancia");
        distancia_result.innerText = distancia;
    }
}

//ADICIONAR MARKER
const adicionar_marker = (position, index, data, map) => {

    const markerOrdem = index + 1;

    const marker = new google.maps.Marker();
    const infoWindow = new google.maps.InfoWindow();

    marker.setPosition(position);
    marker.setMap(map);

    if (index === 'start') {
        marker.setIcon('https://maps.google.com/mapfiles/kml/pal4/icon21.png')
    } else if (index === 'end') {
        marker.setIcon('https://maps.google.com/mapfiles/kml/pal3/icon23.png')
    } else {
        marker.setLabel({text: `${markerOrdem}`, color: 'white'})
        infoWindow.setContent(`<div class="card mb-6">
                                    <div class="card-body">
                                        <h5 class="card-title">#${zero_esquerda(markerOrdem, "00")} - ${data.descricao}</h5>
                                        <p class="card-text">${data.endereco_completo}</p>
                                    </div>
                                </div>`);

        marker.addListener('mouseover', () => {
            infoWindow.open(map, marker);
        });

        // assuming you also want to hide the infowindow when user mouses-out
        marker.addListener('mouseout', function() {
            infoWindow.close();
        });
    }

    return marker;
}

//TRANSAÇÃO DE DADOS
const cruzamento_dados_com_waypoint_order = (chave) => {

    const dados_original = carregar_registro_storage('rotas');
    const rotas = resultado_busca(dados_original, chave);
    const dados_waypoint_order = carregar_registro_storage(chave);

    //excluir primeiro e o último registro
    rotas.shift();
    rotas.pop()

    let resultArr = [];
    for (let i = 0; i < dados_waypoint_order.routes[0].waypoint_order.length; i++) {
        const indexOrdem = dados_waypoint_order.routes[0].waypoint_order[i];
        resultArr.push(rotas[indexOrdem])
    }
    return resultArr;
}

//NAO TRIADOS WAYPOINT
const nao_triado_waypoint = (unsortedResults) => {
    let combinedResults = [];

    unsortedResults.sort((a, b) => {
        return parseFloat(a.order) - parseFloat(b.order);
    });

    var count = 0;
    for (const key in unsortedResults) {
        if (unsortedResults[key].result != null) {
            if (unsortedResults.hasOwnProperty(key)) {
                if (count === 0) {
                    combinedResults = unsortedResults[key].result;
                } else {
                    combinedResults.routes[0].legs = combinedResults.routes[0].legs.concat(unsortedResults[key].result.routes[0].legs);
                    combinedResults.routes[0].overview_path = combinedResults.routes[0].overview_path.concat(unsortedResults[key].result.routes[0].overview_path);
                    combinedResults.routes[0].bounds = combinedResults.routes[0].bounds.extend(unsortedResults[key].result.routes[0].bounds.getNorthEast());
                    combinedResults.routes[0].bounds = combinedResults.routes[0].bounds.extend(unsortedResults[key].result.routes[0].bounds.getSouthWest());
                }
                count++;
            }
        }
    }
    return combinedResults;
}

const adicionar_infowindow = (data) => {
    const infoWindow = new google.maps.InfoWindow({
        content: content_info_window_html(data)
    });
    return infoWindow;
}

const content_info_window_html = (data) => {
    let html = `<div class="card mb-4">`;
    html += `<div class="card-body">`;
    html += `<h5 class="card-title">Teste</h5>`;
    html += `<div class="card-subtitle mb-3">02</div>`;
    html += `<p class="card-text"> 03 </p>`;
    html += `<a href="javascript:void(0)" class="card-link">Card link</a>`;
    html += `<a href="javascript:void(0)" class="card-link">Another link</a>`;
    html += `</div>`;
    html += `</div>`;
    return html;
}

//ADICIONA ROTAS NO LOCAL STORAGE
const adicionar_rotas_storage = (data) => {
    let rotas = [];
    if (localStorage.getItem('rotas')) {
        rotas = JSON.parse(localStorage.getItem('rotas'));
    }
    rotas.push(data);
    return localStorage.setItem('rotas', JSON.stringify(rotas))
}

//CARREGA OS REGISTRO SALVO NO LOCAL STORAGE (CHAVE)
const carregar_registro_storage = (chave) => {
    return JSON.parse(localStorage.getItem(chave));
}

//CRIAR O MENU COM AS ROTAS
const menu_minhas_rotas = () => {
    const lista_li = document.getElementById("result-rota-menu-li");
    lista_li.innerHTML = "";

    const url = window.location.protocol + "//" + window.location.host + window.location.pathname;

    const rotas = carregar_registro_storage('rotas');
    for (const rotasKey in rotas) {

        const html_li = `<li class="list-group-item list-group-item-action dropdown-notifications-item" data-url-open="${url}?marker=${rotas[rotasKey].chave}">
                                        
                                                <div class="d-flex">
                                                    <div class="flex-shrink-0 me-3">
                                                        <div class="avatar">
                                                            <span class="avatar-initial rounded-circle bg-label-info"><i
                                                                        class="bx bx-map"></i></span>
                                                        </div>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <h6 class="mb-1">${rotas[rotasKey].nome_rota}</h6>
                                                        <p class="mb-0">${rotas[rotasKey].chave}</p>
                                                        <small class="text-muted">Quinta Feira</small>
                                                    </div>
                                                    <div class="flex-shrink-0 dropdown-notifications-actions">
                                                        <a href="javascript:void(0)"
                                                           class="dropdown-notifications-read"><span
                                                                    class="badge badge-dot"></span></a>
                                                        <a href="javascript:void(0)"
                                                           class="dropdown-notifications-archive"><span
                                                                    class="bx bx-x"></span></a>
                                                    </div>
                                                </div>
                                        </li>`;
        lista_li.innerHTML += html_li;
    }
}
menu_minhas_rotas();

const directions_panel_card = (data, index) => {
    document.getElementById("sidebar").style.display = 'block';
    const summaryPanel = document.getElementById("directions-panel");
    let orderIndex = null;
    orderIndex = zero_esquerda((index + 1), "00");

    summaryPanel.innerHTML += `<div class="card mb-2 cursor-pointer">
                                  <div class="card-body">
                                    <div class="card-title header-elements">
                                      <h5 class="m-0 me-2 text-truncate fs-6">${data.descricao}</h5>
                                      <div class="card-title-elements ms-auto">
                                        <span class="badge bg-label-info rounded-pill">${orderIndex}</span>
                                      </div>
                                    </div>
                                    <p class="card-text fs-6">${data.endereco_completo}</p>
                                  </div>
                                </div>`;

    return summaryPanel;
}

const zero_esquerda = (number, limitZero) => {
    return (limitZero.toString() + parseInt(number)).slice(-(limitZero.length));
}

const options_maps = {
    styles: [
        {
            featureType: 'poi',
            stylers: [
                {visibility: 'off'}
            ]
        }
    ]
};

const data = {
    asdasdasd: [{
        ponto_partida: {
            position: {
                latitute: -23.63,
                longitude: -42.36
            },
            descricao: "Ponto de Partida"
        },
        ponto_final: {
            position: {
                latitute: -23.63,
                longitude: -42.36
            },
            descricao: "Ponto final"
        },
        pontos_parada: [{
            position: {
                latitute: -23.63,
                longitude: -42.36
            },
            descricao: ''
        }]
    }]
};

(function () {
})();
//console.log(data)