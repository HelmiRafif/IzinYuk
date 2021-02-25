@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Gaji Karyawan Bulan ini</h1>    

@stop

@section('content')
    <div class="row mx-auto px-2">
        <div class="col-md-6">
        {!! Form::open(array('route' => 'gaji.store','method'=>'POST')) !!}
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-money-bill"></i> Generate</button>
            {{ Form::date('period', \Carbon\Carbon::now(), array('class' => 'd-none')) }}
        {!! Form::close() !!}
        </div>
    </div>
@stop
                
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(function(){
            $('#table').DataTable();
        })
    </script>
@stop
