@extends('admin.panel')

@section('admin-page-content')
    <h1>Шаг 2. Добавление значений дополнительных характеристик</h1>
    <form method="POST" action="{{ url('/admin/product/addproperties') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        @foreach($properties as $property)
            <div class="form-group">
                <label>
                    {{ $property->name }}
                    <input type="text" name="{{ $property->real_name }}" value="{{ old($property->real_name) }}" class="form-control" autocomplete="off">
                </label>
            </div>
        @endforeach

        <div class="form-group">
            <label>
                <input type="submit" value="Добавить" class="btn btn-primary">
            </label>
        </div>
    </form>
@stop