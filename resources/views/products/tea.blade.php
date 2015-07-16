@extends('layouts.layout')

@section('title')
    Чай
@stop

@section('content')
    <h2 class="page-title">Здесь будет чай</h2>
    <div class="page-wrapper tea">
        <div>
            <h3>Пуэр</h3>
            <img src="{{ asset('images/tea3.jpg') }}" alt="Чай" width="200px" height="99px"/>
            <p>
                Описание этого охренительного чая.
            </p>
            <!--{!! link_to('about', 'Узнать подробнее >>') !!}-->
        </div>
        <div>
            <h3>Пуэр</h3>
            <img src="{{ asset('images/tea4.jpg') }}" alt="Чай" width="200px" height="99px"/>
            <p>
                Описание этого охренительного чая.
            </p>
            <!--{!! link_to('about', 'Узнать подробнее >>') !!}-->
        </div>
        <div>
            <h3>Пуэр</h3>
            <img src="{{ asset('images/tea5.jpg') }}" alt="Чай" width="200px" height="99px"/>
            <p>
                Описание этого охренительного чая.
            </p>
            <!--{!! link_to('about', 'Узнать подробнее >>') !!}-->
        </div>
        <div>
            <h3>Пуэр</h3>
            <img src="{{ asset('images/tea6.jpg') }}" alt="Чай" width="200px" height="99px"/>
            <p>
                Описание этого охренительного чая.
            </p>
            <!--{!! link_to('about', 'Узнать подробнее >>') !!}-->
        </div>
        <div>
            <h3>Пуэр</h3>
            <img src="{{ asset('images/tea7.jpg') }}" alt="Чай" width="200px" height="99px"/>
            <p>
                Описание этого охренительного чая.
            </p>
            <!--{!! link_to('about', 'Узнать подробнее >>') !!}-->
        </div>
    </div>
@stop