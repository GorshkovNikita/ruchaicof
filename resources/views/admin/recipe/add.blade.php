@extends('admin.panel')

@section('admin-page-content')
    <h1>Шаг 1. Создание рецепта</h1>
    <form method="POST" action="{{ url('/admin/product/add') }}" enctype='multipart/form-data'>

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class='form-group'>
            <label>
                Название:
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" autocomplete="off">
                @foreach ($errors->get('name') as $error)
                    <span class="bg-danger">{{ $error }}</span>
                @endforeach
            </label>
        </div>

        <div class='form-group'>
            <label>
                Описание:
                <textarea id="description" name="description" class="form-control" style="width: 1000px; height: 500px;">{{ old('description') }}</textarea>
                @foreach ($errors->get('description') as $error)
                    <span class="bg-danger">{{ $error }}</span>
                @endforeach
            </label>
        </div>

        <div class='form-group'>
            <input id="submit" type="submit" value="Далее" class="btn btn-primary">
        </div>

    </form>
    <script>
        $('#description').wysihtml5();
    </script>
@stop