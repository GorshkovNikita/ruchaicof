@extends('layouts.layout')

@section('title')
    {{ $pageTitle }}
@stop

@section('content')
    <h2 class="page-title">{{ $pageTitle }}</h2>
    <div class="page-wrapper products">
        @foreach($categories as $category)
            <div>
                <h3>{{ $category->name }}</h3>
                <img src="{{ asset('images/categories/' . $category->image) }}" alt="{{ $category->name }}"/>
                <p>
                    {{ $category->description }}
                </p>
                @if($category->type == 0)
                    {!! link_to('products/' . strtolower($category->table_name), 'Узнать подробнее >>') !!}
                @elseif ($category->type == 1)
                    {!! link_to('recipes/' . strtolower($category->table_name), 'Узнать подробнее >>') !!}
                @endif
            </div>
        @endforeach
    </div>
@stop