@extends('admin.panel')

@section('admin-page-content')
    <h1>Категории
        @if($type == 0)
            {{ 'продуктов' }}
        @elseif($type == 1)
            {{ 'рецептов' }}
        @endif
    </h1>
    @if (session('msg'))
        <strong>{{ session('msg') }}</strong>
        <br>
    @endif
    <a class="btn btn-primary" href="{{ url('admin/category/add?type=' . $type) }}">Добавить категорию</a>
    <table data-toggle="table" data-height="299" class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Родительская категория</th>
                <th>Описание</th>
                <th>Действие</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>
                        {{ $category->id }}
                    </td>
                    <td>
                        {{ $category->name }}
                    </td>
                    <td>
                        @if ($category->parent_id != null)
                            {{ $category->parent_name }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        {{ $category->description }}
                    </td>
                    <td>
                        <a href="{{ url('admin/category/edit/'.$category->id) }}" class="btn btn-primary" style="margin-left: 20px">Изменить</a>
                        <form method="POST" action="{{ url('admin/category/delete/'. $category->id) }}" style="float: left">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-danger" value="Удалить">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop