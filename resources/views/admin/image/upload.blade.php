@extends('admin.panel')

@section('admin-page-content')
    <h1>Загрузка изображения</h1>
    <form method="POST" action="{{ url('/admin/image/upload') }}" enctype='multipart/form-data'>

        <input type="hidden" name="_token" value="{{{ csrf_token() }}}">

        <div class="form-group">
            <label>Название:<br>
                <input name="name" class="form-control" type="text" value="{{ old('name') }}">
                @foreach ($errors->get('name') as $error)
                    <span class="bg-danger">{{ $error }}</span>
                @endforeach
            </label>
        </div>

        <div class='form-group'>
            <label>Изображение:<br>
                <input name="image" type="file" value="{{ old('image') }}">
                @foreach ($errors->get('image') as $error)
                    <span class="bg-danger">{{ $error }}</span>
                @endforeach
            </label>
        </div>

        <div class='form-group'>
            <input id="submit" type="submit" value="Загрузить" class="btn btn-primary">
        </div>

    </form>
@stop