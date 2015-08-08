@extends('admin.panel')

@section('admin-page-content')
    <h1>Шаг 1. Создание продукта</h1>
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
                Категория:
                <select name="category_id" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                        @if (old('category_id') == $category->id) {{ 'selected' }} @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @foreach ($errors->get('category_id') as $error)
                    <span class="bg-danger">{{ $error }}</span>
                @endforeach
            </label>
        </div>

        <div class='form-group'>
            <label>
                Краткое описание:
                <textarea name="short_description" class="form-control">{{ old('short_description') }}</textarea>
                @foreach ($errors->get('short_description') as $error)
                    <span class="bg-danger">{{ $error }}</span>
                @endforeach
            </label>
        </div>

        <div class='form-group'>
            <label>
                Описание:
                <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                @foreach ($errors->get('description') as $error)
                    <span class="bg-danger">{{ $error }}</span>
                @endforeach
            </label>
        </div>

        <div class='form-group'>
            <label>Изображение:<br>
                <input name="image" type="file" value="{{ old('image') }}">
                @foreach ($errors->get('image') as $error)
                    <span class="bg-danger">{{ $error }}</span>
                @endforeach
            </label>
        </div>

        <div class='form-group'>
            <input id="submit" type="submit" value="Далее" class="btn btn-primary">
        </div>

    </form>
@stop