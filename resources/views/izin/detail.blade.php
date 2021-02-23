@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Detail Izin</h1>    

@stop

@section('content')
    <div class="card">
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
            </tbody>
            <tfoot>
                <tr>
                    <td>
                        <span>
                            <a class="btn btn-warning text-white" href="{{ route('izin.edit',$izin) }}"><i class="fa fa-edit"></i></a>
                        </span>
                    </td>
                    <td>
                    </td>
                    <td>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
