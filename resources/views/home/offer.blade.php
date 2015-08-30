@extends('layouts.layout')

@section('title')
    {{ $offer->title }}
@stop

@section('content')
    <h2 class="page-title">{{ $offer->title }}</h2>
    <div class="page-wrapper">
        <div class="recipe">
            <div class="news-top">
                <img src="{{ url('images/offers/' . $offer->image) }}">
                <div class="offer-content">
                    <span style="font-weight: bold; font-size: 10pt;">{{ $offer->created_at }}</span><br>
                    {!! $offer->content !!}
                </div>
            </div>
        </div>
    </div>
@stop