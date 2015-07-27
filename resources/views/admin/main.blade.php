@extends('admin.panel')

@section('admin-page-content')
    @foreach($users as $user)
            <p>{{ $user->name }}</p>
    @endforeach
@stop