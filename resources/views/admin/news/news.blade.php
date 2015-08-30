@extends('admin.panel')

@section('admin-page-content')
    <h1>Новости</h1>
    @if (session('msg'))
        <strong>{{ session('msg') }}</strong>
        <br>
    @endif
    <a class="btn btn-primary" href="{{ url('admin/news/add') }}">Добавить новость</a>
    <table data-toggle="table" data-height="299" class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Заголовок</th>
                <th>Описание</th>
                <th>Дата публикации</th>
                <th>Действие</th>
            </tr>
        </thead>
        <tbody>
            @foreach($news as $item)
                <tr>
                    <td>
                        {{ $item->id }}
                    </td>
                    <td>
                        {{ $item->title }}
                    </td>
                    <td>
                        {{ $item->description }}
                    </td>
                    <td>
                        {{ $item->created_at }}
                    </td>
                    <td>
                        <a href="{{ url('admin/news/edit/'.$item->id) }}" class="btn btn-primary" style="margin-left: 20px">Изменить</a>
                        <form method="POST" action="{{ url('admin/news/delete/' . $item->id) }}" style="float: left">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-danger" value="Удалить">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop