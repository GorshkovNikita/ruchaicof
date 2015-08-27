@extends('admin.panel')

@section('admin-page-content')
    <h1>Изменение рецепта "{{ $recipe->name }}"</h1>
    <form method="POST" action="{{ url('/admin/recipe/edit/' . $recipe->id) }}" enctype='multipart/form-data'>

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class='form-group'>
            <label>
                Название:
                <input type="text" name="name" value="{{ $recipe->name }}" class="form-control" autocomplete="off">
                @foreach ($errors->get('name') as $error)
                    <span class="bg-danger">{{ $error }}</span>
                @endforeach
            </label>
        </div>

        <div class='form-group'>
            <label>
                Описание:
                <textarea id="description" name="description" class="form-control">{{ $recipe->description }}</textarea>
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
                <textarea id="content" name="content" class="form-control" style="width: 1000px; height: 500px;">{{ $recipe->content }}</textarea>
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