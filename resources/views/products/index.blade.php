@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::open([ 'route'=>'products.index','method'=>'GET','class'=>'navbar-form pull-right' ]) !!}
        <div class="input-group">
              {!! Form::select('status',['SIN PROCESAR'=>'SIN PROCESAR','PROCESADO'=> 'PROCESADO','CANCELADO'=>'CANCELADO'],$status===null?null:$status,['class'=>'form-control select-estado','aria-describedby'=>'search']) !!}
             <span class="input-group-addon" id="search">
				<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
			</span>
        </div>


        {!! Form::close() !!}
        {!! Form::open([ 'route'=>'products.procesar','method'=>'POST','class'=>'navbar-form pull-right' ]) !!}
        <table class="table table-bordered" id="productos">
            <thead>
            <th>&nbsp;</th>
            <th>Titulo</th>
            <th>Descripcion</th>
            <th>Estado</th>
            <th>Detalle</th>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{!! Form::checkbox('procesar[]',$product->id) !!}</td>
                    <td>{{$product->title}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->status}}</td>
                    <td>
                        <a href=" {{ route('item.edit',$product->id) }} "
                           class="btn btn-warning" ><span class="glyphicon glyphicon-zoom-in" aria-hidden="true" /></a>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {!! $products->appends(['status'=>$status])->render() !!}
        <div class="row">

            <div class="form-group">
                {!! Form::submit('Procesar',['class'=>'btn btn-primary']) !!}

            </div>
        </div>
        {!! Form::close() !!}
    </div>


@endsection
@section('js')
    <script>
        $('.select-estado').on('change',function(){
            this.form.submit();
        });
    </script>
    @endsection