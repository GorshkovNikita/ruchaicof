@extends('admin.panel')

@section('admin-page-content')
    <h1>Администраторская панель сайта "РуЧайКоф"</h1>
    <p>
        Здесь вы можете добавлять/удалять категории и товары, просматривать информацию о
        пользователях:
    </p>
    <ul>
        <li>
            {!! link_to('admin/category', ' Категории', ['class' => 'glyphicon glyphicon-chevron-right']) !!}
        </li>
        <li>
            {!! link_to('admin/product', ' Продукты', ['class' => 'glyphicon glyphicon-chevron-right']) !!}
        </li>
        <li>
            {!! link_to('admin/user', ' Пользователи', ['class' => 'glyphicon glyphicon-chevron-right']) !!}
        </li>
        <li>
            {!! link_to('admin/property', ' Характеристики', ['class' => 'glyphicon glyphicon-chevron-right']) !!}
        </li>
    </ul>
@stop