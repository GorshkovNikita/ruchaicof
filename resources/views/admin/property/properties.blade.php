@extends('admin.panel')

@section('admin-page-content')
    <h2>Характеристики продуктов</h2>
    @if (Session::has('msg'))
        <strong>{{ Session::get('msg') }}</strong>
        <br>
    @endif
    <a class="btn btn-primary" href="{{ url('admin/property/add') }}">Добавить характеристику</a>
    <table data-toggle="table" data-height="299" class="table table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Тип</th>
            </tr>
        </thead>
        <tbody>
            @foreach($properties as $property)
                <tr>
                    <td>
                        {{ $property->id }}
                    </td>
                    <td>
                        {{ $property->name }}
                    </td>
                    <td>
                        @if ($property->type == 0)
                            {{ 'Число' }}
                        @elseif($property->type == 1)
                            {{ 'Строка' }}
                        @elseif($property->type == 2)
                            {{ 'Текст' }}
                        @else
                            {{ 'Дата' }}
                        @endif
                    </td>
                    <!--<td>
                        <a href="{{ url('admin/property/edit/'.$property->id) }}" class="btn btn-primary" style="margin-left: 20px">Изменить</a>
                        <form method="POST" action="property/delete/{{ $property->id }}" style="float: left">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="submit" class="btn btn-danger" value="Удалить">
                        </form>
                    </td>-->
                </tr>
            @endforeach
        </tbody>
    </table>
@stop