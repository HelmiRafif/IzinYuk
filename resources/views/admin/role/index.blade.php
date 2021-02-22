@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    @can('role-create')        
        <a href="<?= route('roles.create') ?>" class="btn btn-app float-right">
            <i class="fas fa-edit"></i> Tambah
        </a>
    @endcan
    
    <div class="row">
        <div class="col-12">
            <div class="card ">

            <!-- /.card-header -->
            <div class="card-body table-responsive">
                <table class="table table-hover text-nowrap" id="table">
                <thead class="text-center">
                    <tr>
                    <th>No</th>                    
                    <th>Name</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($roles as $key => $role)
                        <tr>
                        <td class="align-middle">{{ $role->id }}</td>                        
                        <td class="align-middle">{{ $role->name }}</td>
                        <td>
                            <a class="btn btn-primary m-2" href="{{ route('roles.show',$role->id) }}"><i class="fa fa-info"></i></a>
                            @can('role-edit')
                                <a class="btn btn-warning m-2 text-white" href="{{ route('roles.edit',$role->id) }}"><i class="fa fa-edit"></i></a>
                            @endcan
                            @can('role-delete')
                                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                    <button type="submit" class="btn btn-secondary m-2" title="Hapus">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                {!! Form::close() !!}
                            @endcan
                        </td>
                        </tr>
                    @endforeach
                </tbody>
                </table>
                {!! $roles->render() !!}
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
