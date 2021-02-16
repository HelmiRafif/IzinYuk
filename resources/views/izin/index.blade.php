@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Data Perizinan</h1>    

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

@stop

@section('content')
    <div class="row mx-auto px-2">
        <div class="col-12">
            <div class="card ">                    
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                        <th>No</th>                    
                        <th>ID Perizinan</th>
                        <th>Pegawai ID</th>
                        <th>Tipe Izin</th>
                        <th>Keterangan</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th>Status</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($izin as $row)
                            <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $row->id }}</td>
                            <td>{{ $row->pegawai_id }}</td>
                            <td>{{ $row->type_izin }}</td>
                            <td>{{ $row->keterangan }}</td>
                            <td>{{ $row->tanggal_mulai }}</td>
                            <td>{{ $row->tanggal_selesai }}</td>
                            <td>{{ $row->status_diterima }}</td>
                            <td>
                                <a class="btn btn-info" href="{{ route('izin.show',$row->id) }}">Show</a>
                                @can('izin-edit')
                                    <a class="btn btn-primary" href="{{ route('izin.edit',$row->id) }}">Edit</a>
                                @endcan
                                @can('izin-delete')
                                    {!! Form::open(['method' => 'DELETE','route' => ['izin.destroy', $row->id],'style'=>'display:inline']) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                    {!! Form::close() !!}
                                @endcan
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                    </table>
                    {!! $izin->render() !!}
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
