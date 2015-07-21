@extends('layouts.layout')

@section('title')
    Регистрация
@stop

@section('content')
    <h2 class="page-title">Регистрация</h2>
    <div class="page-wrapper">
        <form method="POST" action="{{ url('auth/register') }}" accept-charset="UTF-8" class="register-form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label>
                <span>Имя:</span>
                <input name="name" required value="{{ old('name') }}" autocomplete="off">
            </label>
            <label>
                <span>Фамилия:</span>
                <input name="surname" required value="{{ old('surname') }}" autocomplete="off"> </label>
            <label>
                <span>e-mail:</span>
                <input name="email" type="email" required value="{{ old('email') }}" autocomplete="off">
                @if($errors->has('email'))
                    @foreach ($errors->get('email') as $error)
                        {{ $error }}
                    @endforeach
                @endif
            </label>
            <label>
                <span>Пароль:</span>
                <input name="password" type="password" required autocomplete="off">
            </label>
            <label>
                <span>Подтвердите пароль:</span>
                <input name="password_confirmation" type="password" required autocomplete="off">
                @if($errors->has('password'))
                    @foreach ($errors->get('password') as $error)
                        {{ $error }}
                    @endforeach
                @endif
            </label>
            <label>
                <span>Телефон:</span>
                <input name="phone" type="tel" required value="{{ old('phone') }}" autocomplete="off">
                @if($errors->has('phone'))
                    @foreach ($errors->get('phone') as $error)
                        {{ $error }}
                    @endforeach
                @endif
            </label>
            <label>
                <span>Организация:</span>
                <input name="organization" value="{{ old('organization') }}" autocomplete="off">
            </label>
            <label>
                <input type="submit" value="Зарегистрироваться">
            </label>
        </form>
    </div>
@stop