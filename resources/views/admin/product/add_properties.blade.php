@extends('admin.panel')

@section('admin-page-content')
    <h1>Шаг 2. Добавление значений дополнительных характеристик</h1>
    <form method="POST" action="{{ url('/admin/product/addproperties') }}">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        @foreach(session('properties') as $property)
            <div class="form-group">
                <label>
                    {{ $property->name }}
                    @if($property->type == 0 || $property->type == 1)
                        <input type="text" name="{{ $property->real_name }}" value="{{ old($property->real_name) }}" class="form-control" autocomplete="off">
                    @elseif($property->type == 2)
                        <textarea name="{{ $property->real_name }}" class="form-control" autocomplete="off">
                            {{ old($property->real_name) }}
                        </textarea>
                    @elseif($property->type == 3)
                        <input type="date" name="{{ $property->real_name }}" class="form-control" autocomplete="off" value="{{ old($property->real_name) }}">
                    @endif
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