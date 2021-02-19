@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Edit Data User</h1>

@stop

@section('content')
    {!! Form::model($permission, ['method' => 'PATCH','route' => ['permissions.update', $permission->id]]) !!}
    {{ csrf_field() }}

        <div class="card-body">
            <div class="form-group">
                <label for="name">Nama</label>
                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control','id' => 'name')) !!}
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group pt-3">
                <label for="exampleSelectRounded0">Guard Name</label>
                <select class="custom-select rounded-0" id="exampleSelectRounded0" name="guard_name">
                <option Value="web">Web</option>
                <option Value="auth">Auth</option>
                <option Value="console">Console</option>
                <option Value="api">Api</option>
                <option Value="channels">Channels</option>
                </select>
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
