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
    {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
    {{ csrf_field() }}

        <div class="card-body">
            <div class="form-group">
                <label for="name">Nama</label>
                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control','id' => 'name')) !!}
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control','id' => 'email')) !!}
            </div>
            <div class="form-group">
                <label for="password1">Password</label><br>
                {!! Form::password('password', null, array('placeholder' => 'Password','class' => 'form-control','id' => 'password1')) !!}
            </div>
            <div class="form-group">
                <label for="InputConfirm">Konfirmasi Password</label>
                {!! Form::password('confirm-password', null, array('placeholder' => 'Confirm Password','class' => 'form-control', 'id' => 'InputConfirm')) !!}
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
