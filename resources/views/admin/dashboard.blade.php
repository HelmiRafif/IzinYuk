@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    @can('izin-list')
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-header">
                        <h5>Data Perizinan Karyawan</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover">
                        <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>ID User</th>
                            <th>ID Perizinan</th>
                            <th>Tipe Izin</th>
                            <th>Keterangan</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody class="text-center">
                            {{-- @foreach ($izin as $row)
                                <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $row->user_id }}</td>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->type_izin }}</td>
                                <td>{{ $row->keterangan }}</td>
                                <td>{{ $row->tanggal_mulai }}</td>
                                <td>{{ $row->tanggal_selesai }}</td>
                                <td> 
                                    @if(empty($row->status_diterima))
                                        <label class="badge badge-warning">Menunggu konfirmasi</label>
                                        @else{
                                            @foreach($row->status_diterima as $v)
                                                <label class="badge badge-success">{{ $v }}</label>
                                            @endforeach
                                            }
                                    @endif
                                </td>
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
                            @endforeach --}}
                        </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
        {{-- {!! $izin->render() !!} --}}
    @endcan
@stop
                
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
