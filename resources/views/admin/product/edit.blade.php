@extends('admin.panel')

@section('admin-page-content')
    <h1>Изменение продукта "{{ $product->name }}"</h1>
    <form method="POST" action="{{ url('/admin/product/edit/' . $product->id) }}" enctype='multipart/form-data'>

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class='form-group'>
            <label>
                Название:
                <input type="text" name="name" value="{{ $product->name }}" class="form-control" autocomplete="off">
                @foreach ($errors->get('name') as $error)
                    <span class="bg-danger">{{ $error }}</span>
                @endforeach
            </label>
        </div>

        <div class='form-group'>
            <label>
                Короткое описание:
                <textarea id="description" name="short_description" class="form-control">{{ $product->short_description }}</textarea>
                @foreach ($errors->get('short_description') as $error)
                    <span class="bg-danger">{{ $error }}</span>
                @endforeach
            </label>
        </div>

        <div class='form-group'>
            <label>
                Описание:
                <textarea id="description" name="description" class="form-control">{{ $product->description }}</textarea>
                @foreach ($errors->get('description') as $error)
                    <span class="bg-danger">{{ $error }}</span>
                @endforeach
            </label>
        </div>

        <div class='form-group'>
            <label>Изображение:<br>
                <input name="image" type="file">
                @foreach ($errors->get('image') as $error)
                    <span class="bg-danger">{{ $error }}</span>
                @endforeach
            </label>
        </div>

        @foreach ($properties as $property)
            <div class='form-group'>
                <?php $name = $property->real_name ?>
                <label>{{ $property->name }}<br>
                    @if($property->type == 0 || $property->type == 1)
                        <input type="text" name="{{ $property->real_name }}" value="{{ $product->$name }}" class="form-control" autocomplete="off">
                    @elseif($property->type == 2)
                        <textarea name="{{ $property->real_name }}" class="form-control" autocomplete="off">
                            {{ $product->$name }}
                        </textarea>
                    @elseif($property->type == 3)
                        <input type="date" name="{{ $property->real_name }}" class="form-control" autocomplete="off" value="{{ $product->$name }}">
                    @endif
                    @foreach ($errors->get($property->real_name) as $error)
                        <span class="bg-danger">{{ $error }}</span>
                    @endforeach
                </label>
            </div>
        @endforeach

        <div class='form-group'>
            <input id="submit" type="submit" value="Изменить" class="btn btn-primary">
        </div>

    </form>
@stop