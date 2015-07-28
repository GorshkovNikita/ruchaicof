@extends('admin.panel')

@section('admin-page-content')
    @foreach($categories as $category)
        <p>
            {{ $category->name }}
            <strong>{{ $category->table_name }}</strong>
        </p>
    @endforeach
@stop