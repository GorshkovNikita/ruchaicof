@extends('layouts.layout')

@section('title')
    Контакты
@stop

@section('content')
    <h2 class="page-title">Контакты</h2>
    <div class="page-wrapper recipe">
        <div class="contacts" style="width: 480px; padding-right: 15px height: 450px; float: left">
            <h4>Связаться с нами Вы можете одним из нескольких способов:</h4>
            <ul>
                <li>
                    По телефону: <strong>8 (495) 777-77-90</strong>
                </li>
                <li>
                    Написать на почту: <strong>ruchaicof@mail.ru</strong>
                </li>
                <li>
                    Прийти в офис по адресу: <strong>Варшавское ш. 148к1</strong>
                </li>
                <li>
                    Время работы: <strong>пн-пт 10:00-18:00</strong>
                </li>
            </ul>
        </div>
        <div id="map" style="width: 450px; height: 450px; float: left;"></div>
    </div>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
    <script type="text/javascript">
        ymaps.ready(init);
        var myMap, myPlacemark;

        function init(){
            myMap = new ymaps.Map ("map", {
                center: [55.60103, 37.601448],
                zoom: 17
            });

            myPlacemark = new ymaps.Placemark([55.60103, 37.601448]);
            myMap.geoObjects.add(myPlacemark);
        }
    </script>
@stop