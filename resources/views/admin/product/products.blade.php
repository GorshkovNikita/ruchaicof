@extends('admin.panel')

@section('admin-page-content')
    <h1>Продукты</h1>
    @if (session('msg'))
        <strong>{{ session('msg') }}</strong>
        <br>
    @endif
    <a class="btn btn-primary" href="{{ url('admin/product/add') }}">Добавить продукт</a>
@stop