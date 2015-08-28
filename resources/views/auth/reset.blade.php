@extends('layouts.layout')

@section('title')
    Восстановление пароля
@stop

@section('content')
    <h2 class="page-title">Восстановление пароля</h2>
    <div class="page-wrapper recipe">
        <form class="register-form" role="form" method="POST" action="{{ url('/password/reset') }}">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="token" value="{{ $token }}">

                <label><span>E-Mail:</span>
                    @if($errors->has('email'))
                        <input type="email" name="email" value="{{ old('email') }}" required class="error-input">
                        @foreach ($errors->get('email') as $error)
                            <span class="error-text">{{ $error }}</span>
                        @endforeach
                    @else
                        <input type="email" name="email" value="{{ old('email') }}" required>
                    @endif
                </label>

                <label><span>Пароль:</span>
                    @if($errors->has('password'))
                        <input type="password" name="password" class="error-input" required>
                        @foreach ($errors->get('password') as $error)
                            <span class="error-text">{{ $error }}</span>
                        @endforeach
                    @else
                        <input type="password" name="password" required>
                    @endif
                </label>

                <label><span>Подтвердите пароль:</span>
                    @if($errors->has('password_confirmation'))
                        <input type="password" name="password_confirmation" class="error-input" required>
                        @foreach ($errors->get('password_confirmation') as $error)
                            <span class="error-text">{{ $error }}</span>
                        @endforeach
                    @else
                        <input type="password" name="password_confirmation" required>
                    @endif
                </label>

                <label>
                    <input type="submit" value="Восстановить пароль">
                </label>
        </form>
    </div>
@endsection