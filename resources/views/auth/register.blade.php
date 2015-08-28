@extends('layouts.layout')

@section('title')
    Регистрация
@stop

@section('content')
    <h2 class="page-title">Регистрация</h2>
    <div class="page-wrapper recipe">
        <div class="register-paragraph">
            <p>
                При регистрации Вы получаете доступ к слудующим разделам:
            </p>
            <ul>
                <li>
                    {!! link_to('offers', 'Предложения для клиентов') !!}
                </li>
                <li>
                    {!! link_to('recipes', 'Рецепты') !!}
                </li>
            </ul>
        </div>
        <form method="POST" action="{{ url('auth/register') }}" accept-charset="UTF-8" class="register-form">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label>
                <span>Имя*:</span>
                <input name="name" required value="{{ old('name') }}" autocomplete="off">
            </label>
            <label>
                <span>Фамилия*:</span>
                <input name="surname" required value="{{ old('surname') }}" autocomplete="off"> </label>
            <label>
                <span>E-Mail*:</span>
                @if($errors->has('email'))
                    <input name="email" type="email" required value="{{ old('email') }}" class="error-input" autocomplete="off">
                    @foreach ($errors->get('email') as $error)
                        <span class="error-text">{{ $error }}</span>
                    @endforeach
                @else
                    <input name="email" type="email" required value="{{ old('email') }}" autocomplete="off">
                @endif
            </label>
            <label>
                <span>Пароль*:</span>
                @if($errors->has('password'))
                    <input name="password" type="password" class="error-input" required autocomplete="off">
                    @foreach ($errors->get('password') as $error)
                        <span class="error-text">{{ $error }}</span>
                    @endforeach
                @else
                    <input name="password" type="password" required autocomplete="off">
                @endif
            </label>
            <label>
                <span>Подтвердите пароль*:</span>
                @if($errors->has('password'))
                    <input name="password_confirmation" type="password" class="error-input" required autocomplete="off">
                    @foreach ($errors->get('password_confirmation') as $error)
                        <span class="error-text">{{ $error }}</span>
                    @endforeach
                @else
                    <input name="password_confirmation" type="password" required autocomplete="off">
                @endif
            </label>
            <label>
                <span>Телефон*:</span>
                @if($errors->has('phone'))
                    <input name="phone" type="tel" required value="{{ old('phone') }}" class="error-input" autocomplete="off">
                    @foreach ($errors->get('phone') as $error)
                        <span class="error-text">{{ $error }}</span>
                    @endforeach
                @else
                    <input name="phone" type="tel" required value="{{ old('phone') }}" autocomplete="off">
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