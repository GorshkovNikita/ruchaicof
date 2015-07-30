@extends('admin.panel')

@section('admin-page-content')
    <h2>Шаг 2. Добавление характеристик</h2>
    <form method="POST" action="{{ url('/admin/category/addcolumns') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        @for ($i = 0; $i < $num; $i++)
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

        <input type="submit" class="btn btn-primary" value="Добавить">
    </form>
@stop