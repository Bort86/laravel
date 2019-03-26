@extends('home')

@section('content')
    @isset($arrProduct)
    <div class="card">
        <div class="card-header text-center">
           List product
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <tr class="thead-dark">
                    <th>Id</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Created</th>
                    <th>Modified</th>
                </tr>
                @foreach ($arrProduct as $product) 
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{$product->description }}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->created_at}}</td>
                        <td>{{$product->updated_at}}</td>
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
