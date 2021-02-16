@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Data Pegawai</h1>

    @if ($message = Session::get('error'))
        <div class="alert alert-error">
            <p>{{ $message }}</p>
        </div>
    @endif
@stop

@section('content')
    {!! Form::open(array('route' => 'pegawai.store','method'=>'POST')) !!}
        <div class="card-body mx-auto" style="width:1080px">
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
                        <label for="bank">Bank ID</label>
                        {!! Form::text('bank_id', null, array('placeholder' => 'Bank ID','class' => 'form-control','id' => 'bank')) !!}
                    </div>
                </div>
                <div class="col-sm">
                    <div class="form-group">
                        <label for="rekening">Nomor Rekening</label>
                        {!! Form::text('rekening', null, array('placeholder' => 'Rekening','class' => 'form-control','id' => 'rekening')) !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="tipePegawai">Tipe Pegawai</label>
                {!! Form::text('type_pegawai', null, array('placeholder' => 'Tipe Pegawai','class' => 'form-control','id' => 'tipePegawai')) !!}
            </div>            
            <div class="form-group">                
                <label for="exampleSelectBorder">Jabatan</label>
                <select class="custom-select form-control-border" id="exampleSelectBorder" name="jabatan_id">              
                    @foreach($jabatan as $value)
                        <option value={{ $value['id'] }}>{{ $value['name'] }}</option>                    
                    @endforeach
                </select>
                <input type="hidden" name="session_id" value="{{Auth::id()}}"><br />
            </div>

            {{-- <div class="form-group">
                <strong>Jabatan</strong><br>       
                
                    <label>
                        {{ Form::radio('jabatan[]', $value['id'], in_array($value['id'], $jabatan) ? true : false, array('class' => 'name')) }}
                        {{ $value['name'] }}
                    </label><br>
                @endforeach                    
            </div>     --}}
        </div>
        <!-- /.card-body -->

        <div class="card-footer pb-3">
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
