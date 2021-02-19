@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Edit Data Tunjangan</h1>
@stop

@section('content')
    {!! Form::model($tunjangan, ['method' => 'PATCH','route' => ['tunjangan.update', $tunjangan->id]]) !!}
    {{ csrf_field() }}

        <div class="card-body">
            <div class="form-group">
                <label for="name">Nama Tunjangan</label>
                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control','id' => 'name')) !!}
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group pt-3">
                <label for="nominal">Nominal Tunjangan</label>
                {!! Form::text('besar_tunjangan', null, array('placeholder' => 'Nominal Tunjangan','class' => 'form-control','id' => 'nominal')) !!}
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    {!! Form::close() !!}
@stop
                
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
