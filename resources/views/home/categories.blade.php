@extends('layouts.layout')

@section('title')
    Продукция
@stop

@section('content')
    <h2 class="page-title">{{ $pageTitle }}</h2>
    <div class="page-wrapper products">
        @foreach($categories as $category)
            <div>
                <h3>{{ $category->name }}</h3>
                <img src="{{ asset('images/categories/' . $category->image) }}" alt="{{ $category->name }}" height="150px"/>
                <p>
                    {{ $category->description }}
                </p>
                {!! link_to('products/' . strtolower($category->table_name), 'Узнать подробнее >>') !!}
            </div>
        @endforeach
    </div>
@stop