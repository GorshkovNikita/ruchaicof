@extends('admin.panel')

@section('admin-page-content')
    <h2>Шаг 2. Добавление характеристик</h2>
    <form method="POST" action="{{ url('/admin/category/addcolumns') }}">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        @for ($i = 0; $i < $num; $i++)
            <div class='form-group'>
                <label>
                    Характеристика №{{ $i+1 }}:
                    <select class="form-control" name="property{{ $i }}">
                        @foreach($properties as $property)
                            <option value="{{ $property->id }}" @if($property->id == old('property' . $i)) {{ 'selected' }} @endif>{{ $property->name }}</option>
                        @endforeach
                    </select>
                    @foreach ($errors->get('property'.$i) as $error)
                        <span class="bg-danger">{{ $error }}</span>
                    @endforeach
                </label>
            </div>
        @endfor

        <input type="submit" class="btn btn-primary" value="Добавить">
    </form>
@stop