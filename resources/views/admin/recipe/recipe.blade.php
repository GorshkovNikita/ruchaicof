@extends('admin.panel')

@section('admin-page-content')
    <h1>Рецепты</h1>
    @if (session('msg'))
        <strong>{{ session('msg') }}</strong>
        <br>
    @endif
    <div class="recipe-content">
        {!! $recipe->content !!}
    </div>
@stop