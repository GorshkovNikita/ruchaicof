@extends('admin.panel')

@section('admin-page-content')
    <h1>Добавление характеристики продукта</h1>
    <form method="POST" action="{{ url('admin/property/add') }}">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
            <label>
                Название:
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                @foreach ($errors->get('name') as $error)
                    <span class="bg-danger">{{ $error }}</span>
                @endforeach
            </label>
        </div>

        <!--<div class="form-group">
            <label>
                Английское название:
                <input type="text" name="real_name" class="form-control" value="{{ old('real_name') }}">
                @foreach ($errors->get('real_name') as $error)
                    <span class="bg-danger">{{ $error }}</span>
                @endforeach
            </label>
        </div>-->

        <div class="form-group">
            <label>
                Тип значения:
                <select name="type" class="form-control" >
                    <option value="0" @if (old('type') == 0) {{ 'checked' }} @endif>Число</option>
                    <option value="1" @if (old('type') == 1) {{ 'checked' }} @endif>Строка</option>
                    <option value="2" @if (old('type') == 2) {{ 'checked' }} @endif>Текст</option>
                    <option value="3" @if (old('type') == 3) {{ 'checked' }} @endif>Дата</option>
                </select>
                @foreach ($errors->get('type') as $error)
                    <span class="bg-danger">{{ $error }}</span>
                @endforeach
            </label>
        </div>

        <div class='form-group'>
            <input id="submit" type="submit" value="Добавить" class="btn btn-primary">
        </div>
    </form>
@stop