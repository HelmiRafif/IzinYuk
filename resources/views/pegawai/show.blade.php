@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Detail Pegawai</h1>    

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

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
                    <th>Tanggal Masuk</th>
                    <td>:</td>
                    <td>
                        @if(!empty($row->tanggal_masuk))
                        {{ $pegawai->tanggal_masuk }}
                            @else
                            Sedang tidak melakukan izin
                        @endif
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <th>
                        <a class="btn btn-warning" href="{{ route('pegawai.edit',Auth::user()->id) }}">Edit biodata</a>
                    </th>
                    <th>
                    </th>
                    <th>
                    </th>
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
