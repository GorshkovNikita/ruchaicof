@extends('admin.panel')

@section('admin-page-content')
    <h1>Рецепты</h1>
    @if (session('msg'))
        <strong>{{ session('msg') }}</strong>
        <br>
    @endif
    <a class="btn btn-primary" href="{{ url('admin/recipe/add') }}">Добавить рецепт</a>
    <table data-toggle="table" data-height="299" class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Категория</th>
                <th>Описание</th>
                <th>Действие</th>
            </tr>
        </thead>
        <tbody>
        @foreach($recipes as $recipe)
            <tr>
                <td>
                    {{ $recipe->id }}
                </td>
                <td>
                    {{ $recipe->name }}
                </td>
                <td>
                    {{ $recipe->category_name }}
                </td>
                <td>
                    {{ $recipe->description }}
                </td>
                <td>
                    <a href="{{ url('admin/recipe/edit/'.$recipe->id) }}" class="btn btn-primary" style="margin-left: 20px">Изменить</a>
                    <form method="POST" action="{{ url('admin/recipe/delete/' . $recipe->id) }}" style="float: left">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" class="btn btn-danger" value="Удалить">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop