@extends('admin.panel')

@section('admin-page-content')
    <h1>Изменение новости "{{ $item->title }}"</h1>
    <form method="POST" action="{{ url('/admin/news/edit/' . $item->id) }}" enctype='multipart/form-data'>

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class='form-group'>
            <label>
                Заголовок:
                <input type="text"
                       name="title"
                       value="@if(old('title')==null){{ $item->title }}@else{{ old('title') }}@endif"
                       class="form-control"
                       autocomplete="off">
                @foreach ($errors->get('title') as $error)
                    <span class="bg-danger">{{ $error }}</span>
                @endforeach
            </label>
        </div>

        <div class='form-group'>
            <label>
                Описание:
                <textarea id="description"
                          name="description"
                          class="form-control">
                    @if(old('description')==null){{ $item->description }}@else{{ old('description') }}@endif
                </textarea>
                @foreach ($errors->get('description') as $error)
                    <span class="bg-danger">{{ $error }}</span>
                @endforeach
            </label>
        </div>

        <div class='form-group'>
            <label>Изображение:<br>
                <input name="image" type="file">
                @foreach ($errors->get('image') as $error)
                    <span class="bg-danger">{{ $error }}</span>
                @endforeach
            </label>
        </div>

        <div class='form-group'>
            <label>
                Содержание:
                <textarea id="content" name="content" class="form-control" style="width: 1000px; height: 500px;">
                    @if(old('content')==null){{ $item->content }}@else{{ old('content') }}@endif
                </textarea>
                @foreach ($errors->get('content') as $error)
                    <span class="bg-danger">{{ $error }}</span>
                @endforeach
            </label>
        </div>

        <div class='form-group'>
            <input id="submit" type="submit" value="Изменить" class="btn btn-primary">
        </div>

    </form>
    <script>
        $('#content').wysihtml5({
            "stylesheets": ["{{ asset('css/iframe-style.css') }}"]
        });
    </script>
@stop