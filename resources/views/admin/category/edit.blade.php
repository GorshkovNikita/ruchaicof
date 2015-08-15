@extends('admin.panel')

@section('admin-page-content')
    <h1>Изменение категории "{{ $category->name }}"</h1>
    <form method="POST" action="{{ url('admin/category/edit/' . $category->id) }}" enctype='multipart/form-data'>

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class='form-group'>
            <label>
                Название:
                <input type="text" name="name" value="{{ $category->name }}" class="form-control" autocomplete="off">
                @foreach ($errors->get('name') as $error)
                    <span class="bg-danger">{{ $error }}</span>
                @endforeach
            </label>
        </div>

        <!--<div class='form-group'>
            <label>
                Английское название:
                <input type="text" name="table_name" id="password" value="{{ $category->table_name }}" class="form-control" autocomplete="off">
                @foreach ($errors->get('table_name') as $error)
                    <span class="bg-danger">{{ $error }}</span>
                @endforeach
            </label>
        </div>-->

        <div class='form-group'>
            <label>
                Описание:
                <textarea name="description" class="form-control">{{ $category->description }}</textarea>
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
            <input id="submit" type="submit" value="Изменить" class="btn btn-primary">
        </div>

    </form>
@stop