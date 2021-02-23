@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Edit Data Pegawai</h1>

    @if (count($errors) > 0)
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-ban"></i> Alert!</h5>
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
    {!! Form::model($pegawai, ['method' => 'PATCH','route' => ['pegawai.update', $pegawai->id]]) !!}
    {{ csrf_field() }}

        @can('pegawai-biodata')
        <div class="card-body">
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="namaPegawai">Nama Pegawai</label>
                        {!! Form::text('nama', null, array('placeholder' => 'Nama Pegawai','class' => 'form-control','id' => 'namaPegawai')) !!}
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="email">Email</label>
                        {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control','id' => 'email')) !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat</label>
                {!! Form::text('alamat', null, array('placeholder' => 'Alamat','class' => 'form-control','id' => 'alamat')) !!}
            </div>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="bank">Bank</label>
                        <select class="form-control" id="bank" name="bank">
                            <option disabled style="display:none">Bank</option>
                            <option value="BCA">BCA</option>
                            <option value="Mandiri">Mandiri</option>
                            <option value="BNI">BNI</option>
                            <option value="BRI">BRI</option>
                            <option value="CIMB Niaga">CIMB Niaga</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="rekening">Nomor Rekening</label>
                        {!! Form::text('rekening', null, array('placeholder' => 'Rekening','class' => 'form-control','id' => 'rekening')) !!}
                    </div>
                </div>
            </div>

            @can('pegawai-edit')
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">                
                        <label for="exampleSelectBorder">Jabatan</label>
                        <select class="form-control" id="exampleSelectBorder" name="jabatan_id">
                            <option selected disabled style="display:none">Jabatan</option>
                                @foreach($jabatan as $value)
                                    <option value={{ $value['id'] }}>{{ $value['name'] }}</option>
                                @endforeach
                        </select>
                        <input type="hidden" name="session_id" value="{{Auth::id()}} "><br />
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="tipePegawai">Tipe Pegawai</label>
                        <select class="form-control" id="tipePegawai" name="type_pegawai">
                            <option disabled style="display:none">Tipe Pegawai</option>
                            <option value="Tetap">Tetap</option>
                            <option value="Magang">Magang</option>
                        </select>
                    </div>
                </div>
            </div>
            @endcan
            </div>
        </div>
        @endcan
        <!-- /.card-body -->

            <button type="submit" class="btn btn-primary ml-4">Update</button>
    {!! Form::close() !!}
@stop
                
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
