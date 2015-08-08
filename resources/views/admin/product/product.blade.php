@extends('admin.panel')

@section('admin-page-content')
    @if (!isset($product))
        Такого продукта не существует.
    @else
        {{ $product->name }}
    @endif
@stop