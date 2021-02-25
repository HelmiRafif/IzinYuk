@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Detail Pegawai</h1>    

@stop

@section('content')
    <div class="card">
        <table class="table">
            <tbody>
                <tr>
                    <th>Nama</th>
                    <td>:</td>
                    <td>{{ $pegawai->nama }}</td>
                </tr>
                <tr>
                    <th>Username</th>
                    <td>:</td>
                    <td>{{ $pegawai->username($pegawai->id) }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>:</td>
                    <td>{{ $pegawai->email }}</td>
                </tr>
                <tr>
                    <th>Alamat</th>
                    <td>:</td>
                    <td>{{ $pegawai->alamat }}</td>
                </tr>
                <tr>
                    <th>Bank</th>
                    <td>:</td>
                    <td>{{ $pegawai->bank }}</td>
                </tr>
                <tr>
                    <th>Rekening</th>
                    <td>:</td>
                    <td>{{ $pegawai->rekening }}</td>
                </tr>
                <tr>
                    <th>Tanggal Masuk</th>
                    <td>:</td>
                    <td>
                        @if(!empty($pegawai->tanggal_masuk))
                        {{ $pegawai->tanggal_masuk }}
                            @else
                            Sedang tidak melakukan izin
                        @endif
                    </td>
                </tr>
                @if(!empty($pegawai->jabatan_id))
                    <tr>
                        <th>
                        Jabatan
                        </th>
                        <td>:</td>
                        <td>{{ $pegawai->jabatanName($pegawai->jabatan_id) }}</td>
                    </tr>
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <td>
                        <span>
                            <a class="btn btn-warning text-white" href="{{ route('pegawai.biodata') }}"><i class="fa fa-edit"></i></a>
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
