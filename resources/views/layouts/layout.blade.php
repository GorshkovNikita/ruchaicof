<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <script src="js/jquery.min.js"></script>
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/responsiveslides.css') }}" rel="stylesheet" type="text/css">
        <script src="{{ asset('js/responsiveslides.min.js') }}"></script>
        <script src="{{ asset('js/js.js') }}"></script>
    </head>
    <body>
        <header>
            <div class="container">
                <div class="top">
                    {!! link_to('/', '') !!}
                </div>
                <nav>
                    <ul class="menu">
                        <li>{!! link_to('/', 'Главная') !!}</li>
                        <li>{!! link_to('about', 'О нас') !!}</li>
                        <li>
                            {!! link_to('products', 'Продукция') !!}
                            <ul class="sub-menu">
                                <li>{!! link_to('products/tea', 'Чай') !!}</li>
                                <li>{!! link_to('products/coffee', 'Кофе') !!}</li>
                                <li>{!! link_to('products/china', 'Фарфор') !!}</li>
                                <li>{!! link_to('products/crystal', 'Хрусталь') !!}</li>
                                <li>{!! link_to('products/food', 'Продукты') !!}</li>
                            </ul>
                        </li>
                        <li>{!! link_to('offers', 'Предложения для клиентов', ['id' => 'high']) !!}</li>
                        <li>{!! link_to('contacts', 'Контакты') !!}</li>
                    </ul>
                </nav>
            </div>
        </header>

        <div class="content">
            <div class="container">
                @yield('content')
            </div>
        </div>

        <footer>
            <div class="container">

            </div>
        </footer>
        </div>
    </body>
</html>