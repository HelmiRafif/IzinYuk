@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Edit Data Izin</h1>

@stop

@section('content')
    {!! Form::model($izin, ['method' => 'PATCH','route' => ['izin.update', $izin->id]]) !!}
    {{ csrf_field() }}

        <div class="card-body">
            <div class="form-group pb-3">
                <label for="exampleSelectRounded0">Tipe Izin</label>
                <select class="custom-select rounded-0" id="exampleSelectRounded0" value={{$izin['type_izin']}} name="type_izin">
                        {{-- @if (!empty($izin['type_perizinan']))
                            <option value={{ $value['type_izin'] }}>{{ $value['name'] }}</option>
                        @endif --}}
                    {{-- <option selected disabled style="display:none">Tipe Perizinan</option> --}}
                    <option Value="Izin">Izin</option>
                    <option Value="Sakit">Sakit</option>
                    <option Value="Terlambat">Terlambat</option>
                </select>
            </div>

            <div class="row pb-2">
                <div class="col">
                    <div class="form-group">
                    <label>Tanggal Mulai : </label>
                    {!! Form::date('tanggal_mulai', null); !!}
                    </div>
                </div>

                <div class="col">
                    <div class="form-group">
                    <label>Tanggal Selesai : </label>
                    {!! Form::date('tanggal_selesai', null); !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="name">Keterangan</label>
                {!! Form::textarea('keterangan', null, array('placeholder' => 'Berikan keterangan izin','class' => 'form-control','id' => 'name','rows' => '3')) !!}
            </div>

            @can('izin-admit')
            <div class="form-group">
                <label for="status">Batalkan status diterima :</label>
                <input type="checkbox" id="status" name="status_diterima" value="Menunggu konfirmasi">
            </div>
            @endcan
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
