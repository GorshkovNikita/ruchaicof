@extends('admin.panel')

@section('admin-page-content')
    <h1>Пользователи</h1>
    @if (session('msg'))
        <strong>{{ session('msg') }}</strong>
        <br>
    @endif
    <table data-toggle="table" data-height="299" class="table table-hover">
        <thead>
        <tr>
            <th>ID</th>
            <th>Имя</th>
            <th>Электронная почта</th>
            <th>Телефон</th>
            <th>Организация</th>
        </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        {{ $user->id }}
                    </td>
                    <td>
                        {{ $user->name }}
                        {{ $user->surname }}
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td>
                        {{ $user->phone }}
                    </td>
                    <td>
                        {{ $user->organization }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop