@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Detail Potongan</h1>    

@stop

@section('content')

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name :</strong>
                    {{ $potongan->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Gaji Pokok :</strong>
                {{ $potongan->gaji_pokok }}    
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Bonus Profesional :</strong>
                @if(empty($potongan->bonus_profesional))                                                
                <?= 'tidak ada' ?>
                @endif
                {{ $potongan->bonus_profesional }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('potongan.index') }}"> Back</a>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
