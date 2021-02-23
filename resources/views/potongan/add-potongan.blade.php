@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Potongan</h1>
@stop

@section('content')
    {!! Form::open(array('route' => 'potongan.store','method'=>'POST')) !!}
        <div class="card-body">

            <div class="form-group">
                <label for="namaPotongan">Nama Potongan</label>            
                {!! Form::text('name', null, array('placeholder' => 'ex : Terlambat','class' => 'form-control price','id' => 'namaPotongan', 'style' => 'width: 500px')) !!}
            </div>
            <div class="form-group">
                <label for="">Besar Potongan</label>
                {!! Form::text('besar_potongan', null, array('class' => 'form-control text-right price','style' => 'width: 300px')) !!}
            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    {!! Form::close() !!}
@stop
                
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
