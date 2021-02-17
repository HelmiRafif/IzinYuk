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
                        @foreach ($izin as $row)
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
                                    @else
                                            <label class="badge badge-success">{{ $row->status_diterima }}</label>
                                @endif
                            </td>
                            <td>
                                <a class="btn btn-info" href="{{ route('izin.show',$row->id) }}">Show</a>
                                @can('izin-edit')
                                    <a class="btn btn-primary" href="{{ route('izin.edit',$row->id) }}">Edit</a>
                                @endcan
                                @can('izin-admit')
                                    @if(!empty($row->status_diterima))
                                        @else
                                            {!! Form::open(['method' => 'PATCH' ,'route' => ['izin.admit',$row->id]]) !!}
                                                <button class="btn btn-success" type="submit" name="status_diterima" value="Diterima">
                                                Setujui
                                                </button>
                                            {!! Form::close() !!}
                                    @endif
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
