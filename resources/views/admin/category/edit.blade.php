@extends('admin.panel')

@section('admin-page-content')
    <h1>Изменение категории "{{ $category->name }}"</h1>
    <form method="POST" action="{{ url('') }}" enctype='multipart/form-data'>

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

        <div class='form-group'>
            <label>
                Английское название:
                <input type="text" name="table_name" id="password" value="{{ $category->table_name }}" class="form-control" autocomplete="off">
                @foreach ($errors->get('table_name') as $error)
                    <span class="bg-danger">{{ $error }}</span>
                @endforeach
            </label>
        </div>

        <div class='form-group'>
            <label>
                Родительская категория:
                <select name="parent_id" class="form-control">
                    <option value="" @if ($category->parent_id == null) {{ 'selected' }} @endif>-- Это корневая категория --</option>
                    <option value="1" @if ($category->parent_id == 1) {{ 'selected' }} @endif>Чай</option>
                    <option value="2" @if ($category->parent_id == 2) {{ 'selected' }} @endif>Кофе</option>
                </select>
            </label>
        </div>

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
            <label>
                Эта категория будет содержать продукты?
                <select id="is_final" name="final" class="form-control">
                    <option id="is_final_true" value="1" @if ($category->final == 1) {{ 'selected' }} @endif>Да</option>
                    <option id="is_final_false" value="0" @if ($category->final == 0) {{ 'selected' }} @endif>Нет</option>
                </select>
                @foreach ($errors->get('final') as $error)
                    <span class="bg-danger">{{ $error }}</span>
                @endforeach
            </label>
        </div>

        @for ($i = 0; $i < $category->num_columns; $i++)
            <div class='form-group'>
                <label>
                    Название характеристики №{{ $i+1 }}:
                    <input type="text" name="name{{ $i }}" value="{{ old('name'.$i) }}" class="form-control" autocomplete="off">
                    @foreach ($errors->get('name'.$i) as $error)
                        <span class="bg-danger">{{ $error }}</span>
                    @endforeach
                </label>
            </div>

            <div class='form-group'>
                <label>
                    Тип характеристики №{{ $i+1 }}:
                    <select class="form-control" name="type{{ $i }}">
                        <option value="0">Число</option>
                        <option value="1">Строка</option>
                        <option value="2">Текст</option>
                    </select>
                    @foreach ($errors->get('type'.$i) as $error)
                        <span class="bg-danger">{{ $error }}</span>
                    @endforeach
                </label>
            </div>
        @endfor

        <div id="num_cols" class='form-group'>
            <label>
                Количество дополнительных характеристик:
                <select id="columns_number" name="num_columns" class="form-control">
                    <option value="0" @if ($category->num_columns == 0) {{ 'selected' }} @endif>0</option>
                    <option value="1" @if ($category->num_columns == 1) {{ 'selected' }} @endif>1</option>
                    <option value="2" @if ($category->num_columns == 2) {{ 'selected' }} @endif>2</option>
                    <option value="3" @if ($category->num_columns == 3) {{ 'selected' }} @endif>3</option>
                    <option value="4" @if ($category->num_columns == 4) {{ 'selected' }} @endif>4</option>
                    <option value="5" @if ($category->num_columns == 5) {{ 'selected' }} @endif>5</option>
                    <option value="6" @if ($category->num_columns == 6) {{ 'selected' }} @endif>6</option>
                    <option value="7" @if ($category->num_columns == 7) {{ 'selected' }} @endif>7</option>
                    <option value="8" @if ($category->num_columns == 8) {{ 'selected' }} @endif>8</option>
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