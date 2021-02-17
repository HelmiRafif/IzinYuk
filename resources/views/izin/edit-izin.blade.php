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
    {!! Form::model($izin, ['method' => 'PATCH','route' => ['izin.update', $izin->id]]) !!}
    {{ csrf_field() }}

        <div class="card-body">
            <div class="form-group pb-3">
                <label for="exampleSelectRounded0">Tipe Izin</label>
                <select class="custom-select rounded-0" id="exampleSelectRounded0" name="type_izin">
                    <option selected disabled style="display:none">Tipe Perizinan</option>
                    <option Value="sakit">Sakit</option>
                    <option Value="sakit">Hal Penting</option>
                    <option Value="cuti hamil">Cuti Hamil</option>    
                    <option Value="cuti tahunan">Cuti Tahunan</option>
                    <option Value="cuti besar">Cuti Besar</option>
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
                <label for="name">Keterangan</label>
                {!! Form::textarea('keterangan', null, array('placeholder' => 'Berikan keterangan izin','class' => 'form-control','id' => 'name','rows' => '3')) !!}
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
