@extends('layouts\layout')

@section('title')
    Главная
@stop

@section('content')
    <div class="callbacks_container">
        <ul class="rslides" id="slider4">
            <li>
                <img src="images/1.jpg" alt="">
                <p class="caption">This is a caption</p>
            </li>
            <li>
                <img src="images/2.jpg" alt="">
                <p class="caption">This is another caption</p>
            </li>
            <li>
                <img src="images/3.jpg" alt="">
                <p class="caption">The third caption</p>
            </li>
        </ul>
    </div>
    Это главная страница
@stop