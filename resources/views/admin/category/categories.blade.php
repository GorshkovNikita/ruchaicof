@extends('admin.panel')

@section('admin-page-content')
    @if (Session::has('msg'))
        <strong>{{ Session::get('msg') }}</strong>
    @endif
    @foreach($categories as $category)
        <div>
            @foreach($list as $item)
                <p>
                    {{ $item }} - <strong>{{ $category->$item }}</strong>
                </p>
        @endforeach
        </div>
    @endforeach
@stop