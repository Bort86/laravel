@extends('home')

@section('content')
    @isset($arrCategory)
    <div class="card">
        <div class="card-header text-center">
           List category
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <tr class="thead-dark">
                    <th>Id</th>
                    <th>Name</th>
                </tr>
                @foreach ($arrCategory as $category) 
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    @endisset
@stop

@section('message')
    @if(isset($message))
        <div class="alert alert-warning">
            {{ $message }}
        </div>
    @endif
@stop
