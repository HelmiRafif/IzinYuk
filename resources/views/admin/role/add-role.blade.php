@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="pull-left">
        <h2>Create New Role</h2>
    </div>
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
    </div>
@stop

@section('content')
    {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
        <div class="card-body">
            <div class="form-group">
            <label for="nameRole">Role Name</label>
            {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control','id' => 'nameRole')) !!}
            </div>
            {{-- <div class="form-group">
            <label for="idRole">Role ID</label>
            {!! Form::number('role_id', null, array('placeholder' => 'Role ID','class' => 'form-control','id' => 'idRole')) !!}
            </div> --}}

            <div class="form-group">
                <label for="exampleSelectRounded0">Guard Name</label>
                <select class="custom-select rounded-0" id="exampleSelectRounded0" name="guard_name">
                <option Value="web">Web</option>
                <option Value="auth">Auth</option>
                <option Value="console">Console</option>
                <option Value="api">Api</option>
                <option Value="channels">Channels</option>
                </select>
            </div>

            <div class="form-group">
                <strong>Permission:</strong>
                <br/>

                @foreach($permissions as $value)
                    <label>{{ Form::checkbox('permission[]', $value['id'], in_array($value['id'], $permissions) ? true : false, array('class' => 'name')) }}
                    {{ $value['name'] }}</label>
                <br/>
                @endforeach
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
