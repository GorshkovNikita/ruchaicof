@extends('layouts.layout')

@section('title')
    Регистрация
@stop

@section('content')
    <h2 class="page-title">Регистрация</h2>
    <div class="page-wrapper">
        <form method="POST" action="{{ url('auth/register') }}" accept-charset="UTF-8" class="register-form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}?>">
            <label>
                <span>Имя:</span>
                <input name="name" required >
            </label>
            <label>
                <span>Фамилия:</span>
                <input name="surname" required > </label>
            <label>
                <span>e-mail:</span>
                <input name="email" type="email" required >
            </label>
            <label>
                <span>Пароль:</span>
                <input name="password" type="password" required >
            </label>
            <label>
                <span>Подтвердите пароль:</span>
                <input name="password_confirmation" type="password" required >
            </label>
            <label>
                <span>Телефон:</span>
                <input name="phone" type="tel" required>
            </label>
            <label>
                <span>Организация:</span>
                <input name="organization">
            </label>
            <label>
                <input type="submit" value="Зарегистрироваться">
            </label>
        </form>
    </div>
@stop