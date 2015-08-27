@extends('admin.panel')

@section('admin-page-content')
    <h1>Загруженные изображения</h1>
    @if (session('msg'))
        <strong>{{ session('msg') }}</strong>
        <br>
    @endif
    <a class="btn btn-primary" href="{{ url('admin/image/upload') }}">Загрузить изображение</a>
    <table data-toggle="table" data-height="299" class="table table-hover">
        <thead>
            <tr>
                <th>Изображение</th>
                <th>Действие</th>
            </tr>
        </thead>
        <tbody>
            @foreach($images as $image)
                <tr>
                    <td>
                        <img src="{{ url('images/articles/'.$image) }}">
                    </td>
                    <td>
                        <button class="btn btn-primary" style="margin-right: 20px; float: left;" onclick="copyToClipboard('{{url('images/articles/'.$image)}}')">Скопировать ссылку</button>
                        <form method="POST" action="image/delete/{{$image}}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-danger" value="Удалить">
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
@stop