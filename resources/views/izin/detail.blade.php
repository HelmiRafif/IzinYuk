@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Detail Izin</h1>    

@stop

@section('content')
    <div class="card w-75">
        <table class="table">
            <tbody>
                <tr>
                    <th>Username</th>
                    <td>:</td>
                    <td>{{ $izin->username($izin->id) }}</td>
                </tr>
                <tr>
                    <th>Tipe perizinan</th>
                    <td>:</td>
                    <td>{{ $izin->type_izin }}</td>
                </tr>
                <tr>
                    <th>Tanggal mulai</th>
                    <td>:</td>
                    <td>{{ $izin->tanggal_mulai }}</td>
                </tr>
                <tr>
                    <th>Tanggal selesai</th>
                    <td>:</td>
                    <td>{{ $izin->tanggal_selesai }}</td>
                </tr>
                <tr>
                    <th>Keterangan</th>
                    <td>:</td>
                    <td>{{ $izin->keterangan }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td>:</td>
                    <td>
                        @if($izin->status_diterima == 'Menunggu konfirmasi')
                            <label class="badge badge-warning p-2">Menunggu konfirmasi</label>
                            @elseif($izin->status_diterima == 'Ditolak')
                            <label class="badge badge-danger p-2">{{ $izin->status_diterima }}</label><br>
                            @else
                            <label class="badge badge-success p-2">{{ $izin->status_diterima }}</label>
                        @endif
                    </td>
                </tr>
                @if($izin->status_diterima == 'Diterima'||'Ditolak')
                    <tr>
                        <th>Pada</th>
                        <td>:</td>
                        <td>
                            {{ $izin->updated_at }}
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <a class="btn btn-warning text-white ml-3" title="Edit" href="{{ route('izin.edit',$izin) }}"><i class="fa fa-edit"></i></a>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
