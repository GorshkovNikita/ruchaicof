@extends('layouts.layout')

@section('title')
    Продукция
@stop

@section('content')
    <h2 class="page-title">Наша продукция</h2>
    <div class="page-wrapper products">
        <div>
            <h3>Чай</h3>
            <img src="{{ asset('images/tea_prod.png') }}" alt="Чай" height="150px"/>
            <p>
                У нас вы можете заказать офигенный чай.
            </p>
            {!! link_to('products/tea', 'Узнать подробнее >>') !!}
        </div>
        <div>
            <h3>Кофе</h3>
            <img src="{{ asset('images/coffee_prod.png') }}" alt="Кофе" height="150px"/>
            <p>
                У нас вы можете заказать офигенный кофе.
            </p>
            {!! link_to('products/coffee', 'Узнать подробнее >>') !!}
        </div>
        <div>
            <h3>Фарфоровая посуда</h3>
            <img src="{{ asset('images/china.jpg') }}" alt="Фарфор" height="150px"/>
            <p>
                Постоянным клиентам мы предлагаем очень крутую скидуку! Бла-бла-бла.
            </p>
            {!! link_to('products/china', 'Узнать подробнее >>') !!}
        </div>
        <div>
            <h3>Хрустальная посуда</h3>
            <img src="{{ asset('images/china.jpg') }}" alt="Фарфор" height="150px"/>
            <p>
                Постоянным клиентам мы предлагаем очень крутую скидуку! Бла-бла-бла.
            </p>
            {!! link_to('products/crystal', 'Узнать подробнее >>') !!}
        </div>
    </div>
@stop