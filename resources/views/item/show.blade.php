@extends('layouts.app')

@section('content')
    <div class="container">
        <table class="table table-bordered " id="detalles">
            <thead>
            <th>Id</th>
            <th>Titulo</th>
            <th>Precio</th>

            </thead>
            <tbody>
            @foreach($items as $item )
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->price}}</td>

                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="center">
            <a href=" {{ route('reportes.index') }} "
               class="btn btn-success" >Volver</a></div>
        {!! $items->render() !!}
    </div>
@endsection
