@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>List Data Pegawai</h1>    

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

@stop

@section('content')
    @can('pegawai-create')        
        <a href="<?= route('pegawai.create') ?>" class="btn btn-app float-right">
            <i class="fas fa-edit"></i> Tambah
        </a>
    @endcan
    <div class="row">
        <div class="col-12">
            <div class="card ">        
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                <thead class="text-center">
                    <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Nama Pegawai</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Tanggal Masuk</th>
                    <th>Rekening</th>
                    <th>Tipe Pegawai</th>
                    <th>Bank ID</th>
                    <th>Jabatan</th>
                    <th>Bonus Loyalitas</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($pegawai as $row)
                        <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $row->username($row->user_id) }}</td>
                        <td>{{ $row->nama }}</td>
                        <td>{{ $row->email}}</td>
                        <td>{{ $row->alamat}}</td>
                        <td>{{ $row->tanggal_masuk}}</td>
                        <td>{{ $row->rekening}}</td>
                        <td>{{ $row->type_pegawai}}</td>
                        <td>{{ $row->bank_id}}</td>
                        <td>{{ $row->jabatanName($row->jabatan_id)}}</td>
                        <td>{{ $row->jabatanBonus($row->jabatan_id)}}</td>
                        {{-- <td>{{ $row->jabatanBonus($row->bonus_loyalitas) }}</td> --}}
                        <td>
                            <a class="btn btn-info" href="{{ route('pegawai.show',$row->id) }}">Show</a>
                            @can('pegawai-edit')
                                <a class="btn btn-primary" href="{{ route('pegawai.edit',$row->id) }}">Edit</a>
                            @endcan
                            @can('pegawai-delete')
                                {!! Form::open(['method' => 'DELETE','route' => ['pegawai.destroy', $row->id],'style'=>'display:inline']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            @endcan
                        </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>                
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
    <script> console.log('Hi!'); </script>
@stop
