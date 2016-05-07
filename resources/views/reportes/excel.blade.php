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

                            <tr>
                                <td>1</td>
                                <td>pepe</td>
                                <td>probando</td>
                                <td>Procesado</td>

                            </tr>

                        </tbody>
                    </table>

                </div>


            </div>
        </div>
    </div>
@endsection