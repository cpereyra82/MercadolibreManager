@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table" id="producto">
            <thead>
            <th>Titulo</th>
            <th>Descripcion</th>
            <th>Estado</th>
            </thead>
            <tbody>
            <td>{{$product->title}}</td>
            <td>{{$product->description}}</td>
            <td>{{$product->status}}</td>
            </tbody>
        </table>
        @if(count($product->items)>0)
        <table class="table table-bordered" id="detalles">
            <thead>
            <th>Id</th>
            <th>Titulo</th>
            <th>Precio</th>

            </thead>
            <tbody>
            @foreach($product->items as $item )
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->price}}</td>

                </tr>
            @endforeach
            </tbody>
        </table>

        @endif

    </div>
@endsection
