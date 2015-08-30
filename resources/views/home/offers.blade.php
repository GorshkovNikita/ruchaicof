@extends('layouts.layout')

@section('title')
    Предложения для клиентов
@stop

@section('content')
    <h2 class="page-title">Предложения для клиентов</h2>
    <div class="page-wrapper">
        @foreach($offers as $offer)
            <div class="news-item">
                <div>
                    <img src="{{ url('images/offers/'.$offer->image) }}">
                </div>
                <div>
                    <h3>{{ $offer->title }}</h3>
                    <p style="font-size: 10pt; font-weight: bold;">
                        {{ $offer->created_at }}
                    </p>
                    <p>
                        {{ $offer->description }}
                    </p>
                    <a href="{{ url('offers?id='.$offer->id) }}">Узнать подробне >></a>
                </div>
            </div>
        @endforeach
    </div>
@stop