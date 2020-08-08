var Place;
var Metro;
var Name_metro;
var Name_place;
var count_request = false;
var button_route = false;

$(document).ready(function() {
    $('#search').submit(function(e) {
        e.preventDefault();
        //Получаем место
        var place = $(this).find($('#place')).val();
        var pointList;
        //отправляем запрос в геокодер
        $.ajax({
            url: "https://geocode-maps.yandex.ru/1.x/?apikey=555b2a9f-b331-4c9d-8d22-9b57782980eb&format=json&kind=metro&geocode="+place,
            success: function(response)
            {
                /*if(!count_request){
                    $('#route_table').show();
                }
                else { 
					$('#route_table').show();
                    $('#create_route').show();
                    //button_route = true;
                }*/
				$('#route_table').show();
                $('#create_route').show();

                //Добавляем точку на карту
                var point = response.response.GeoObjectCollection.featureMember[0].GeoObject.Point.pos;
                var re = ' ';
                pointList = point.split(re);
                Place = [parseFloat(pointList[1]), parseFloat(pointList[0])];
                Name_place = place;
                addObject(place, 'метка', Place);

                //Добавляем адрес в список интересных мест
				
				//////////////////////////////
                if(count_request) { 
					$('#route_table > tbody:last-child').pop(); 
				}
				$('#route_table > tbody:last-child').append( '<tr>' + '<th scope="row">' + place +'</th>' + '<td>' + Place + '</td>' + '</tr>');
                count_request=true;

                //Поиск метро
                var geocode_str = Place[1] + ',' + Place[0];
                $.ajax({
                    url: 'https://geocode-maps.yandex.ru/1.x/?apikey=555b2a9f-b331-4c9d-8d22-9b57782980eb&geocode=' +
                        geocode_str + '&kind=metro&format=json&results=1',
                    success: function(data)
                    {
                        var point_metro = data.response.GeoObjectCollection.featureMember[0].GeoObject.Point.pos;
                        pointList = point.split(re);
                        Metro = [parseFloat(pointList[1]), parseFloat(pointList[0])];
                        Name_metro = data.response.GeoObjectCollection.featureMember[0].GeoObject.name;
                        addObject(Name_metro, 'метро', Metro);
                    }
                });
            }
        });
    });
});

function addObject(place, status, point) {
    var preset_type;
    if(status == 'метро'){
        preset_type = 'islands#redStretchyIcon';
    }
    else if(status == 'метка'){
        preset_type = 'islands#blackStretchyIcon';
    }
    // Создание геообъекта с типом точка (метка).
    var myGeoObject = new ymaps.GeoObject({
        geometry: {
            type: "Point", // тип геометрии - точка
            coordinates: point, // координаты точки
            metro: true
        },
        properties: {
            iconContent: place,
        },
    },{
        preset: preset_type,
        // Метку можно перемещать.
        draggable: true
    });
    // Размещение геообъекта на карте.
    myMap.geoObjects.add(myGeoObject);
}