@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Tambah Data Tunjangan</h1>
@stop

@section('content')
    {!! Form::open(['route' => ['tunjangan.store'], 'method' => 'POST']) !!}
        <div class="card-body">

            <div class="form-group">
                <label for="nameTunjangan">Nama Tunjangan</label>            
                {!! Form::text('name', null, array('placeholder' => 'Nama Tunjangan','class' => 'form-control','id' => 'nameTunjangan')) !!}
            </div>

            <div class="form-group pt-3">
                <label for="nominal">Besar Nominal</label>
                {!! Form::text('besar_tunjangan', null, array('placeholder' => 'Besar Nominal','class' => 'form-control text-right price','style' => 'width: 300px')) !!}
                </select>
            </div>
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
