@extends('layouts.layout')

@section('title')
    {{ $recipe->name }}
@stop

@section('content')
    <h2 class="page-title">Рецепт - {{ $recipe->name }}</h2>
    <div class="page-wrapper recipe">
        <div class="recipe-top">
            <div>
                <img src="{{ url('images/recipes/' . $recipe->image) }}">
            </div>
            <div>
                <h3>Описание рецепта:</h3>
                {{ $recipe->description }}
            </div>
        </div>
        <div class="recipe-content">
            {!! $recipe->content !!}
        </div>
    </div>
@stop