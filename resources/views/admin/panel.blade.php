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
                <a class="navbar-brand" href="#">РуЧайКоф</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active">{!! link_to('admin', 'Home') !!}</li>
                    <li>{!! link_to('admin/category', 'Категории') !!}</li>
                    <li><a href="#contact">Продукция</a></li>
                    <li><a href="#users">Пользователи</a></li>
                    <li>{!! link_to('admin/property', 'Характеристики') !!}</li>
                    <!--<li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li class="divider"></li>
                            <li class="dropdown-header">Nav header</li>
                            <li><a href="#">Separated link</a></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>-->
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