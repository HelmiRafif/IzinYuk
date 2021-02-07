@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Edit Data User</h1>

    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
    @endif
@stop

@section('content')
    {!! Form::open(['route' => ['update',$user->id], 'method' => 'patch'])!!}
    {{ csrf_field() }}

        <div class="card-body">
            <div class="form-group">
            <label for="exampleInputEmail1">Nama</label>
            <input type="name" name="name" Value="<?= $user->name ?>" class="form-control" id="exampleInputEmail1" placeholder="Nama">
            </div>
            <div class="form-group">
            <label for="exampleInputPassword1">Email</label>
            <input type="email" name="email" Value="<?=  $user->email ?>" class="form-control" id="exampleInputPassword1" placeholder="Email">
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label for="InputRole">Role</label>
                    {!! Form::select('roles[]', $roles,$userRole, array('class' => 'form-control','id' => "InputRole",'multiple')) !!}
                </div>
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
