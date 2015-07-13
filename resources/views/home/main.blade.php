@extends('layouts\layout')

@section('title')
    Главная
@stop

@section('content')
    <div class="callbacks_container">
        <ul class="rslides" id="slider4">
            <li>
                <img src="images/tea1.jpg" alt="">
                <p class="caption">This is a caption</p>
            </li>
            <li>
                <img src="images/tea2.jpg" alt="">
                <p class="caption">This is another caption</p>
            </li>
        </ul>
    </div>
    <!--<h2 class="page-title">Главная</h2>-->
    <div class="info">
        <div>
            <h3>О нас</h3>
            <p>
                А здесь какой-то текст, который описывает всю офигенность компании и предоставляет ссылку на
                страницу с еще более крутым описанием.
            </p>
            {!! link_to('about', 'Узнать подробнее >>') !!}
        </div>
        <div>
            <h3>Продукция</h3>
            <p>
                Наша компания предлагает чай, кофе, фарфоровую и хрустальную посуду, а также разлчные продукты
            </p>
            {!! link_to('products', 'Узнать подробнее >>') !!}
        </div>
        <div>
            <h3>Предложения для клиентов</h3>
            <p>
                Постоянным клиентам мы предлагаем очень крутую скидуку! Бла-бла-бла.
            </p>
            {!! link_to('offers', 'Узнать подробнее >>') !!}
        </div>
    </div>
@stop