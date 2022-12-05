<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

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


    <style type="text/css">
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        #map {
            flex-basis: 0;
            flex-grow: 4;
            height: 100%;
        }

        #mensagem {
            font-family: Arial, sans-serif;
            width: 50%;
        }
    </style>
</head>
<body>
<div id="map"></div>
<div id="mensagem">
    <?php $v->layout('thema'); ?>
    <div class="content-wrapper">

    </div>

</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6CNtCA3B6fGiTWBQy3L4OgHC9GAvmdmE&libraries=&v=weekly&callback=init"
        async defer></script>
<script type="application/javascript">
    "use strict";
    
    var map;

    function init() {
        const latlng = new google.maps.LatLng(-23.54, -46.61);
        const options = {
            zoom: 12,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true,
            styles: [
                {
                    featureType: 'poi',
                    stylers: [
                        {visibility: 'off'}
                    ]
                }
            ]
        }
        map = new google.maps.Map(document.getElementById('map'), options);
        const customensage = document.getElementById("mensagem");
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(customensage);
    }

</script>
</body>

</html>