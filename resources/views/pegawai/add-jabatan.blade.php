@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Jabatan</h1>
@stop

@section('content')
    {!! Form::open(array('route' => 'jabatan.store','method'=>'POST')) !!}
        <div class="card-body">

            <div class="form-group">
                <label for="namaJabatan">Nama Jabatan</label>            
                {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control','id' => 'namaJabatan')) !!}
            </div>
            <div class="form-group">
                <label for="gajiPokok">Gaji Pokok</label>
                {!! Form::text('gaji_pokok', null, array('placeholder' => 'Gaji Pokok','class' => 'form-control','id' => 'gajiPokok')) !!}
            </div>
            <div class="form-group">
                <label for="gajiBonus">Bonus Profesional</label>
                {!! Form::text('bonus_profesional', null, array('placeholder' => 'Bonus Profesional','class' => 'form-control','id' => 'gajiBonus')) !!}
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
