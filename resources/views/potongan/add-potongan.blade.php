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
                {!! Form::text('name', null, array('placeholder' => 'Nama Potongan','class' => 'form-control','id' => 'namaPotongan')) !!}
            </div>
            <div class="form-group">
                <label for="besarPotongan">Gaji Pokok</label>
                {!! Form::text('besar_potongan', null, array('placeholder' => 'Besar Potongan','class' => 'form-control','id' => 'besarPotongan')) !!}
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
