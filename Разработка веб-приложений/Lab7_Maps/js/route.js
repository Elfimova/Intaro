function route() {
    var multiRoute = new ymaps.multiRouter.MultiRoute({
        // Точки маршрута.
        referencePoints: places
    }, {
        // Автоматически устанавливать границы карты так,
        // чтобы маршрут был виден целиком.
        boundsAutoApply: true
    });
    multiRoute.editor.start();
    // Добавление маршрута на карту.
    myMap.geoObjects.add(multiRoute);
}

$(document).ready(function() {
    $('#button_route').click(function(e) {
        e.preventDefault();
        route();
    });
});