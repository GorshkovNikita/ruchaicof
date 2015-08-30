@extends('layouts.layout')

@section('title')
    О нас
@stop

@section('content')
    <h2 class="page-title">О нас</h2>
    <div class="page-wrapper">
        <div class="recipe">
            Бла-бла.
        </div>
    </div>
    <h2 class="page-title">Новости</h2>
    <div class="page-wrapper">
        @foreach($news as $item)
            <div class="news-item">
                <div>
                    <img src="{{ url('images/news/'.$item->image) }}">
                </div>
                <div>
                    <h3>{{ $item->title }}</h3>
                    <p style="font-size: 10pt; font-weight: bold;">
                        {{ $item->created_at }}
                    </p>
                    <p>
                        {{ $item->description }}
                    </p>
                    <a href="{{ url('about?id='.$item->id) }}">Узнать подробне >></a>
                </div>
            </div>
        @endforeach
    </div>
@stop