@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Reportes</div>
                    <table class="table table-bordered" id="productos">
                        <thead>
                        <th>Id</th>
                        <th>Titulo</th>
                        <th>Descripcion</th>
                        <th>Estado</th>

                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>{{$product->title}}</td>
                                <td>{{$product->description}}</td>
                                <td>{{$product->status}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {!! $products->render() !!}
                    </div>
                <div class="row">
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="/reporting">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-5">

                                    <button type="submit" class="btn btn-primary">Generar</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection