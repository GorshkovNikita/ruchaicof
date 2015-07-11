<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <link href="css/style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class="container">
            <header>
                <div class="top">

                </div>
                <nav>
                    <ul class="menu">
                        <li><a href="#">Главная</a></li>
                        <li><a href="#">О нас</a></li>
                        <li>
                            <a href="#">Продукция</a>
                            <ul class="sub-menu">
                                <li><a href="#">Чай</a></li>
                                <li><a href="#">Кофе</a></li>
                                <li><a href="#">Фарфор</a></li>
                                <li><a href="#">Хрусталь</a></li>
                                <li><a href="#">Продукты</a></li>
                            </ul>
                        </li>
                        <li><a href="#" id="high">Предложения для клиентов</a></li>
                        <li><a href="#">Контакты</a></li>
                    </ul>
                </nav>
            </header>

            <div class="content">
                @yield('content')
            </div>

            <footer>

            </footer>
        </div>
    </body>
</html>