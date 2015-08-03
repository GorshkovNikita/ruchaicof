@extends('admin.panel')

@section('admin-page-content')
    <h1>Добавить характеристику продукта</h1>
    <form method="POST" action="{{ url('admin/property/add') }}">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
            <label>
                Название:
                <input type="text" name="name" class="form-control" value="{{ old('name') }}">
            </label>
        </div>

        <div class="form-group">
            <label>
                Английское название:
                <input type="text" name="real_name" class="form-control" value="{{ old('real_name') }}">
            </label>
        </div>

        <div class="form-group">
            <label>
                <select name="type" class="form-control" >
                    <option value="0" @if (old('type') == 0) {{ 'checked' }} @endif>Число</option>
                    <option value="1" @if (old('type') == 1) {{ 'checked' }} @endif>Строка</option>
                    <option value="2" @if (old('type') == 2) {{ 'checked' }} @endif>Текст</option>
                </select>
            </label>
        </div>

        <div class='form-group'>
            <input id="submit" type="submit" value="Добавить" class="btn btn-primary">
        </div>
    </form>
@stop