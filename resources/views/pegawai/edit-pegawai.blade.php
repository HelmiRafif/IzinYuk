@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Edit Data Pegawai</h1>

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
    {!! Form::model($jabatan, ['method' => 'PATCH','route' => ['jabatan.update', $jabatan->id]]) !!}
    {{ csrf_field() }}

        <div class="card-body">
            <div class="form-group">
                <label for="name">Nama</label>
                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control','id' => 'name',)) !!}
            </div>

            <div class="form-group">
                <label for="gajiPokok">Gaji Pokok</label>
                {!! Form::text('gaji_pokok', null, array('placeholder' => 'Gaji Pokok','class' => 'form-control','id' => 'gajiPokok')) !!}
            </div>

            <div class="form-group">
                <label for="gajiProfesional">Bonus Profesional</label>
                {!! Form::text('bonus_profesional', null, array('placeholder' => 'Bonus Profesional','class' => 'form-control','id' => 'gajiProfesional')) !!}
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
