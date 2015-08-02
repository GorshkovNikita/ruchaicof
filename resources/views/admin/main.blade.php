@extends('admin.panel')

@section('admin-page-content')
    @foreach($users as $user)
        <p>
            {{ $user->name }}
            <strong>{{ $user->email }}</strong>
        </p>
    @endforeach
@stop