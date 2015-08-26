@extends('layouts.layout')

@section('title')
    {{ $recipe->name }}
@stop

@section('content')
    <h2 class="page-title">Рецепт - {{ $recipe->name }}</h2>
    <div class="page-wrapper recipe">
        <!--<img src="images/recipes/{{ $recipe->image }}">-->
        <div class="recipe-content">
            {!! $recipe->content !!}
        </div>
    </div>
@stop