@extends('admin.panel')

@section('admin-page-content')
    <h2>Шаг 1. Создание категории</h2>
    <form method="POST" action="{{ url('/admin/category/add') }}" enctype='multipart/form-data'>

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

        <!--<div class='form-group'>
            <label>
                Английское название:
                <input type="text" name="table_name" id="password" value="{{ old('table_name') }}" class="form-control" autocomplete="off">
                @foreach ($errors->get('table_name') as $error)
                    <span class="bg-danger">{{ $error }}</span>
                @endforeach
            </label>
        </div>-->

        <div class='form-group'>
            <label>
                Родительская категория:
                <select name="parent_id" class="form-control">
                    <option value="" @if (old('parent_id') == "") {{ 'selected' }} @endif>-- Это корневая категория --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            @if (old('parent_id') == $category->id) {{ 'selected' }} @endif>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
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
            <label>
                Эта категория будет содержать продукты?
                <select id="is_final" name="final" class="form-control">
                    <option id="is_final_true" value="1" @if (old('final') == 1) {{ 'selected' }} @endif>Да</option>
                    <option id="is_final_false" value="0" @if (old('final') == 0) {{ 'selected' }} @endif>Нет</option>
                </select>
                @foreach ($errors->get('final') as $error)
                    <span class="bg-danger">{{ $error }}</span>
                @endforeach
            </label>
        </div>

        <div id="num_cols" class='form-group'>
            <label>
                Количество дополнительных характеристик:
                <select id="columns_number" name="num_columns" class="form-control">
                    <option value="0" @if (old('num_columns') == 0) {{ 'selected' }} @endif>0</option>
                    <option value="1" @if (old('num_columns') == 1) {{ 'selected' }} @endif>1</option>
                    <option value="2" @if (old('num_columns') == 2) {{ 'selected' }} @endif>2</option>
                    <option value="3" @if (old('num_columns') == 3) {{ 'selected' }} @endif>3</option>
                    <option value="4" @if (old('num_columns') == 4) {{ 'selected' }} @endif>4</option>
                    <option value="5" @if (old('num_columns') == 5) {{ 'selected' }} @endif>5</option>
                    <option value="6" @if (old('num_columns') == 6) {{ 'selected' }} @endif>6</option>
                    <option value="7" @if (old('num_columns') == 7) {{ 'selected' }} @endif>7</option>
                    <option value="8" @if (old('num_columns') == 8) {{ 'selected' }} @endif>8</option>
                </select>
                @foreach ($errors->get('num_columns') as $error)
                    <span class="bg-danger">{{ $error }}</span>
                @endforeach
            </label>
        </div>

        <div class='form-group'>
            <input id="submit" type="submit" value="Добавить" class="btn btn-primary">
        </div>

    </form>

@stop