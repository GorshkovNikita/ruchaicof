@extends('admin.panel')

@section('admin-page-content')
    <h1>Предложения для клиентов</h1>
    @if (session('msg'))
        <strong>{{ session('msg') }}</strong>
        <br>
    @endif
    <a class="btn btn-primary" href="{{ url('admin/offer/add') }}">Добавить предложение</a>
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
            @foreach($offers as $offer)
                <tr>
                    <td>
                        {{ $offer->id }}
                    </td>
                    <td>
                        {{ $offer->title }}
                    </td>
                    <td>
                        {{ $offer->description }}
                    </td>
                    <td>
                        {{ $offer->created_at }}
                    </td>
                    <td>
                        <a href="{{ url('admin/offer/edit/'.$offer->id) }}" class="btn btn-primary" style="margin-left: 20px">Изменить</a>
                        <form method="POST" action="{{ url('admin/offer/delete/' . $offer->id) }}" style="float: left">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-danger" value="Удалить">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@stop