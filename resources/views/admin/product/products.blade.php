@extends('admin.panel')

@section('admin-page-content')
    <h1>Продукты</h1>
    @if (session('msg'))
        <strong>{{ session('msg') }}</strong>
        <br>
    @endif
    <a class="btn btn-primary" href="{{ url('admin/product/add') }}">Добавить продукт</a>
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
        @foreach($products as $product)
            <tr>
                <td>
                    {{ $product->id }}
                </td>
                <td>
                    {{ $product->name }}
                </td>
                <td>
                    {{ $product->category_name }}
                </td>
                <td>
                    {{ $product->description }}
                </td>
                <td>
                    <a href="{{ url('admin/product/edit/'.$product->id) }}" class="btn btn-primary" style="margin-left: 20px">Изменить</a>
                    <form method="POST" action="{{ url('admin/product/delete/'.$product->id) }}" style="float: left">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="submit" class="btn btn-danger" value="Удалить">
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@stop