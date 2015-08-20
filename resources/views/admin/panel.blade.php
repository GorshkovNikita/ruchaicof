@extends('layouts.admin-layout')

@section('title')
    Администраторская панель
@stop

@section('content')
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                {!! link_to('admin', 'РуЧайКоф', ['class' => 'navbar-brand']) !!}
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <!--<li class="active">{!! link_to('admin', 'Home') !!}</li>-->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Категории <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li>{!! link_to('admin/category?type=0', 'Продукты') !!}</li>
                            <li>{!! link_to('admin/category?type=1', 'Рецепты') !!}</li>
                        </ul>
                    </li>
                    <li>{!! link_to('admin/product', 'Продукты') !!}</li>
                    <li>{!! link_to('admin/user', 'Пользователи') !!}</li>
                    <li>{!! link_to('admin/property', 'Характеристики') !!}</li>

                </ul>
                </div>
        </div>
    </div>

    <div class="admin-page-content">
        <div class="container">
            @yield('admin-page-content')
        </div>
    </div>

@stop