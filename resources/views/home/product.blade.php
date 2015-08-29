@extends('layouts.layout')

@section('title')
    {{ $product->name }}
@stop

@section('content')
    <h2 class="page-title">Продукт - {{ $product->name }}</h2>
    <div class="page-wrapper recipe">
        <div class="product-top">
            <div>
                <img src="{{ url('images/products/' . $product->image) }}">
            </div>
            <div>
                <h3>Характеристики продукта</h3>
                <div class="product-properties">
                    @foreach($properties as $property)
                        <?php $name = $property->real_name ?>
                        <strong>{{ $property->name }}</strong>: {{ $product->$name }}<br>
                    @endforeach
                </div>
                <div class="product-description">
                    <strong>Описание продукта:</strong><br>
                    <p>
                        {{ $product->description }}
                    </p>
                </div>
            </div>
        </div>

    </div>
@stop