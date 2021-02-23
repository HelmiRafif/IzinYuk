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
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="">Gaji Pokok</label>
                        {!! Form::text('gaji_pokok', null, array('placeholder' => 'Gaji Pokok','class' => 'form-control text-right price','style' => 'width: 300px')) !!}
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="">Bonus Profesional (opsional)</label>
                        {!! Form::text('bonus_profesional', null, array('placeholder' => 'Bonus Profesional','class' => 'form-control text-right price','style' => 'width: 300px')) !!}
                    </div>
                </div>
            </div>

        </div>
        <!-- /.card-body -->
            <button type="submit" class="btn btn-primary m-3">Submit</button>
    {!! Form::close() !!}
@stop
                
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
