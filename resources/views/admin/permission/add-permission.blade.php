@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Permission</h1>
@stop

@section('content')
    {!! Form::open(['route' => ['permissions.store'], 'method' => 'POST']) !!}
        <div class="card-body">

            <div class="form-group">
            <label for="exampleInputEmail1">Permission Name</label>            
            <input type="text" name="name" class="form-control" placeholder="Permission">

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
