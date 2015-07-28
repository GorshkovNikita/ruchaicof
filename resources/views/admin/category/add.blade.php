@extends('admin.panel')

@section('admin-page-content')
    <form method="POST" action="{{ url('/admin/category/add') }}">

        <div class='form-group'>
            <label>
                Название:
                <input type="text" name="name" value="{{ old('name') }}" class="form-control" autocomplete="off">
            </label>
        </div>

        <div class='form-group'>
            <label>
                Английское название:
                <input type="text" name="table_name" id="password" value="{{ old('table_name') }}" class="form-control" autocomplete="off">
            </label>
        </div>

        <div class='form-group'>
            <label>
                Родительская категория:
                <select name="parent_id" class="form-control">
                    <option></option>
                    <option value="1">Чай</option>
                    <option value="2">Кофе</option>
                </select>
            </label>
        </div>

        <div class='form-group'>
            <label>
                Описание:
                <textarea name="description" class="form-control"></textarea>
            </label>
        </div>

        <div class='form-group'>
            <label class="order-file-label">Изображение:<br>
                <input name="image" type="file">
            </label>
        </div>

        <div class='form-group'>
            <input type="submit" value="Добавить" class="btn btn-primary">
        </div>

    </form>

@stop