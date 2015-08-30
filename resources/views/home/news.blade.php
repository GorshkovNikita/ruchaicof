@extends('layouts.layout')

@section('title')
    {{ $item->title }}
@stop

@section('content')
    <h2 class="page-title">{{ $item->title }}</h2>
    <div class="page-wrapper">
        <div class="recipe">
            <div class="news-top">
                <img src="{{ url('images/news/' . $item->image) }}">
                <div>
                    <span style="font-weight: bold; font-size: 10pt;">{{ $item->created_at }}</span><br>
                    {!! $item->content !!}
                </div>
            </div>
        </div>
    </div>
@stop