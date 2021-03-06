@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Edit Data Potongan</h1>
@stop

@section('content')
    {!! Form::model($potongan, ['method' => 'PATCH','route' => ['potongan.update', $potongan->id]]) !!}
    {{ csrf_field() }}

        <div class="card-body">
            <div class="form-group">
                <label for="name">Nama Potongan</label>
                {!! Form::text('name', null, array('placeholder' => 'Nama Potongan','class' => 'form-control','id' => 'name',)) !!}
            </div>

            <div class="form-group">
                <label for="besarPotongan">Besar Potongan</label>
                {!! Form::text('besar_potongan', null, array('placeholder' => 'Besar Potongan','class' => 'form-control price','style' => 'width: 300px')) !!}
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
