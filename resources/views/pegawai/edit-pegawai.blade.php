@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Edit Data Pegawai</h1>
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
            <div class="col-sm">
                    <div class="form-group">
                    <label>Tanggal Masuk</label>
                        {!! Form::date('tanggal_masuk', $pegawai->tanggal_masuk,array('class' => 'form-control')) !!}
                    </div>
                </div>
            <div class="row">
                <div class="col-sm">
                    <div class="form-group">
                        <label for="bank">Bank</label>
                        {{-- <select class="form-control" id="bank" name="bank"> --}}
                        {!! Form::select('bank', ['BCA' => 'BCA', 'Mandiri' => 'Mandiri', 'BNI' => 'BNI', 'BRI' => 'BRI', 'CIMB Niaga' => 'CIMB Niaga'], $pegawai->bank, array('class' => 'form-control')) !!}
                            {{-- <option disabled style="display:none">Bank</option>
                            <option value="BCA">BCA</option>
                            <option value="Mandiri">Mandiri</option>
                            <option value="BNI">BNI</option>
                            <option value="BRI">BRI</option>
                            <option value="CIMB Niaga">CIMB Niaga</option> --}}
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
                        {!! Form::select('jabatan_id', $jabatan, $pegawai->jabatan_id, array('class' => 'form-control')) !!}
                        {{-- <select class="form-control" id="exampleSelectBorder" name="jabatan_id"> --}}
                        {{-- {!! Form::select('type_izin', ['izin' => 'Izin', 'sakit' => 'Sakit', 'terlambat' => 'Terlambat'], $izin->type_izin, array('class' => 'form-control')) !!} --}}
                        
                            {{-- <option selected disabled style="display:none">Jabatan</option> --}}
                            {{-- @if (empty($pegawai->jabatan_id))
                                <option value="">Tidak ada</option>
                                @foreach($jabatan as $value)
                                    <option value={{ $value['id'] }}>{{ $value['name'] }}</option>
                                @endforeach
                                    @else
                                        <option value="">Tidak ada</option>
                                        @foreach($jabatan as $value)
                                        <option value={{ $value['id'] }}>{{ $value['name'] }}</option>
                                        @endforeach
                            @endif --}}
                        {{-- </select> --}}
                        <input type="hidden" name="session_id" value="{{Auth::id()}} "><br />
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="tipePegawai">Tipe Pegawai</label>
                        {!! Form::select('type_pegawai', ['Tetap' => 'Tetap', 'Magang' => 'Magang'], $pegawai->type_pegawai, array('class' => 'form-control')) !!}
                        {{-- <select class="form-control" id="tipePegawai" name="type_pegawai">
                            <option disabled style="display:none">Tipe Pegawai</option>
                            <option value="Tetap">Tetap</option>
                            <option value="Magang">Magang</option> --}}
                        </select>
                    </div>
                </div>
            </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Tunjangan</label>
                            @foreach($tunjangan as $value)
                                <br>
                                <label>{{ Form::checkbox('tunjangan_id[]', $value->id, in_array($value->id, $tunjangan_pegawai) ? true : false, array('class' => 'name')) }}
                                {{ $value->name }}</label>
                            @endforeach
                        </div>
                    </div>
            @endcan
            </div>
        </div>
        @endcan
        <!-- /.card-body -->

            <button type="submit" class="btn btn-primary ml-4 mb-5">Update</button>
    {!! Form::close() !!}
@stop
                
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
