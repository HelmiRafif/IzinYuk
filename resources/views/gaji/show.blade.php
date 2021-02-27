@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')

@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card w-75 mx-auto">
                <div class="card-header text-center">
                    @if(empty($gaji))
                        <h4>Maaf, Belum ada data yang tersedia</h4>
                        @else
                        <h5>Detail Gaji</h5>
                </div>
                <div class="card-body table-striped p-0">
                    <table class="table table-striped" id="table">
                        <tbody class="text-center">
                            <tr>
                                <td class="w-25">Nama Pegawai</td>
                                <td>:</td>
                                <td>{{ $gaji->nama }}</td>
                            </tr>
                            <tr>
                                <td class="w-25">Tanggal</td>
                                <td>:</td>
                                <td>{{ $gaji->period }}</td>
                            </tr>
                            <tr>
                                <td class="w-25">Bonus Loyalitas</td>
                                <td>:</td>
                                <td>{{ $gaji->bonus_loyalitas }}</td>
                            </tr>
                            <tr>
                                <td class="w-25">Total Tunjangan</td>
                                <td>:</td>
                                <td>{{ $gaji->total_tunjangan }}</td>
                            </tr>
                            <tr>
                                <td class="w-25">Total Gaji</td>
                                <td>:</td>
                                <td>{{ $gaji->total_gaji }}</td>
                            </tr>
                            @if($gaji->total_tunjangan > 0)
                                <tr>
                                    <td>Rincian Tunjangan</td>
                                    <td colspan="2">
                                    @foreach($tunjangan as $tunjangan)
                                        <li>
                                        {{ $tunjangan->name }}
                                        :
                                        {{ $tunjangan->besar_tunjangan }}
                                        </li>
                                    @endforeach
                                </tr>
                            @endif
                        </tbody>
                    </table>   
                    @endif             
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
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
