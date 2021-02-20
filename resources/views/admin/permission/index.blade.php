@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <a href="<?= route('permissions.create') ?>" class="btn btn-app float-right">
        <i class="fas fa-edit"></i> Tambah
    </a>
        <div class="row">
            <div class="col-12">
                <div class="card">
                <!-- /.card-header -->
                <div class="card-body table-responsive">
                    <table class="table table-hover text-nowrap" id="table">
                    <thead class="text-center">
                        <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Guard Name</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                    @foreach($permissions as $row)
                        <tr>
                        <td class="align-middle">{{ $row->id }}</td>
                        <td class="align-middle">{{ $row->name }}</td>
                        <td class="align-middle">{{ $row->guard_name}}</td>
                        <td>
                            @can('permission-edit')
                                <a class="btn btn-warning text-white" href="{{ route('permissions.edit',$row->id) }}"><i class="fa fa-edit"></i></a>
                            @endcan
                            @can('permission-delete')
                                {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $row->id],'style'=>'display:inline']) !!}
                                    <button type="submit" class="btn btn-danger m-2" title="Hapus">
                                        <i class="fa fa-trash"></i>
                                    </button>
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
    <script>
        $(function(){
            $('#table').DataTable();
        })
    </script>
@stop
