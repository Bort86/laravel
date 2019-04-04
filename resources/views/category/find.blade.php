@extends('home')

@section('content')
<div class="card">
    <div class="card-header text-center">
       Find category
    </div>
    <div class="card-body">
        <form method="POST" action="{{ url('/category/find') }}">
            {{-- crear dos campos ocultos para prevenir el ataque CSRF --}}
            {{-- https://es.wikipedia.org/wiki/Cross-site_request_forgery --}}
            {{ method_field('POST') }}
            {{ csrf_field() }}
            <div class="form-group">
                <label for="id">Id *:</label>
                <input class="form-control" type="text" id="id" name="id" value="{{ $objCat->id ?? old('id') }}" />
                <label for="name">Name *:</label>
                <input class="form-control" type="text" id="name" name="name" value="{{ old('name') }}" />
            </div>

            <div class="form-group">
                <button class="btn btn-success" type="submit">find</button>
                <button class="btn btn-danger" type="reset">reset</button>
                <a class="btn btn-dark" href="{{ route('catfind') }}">reload</a>
                <a class="btn btn-info" href="{{ url('/category/list') }}">return list</a>
            </div>

            <label class="alert alert-light">* Required fields</label>
        </form>
    </div>
</div>
@stop

@section('message')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @isset($message)
        <div class="alert alert-warning">
            {{ $message }}
        </div>
    @endisset
@stop