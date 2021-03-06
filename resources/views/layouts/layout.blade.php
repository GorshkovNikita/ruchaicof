<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/responsiveslides.css') }}" rel="stylesheet" type="text/css">
        <script src="{{ asset('js/responsiveslides.min.js') }}"></script>
        <script src="{{ asset('js/js.js') }}"></script>
    </head>
    <body>
        <header>
            <div class="container">
                <div class="top">
                    <div class="top-phone">
                        <ul>
                            <li>
                                +7 (495) 624-59-21
                            </li>
                            <li>
                                ruchaicof@info.ru
                            </li>
                            <li>
                                пн-пт 10:00-18:00
                            </li>
                        </ul>
                    </div>
                    {!! link_to('/', '') !!}
                    <div class="top-login">
                        @if (Auth::check())
                            <form method="GET" action="{{ url('/auth/logout') }}" class="login-form logout-form">
                                <a href="{{ url('offers') }}" style="margin-right: 10px;">
                                    <img src="{{ url('images/procent-badge-48.png') }}">
                                </a>
                                <a href="{{ url('products') }}" style="margin-right: 10px;">
                                    <img src="{{ url('images/cart-59-48.png') }}">
                                </a>
                                <a href="{{ url('recipes') }}">
                                    <img src="{{ url('images/restaurant-3-48 (1).png') }}">
                                </a>
                                <br><br>
                                Здравствуйте, <strong>{!! Auth::user()->name !!}!</strong>
                                <input type="hidden" name="_token" value="{{ Auth::user()->getRememberToken() }}">
                                <label>
                                    <input type="submit" value="Выйти">
                                </label>
                            </form>
                        @else
                            <form method="POST" action="{{ url('/auth/login') }}" class="login-form">
                                @if ($errors->has())
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <label>
                                        <input type="email" name="email" placeholder="e-mail" value="{{ old('email') }}" class="error-input" autocomplete="off">
                                    </label>
                                    <label>
                                        <input type="password" name="password" id="password" placeholder="Пароль" value="" class="error-input" autocomplete="off">
                                    </label>
                                @else
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <label>
                                        <input type="email" name="email" placeholder="e-mail" value="{{ old('email') }}"  autocomplete="off">
                                    </label>
                                    <label>
                                        <input type="password" name="password" id="password" placeholder="Пароль" value="" autocomplete="off">
                                    </label>
                                @endif
                                <label>
                                    <span>
                                        <input type="checkbox" name="remember"> Запомнить.
                                        <a href="{{ url('password/email') }}" style="display: inline; text-decoration: underline">Забыли пароль?</a>
                                    </span>
                                </label>
                                <label>
                                    <input type="submit" value="Войти">
                                </label>
                                <a href="{{ url('auth/register') }}" style="text-decoration: underline">Зарегистрироваться</a>
                            </form>
                        @endif
                    </div>
                </div>
                <nav>
                    <ul class="menu">
                        <li>{!! link_to('/', 'Главная') !!}</li>
                        <li>{!! link_to('about', 'О нас') !!}</li>
                        <li>
                            {!! link_to('products', 'Продукция') !!}
                            <ul class="sub-menu">
                                @foreach(session('root_categories') as $category)
                                    <li>{!! link_to('products/' . $category->table_name, $category->name) !!}</li>
                                @endforeach
                            </ul>
                        </li>
                        <li style="width: 180px">{!! link_to('offers', 'Предложения для клиентов', ['id' => 'high']) !!}</li>
                        <li>{!! link_to('recipes', 'Рецепты') !!}
                            @if (Auth::check())
                                <ul class="sub-menu">
                                    @foreach(session('root_recipe_categories') as $category)
                                        <li>{!! link_to('recipes/' . $category->table_name, $category->name) !!}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
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
                <div>
                    <img src="{{ url('images/logo.png') }}">
                </div>
                <ul>
                    <li>
                        +7 (495) 624-59-21
                    </li>
                    <li>
                        ruchaicof@info.ru
                    </li>
                </ul>
                <ul>
                    <li>
                        <a href="{{ url('about') }}">О нас</a>
                    </li>
                    <li>
                        <a href="{{ url('products') }}">Продукция</a>
                    </li>
                    <li>
                        <a href="{{ url('contacts') }}">Контакты</a>
                    </li>
                </ul>
                <ul>
                    <li>
                        РуЧайКоф © 2015
                    </li>
                    <li>
                        Разрабатывается ГенРек
                    </li>
                    <li>
                        Продвигается ГенРек
                    </li>
                </ul>
            </div>
        </footer>
        </div>
    </body>
</html>