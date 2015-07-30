@extends('admin.panel')

@section('admin-page-content')
    @if (Session::has('msg'))
        <strong>{{ Session::get('msg') }}</strong>
    @endif
    @foreach($categories as $category)
        <p>
            {{ $category->name }}
            <strong>{{ $category->table_name }}</strong>
        </p>
    @endforeach
@stop