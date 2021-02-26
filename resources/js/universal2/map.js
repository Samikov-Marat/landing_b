// загрузятся все компоненты API, а также когда будет готово DOM-дерево.
ymaps.ready(init);
function init(){
    // Создание карты.
    var myMap = new ymaps.Map("map", {
        // Координаты центра карты.
        // Порядок по умолчанию: «широта, долгота».
        // Чтобы не определять координаты центра карты вручную,
        // воспользуйтесь инструментом Определение координат.
        center: [51.947811, 0.626560],
        // Уровень масштабирования. Допустимые значения:
        // от 0 (весь мир) до 19.
        zoom: 9
    });

    var urlTemplate = $('#map').data('urlTemplate');

    var loadingObjectManager = new ymaps.LoadingObjectManager(urlTemplate, {
        // Включаем кластеризацию.
        clusterize: true,
        // Зададим опции кластерам.
        // Опции кластеров задаются с префиксом cluster.
        clusterHasBalloon: false,
        // Опции объектов задаются с префиксом geoObject.
        geoObjectOpenBalloonOnClick: false
    });
    myMap.geoObjects.add(loadingObjectManager);

    let myPlacemark = new ymaps.Placemark([51.776848, 0.117733], {
        balloonContentHeader: $('#harlow_baloon .js-baloon-header').html(),
        balloonContentBody: $('#harlow_baloon .js-baloon-body').html(),
        balloonContentFooter: $('#harlow_baloon .js-baloon-footer').html(),
        hintContent: $('#harlow_baloon .js-baloon-header').html()
    });
    myMap.geoObjects.add(myPlacemark);

    let myPlacemark2 = new ymaps.Placemark([52.055652, 1.148427], {
        balloonContentHeader: $('#ipswich_baloon .js-baloon-header').html(),
        balloonContentBody: $('#ipswich_baloon .js-baloon-body').html(),
        balloonContentFooter: $('#ipswich_baloon .js-baloon-footer').html(),
        hintContent: $('#ipswich_baloon .js-baloon-header').html()
    });
    myMap.geoObjects.add(myPlacemark2);


}
