// загрузятся все компоненты API, а также когда будет готово DOM-дерево.


$('.js-open-street-map').each(function () {
    initOpenStreetMap($(this));
});

$(function () {
    $('.js-yandex-map').each(function () {
            let $map = $(this);
            ymaps.ready(function () {
                    initYandexMap($map);
                }
            );
        }
    );
});


function initYandexMap($map) {

    let mapState = $map.data('mapState');

    let myMap = new ymaps.Map($map[0], mapState);

    let urlTemplate = $map.data('urlTemplate');

    let loadingObjectManager = new ymaps.LoadingObjectManager(urlTemplate, {
        // Включаем кластеризацию.
        clusterize: true,
        // Зададим опции кластерам.
        // Опции кластеров задаются с префиксом cluster.
        clusterHasBalloon: false,
        // Опции объектов задаются с префиксом geoObject.
        geoObjectOpenBalloonOnClick: true
    });
    myMap.geoObjects.add(loadingObjectManager);

    myMap.events.add('boundschange', function (e) {
        let newBounds = e.get('newBounds');
        let back = false;
        if (newBounds && newBounds[0][0] < -85) {
            back = true;
        }
        if (newBounds && newBounds[1][0] > 85) {
            back = true;
        }
        if (back) {
            setTimeout(function () {
                myMap.setBounds(e.get('oldBounds'));
                myMap.setZoom(e.get('oldZoom'));
            }, 1);
            return false;
        }
        return true;
    });
}


function initOpenStreetMap($map) {
    let mymap;
    let loadDataStatus = 'normal';
    let alreadyAddedOffices = [];
    let mapState = $map.data('mapState');
    let urlTemplate = $map.data('urlTemplate');
    mymap = L.map($map[0], mapState);
    let copyright = new L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    });
    copyright.addTo(mymap);
    mymap.addControl(new L.Control.Fullscreen());

    let officeLayer = L.markerClusterGroup();
    mymap.addLayer(officeLayer);

    function outputPart(features, k) {
        let startTime = new Date();
        let n = features.length;
        for (i = k; i < n; i++) {
            if((new Date()).getTime() - startTime.getTime() > 45){
                setTimeout(function(){
                    outputPart(features, i);
                },1);
                break;
            }
            office = features[i];
            if (!alreadyAddedOffices.includes(office.id)) {
                alreadyAddedOffices.push(office.id);
                let marker = L.marker(office.geometry.coordinates).addTo(officeLayer);
                // let marker = L.marker(coords).addTo(mymap);
                marker.bindTooltip(office.properties.hintContent)
                    .bindPopup(office.properties.balloonContent);
            }
        }
        let hasQueue = ('queue' == loadDataStatus);
        loadDataStatus = 'normal';
        if(hasQueue){
            fillOpenStreetMap();
        }
    }

    function output(collection) {
        outputPart(collection.features, 0);
    }

    function fillOpenStreetMap() {
        if(loadDataStatus != 'normal'){
            loadDataStatus = 'queue';
            return;
        }
        loadDataStatus = 'stop';
        let bounds = mymap.getBounds();
        let bbox = [bounds.getSouth(), bounds.getWest(), bounds.getNorth(), bounds.getEast()].join(',');
        let url = urlTemplate.replace('%b', bbox);
        $.get(url).done(function (t) {
            eval('output' + t);
        });

    }

    fillOpenStreetMap();
    mymap.on('zoomend', fillOpenStreetMap)
    mymap.on('moveend', fillOpenStreetMap)
}
