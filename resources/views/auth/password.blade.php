@extends('layouts.layout')

@section('title')
    Восстановление пароля
@stop

@section('content')
    <h2 class="page-title">Восстановление пароля</h2>
    <div class="page-wrapper recipe">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            <br>
        @endif

        <p>
            Для восстановления пароля введите свой e-mail. На введенный адрес будет отправлена ссылка, по
            которой Вы сможете создать новый пароль учетной записи.
        </p>

        <form class="email-reset" role="form" method="POST" action="{{ url('/password/email') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label>
                e-mail:
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
                <input type="submit" value="Отправить ссылку для восстановления пароля">
            </label>
        </form>
    </div>
@endsection