@extends('layouts.layout')

@section('title')
    Необходима регистрация
@stop

@section('content')
    <h2 class="page-title">Необходима регистрация</h2>
    <div class="page-wrapper recipe">
        <p>
            Для просмотра следующих разделов необходимо
            <a href="{{ url('auth/register') }}">зарегистрироваться</a> и войти в систему:
        </p>
            <ul>
                <li>
                    Рецепты
                </li>
                <li>
                    Предложения для клиентов
                </li>
            </ul>
    </div>
@stop