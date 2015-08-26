@extends('layouts.layout')

@section('title')
    {{ $pageTitle }}
@stop

@section('content')
    <h2 class="page-title">{{ $pageTitle }}</h2>
    <div class="page-wrapper products">
        @foreach($recipes as $recipe)
            <div>
                <h3>{{ $recipe->name }}</h3>
                <img src="{{ asset('images/recipes/' . $recipe->image) }}" alt="{{ $recipe->name }}"/>
                <p>
                    {{ $recipe->description }}
                </p>
                {!! link_to('recipes?id=' . $recipe->id, 'Узнать подробнее >>') !!}
            </div>
        @endforeach
    </div>
@stop