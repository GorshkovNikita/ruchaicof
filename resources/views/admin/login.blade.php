@extends('layouts.admin-layout')

@section('title') Вход в администраторскую панель @stop

@section('content')

<div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-lock'></i> Login</h1>

    <form method="POST" action="{{ url('auth/login') }}">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class='form-group'>
            <label>
                <input type="email" name="email" placeholder="e-mail" value="{{ old('email') }}" class="form-control" autocomplete="off">
            </label>
        </div>

        <div class='form-group'>
            <label>
                <input type="password" name="password" id="password" placeholder="Пароль" value="" class="form-control" autocomplete="off">
            </label>
        </div>

        <div class='form-group'>
            <input type="submit" value="Войти" class="btn btn-primary">
        </div>

    </form>

    @if ($errors->has())
        @foreach ($errors->all() as $error)
            <div class='bg-danger alert'>{{ $error }}</div>
        @endforeach
    @endif

</div>

@stop