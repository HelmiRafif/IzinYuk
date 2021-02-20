@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="pull-left">
        <h2>Ajukan Perizinan</h2>
    </div>
    <div class="pull-right">
        <a class="btn btn-primary" href="{{ route('izin.index') }}"> Back</a>
    </div>
@stop

@section('content')
    {!! Form::open(array('route' => 'izin.store','method'=>'POST')) !!}
        <div class="card-body">            
            {{-- <div class="form-group">
            <label for="idRole">Role ID</label>
            {!! Form::number('role_id', null, array('placeholder' => 'Role ID','class' => 'form-control','id' => 'idRole')) !!}
            </div> --}}
            <div class="form-group pb-3">
                <label for="exampleSelectRounded0">Tipe Izin</label>
                <select class="custom-select rounded-0" id="exampleSelectRounded0" name="type_izin">
                <option selected disabled style="display:none">Tipe Perizinan</option>
                <option Value="Izin">Izin</option>
                <option Value="sakit">Sakit</option>
                <option Value="Terlambat">Terlambat</option>    
                </select>
            </div>

            <div class="row pb-2">
                <div class="col">
                    <div class="form-group">
                    <label>Tanggal Mulai : </label>
                    {!! Form::date('tanggal_mulai', \Carbon\Carbon::now()); !!}
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                    <label>Tanggal Selesai : </label>
                    {!! Form::date('tanggal_selesai', \Carbon\Carbon::now()); !!}
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="ket">Keterangan</label>
                {!! Form::textarea('keterangan', null, array('placeholder' => 'Berikan keterangan izin','class' => 'form-control', 'rows' => '3','id' => 'ket')) !!}
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
