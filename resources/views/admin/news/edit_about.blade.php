@extends('admin.panel')

@section('admin-page-content')
    <h1>Изменение информации о компании</h1>
    <form method="POST" action="{{ url('/admin/news/edit-about/') }}" enctype='multipart/form-data'>

        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class='form-group'>
            <label>
                Содержание:
                <textarea id="content" name="content" class="form-control" style="width: 1000px; height: 500px;">
                    @if(old('content')==null){{ $about->content }}@else{{ old('content') }}@endif
                </textarea>
                @foreach ($errors->get('content') as $error)
                    <span class="bg-danger">{{ $error }}</span>
                @endforeach
            </label>
        </div>

        <div class='form-group'>
            <input id="submit" type="submit" value="Изменить" class="btn btn-primary">
        </div>

    </form>
    <script>
        $('#content').wysihtml5({
            "stylesheets": ["{{ asset('css/iframe-style.css') }}"]
        });
    </script>
@stop