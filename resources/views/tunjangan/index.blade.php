@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>        
@stop

@section('content')
    <a href="<?= route('tunjangan.create') ?>" class="btn btn-app float-right">
        <i class="fas fa-edit"></i> Tambah
    </a>
    <div class="row">
        <div class="col-12">
            <div class="card">                            
                <div class="card-body table-responsive">
                    <table class="table table-hover text-nowrap" id="table">
                    <thead class="text-center">
                        <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Besar Nominal Tunjangan</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                    @foreach($tunjangans as $row)
                        <tr>
                        <td class="align-middle">{{ $row->id }}</td>
                        <td class="align-middle">{{ $row->name }}</td>
                        <td class="align-middle">{{ $row->besar_tunjangan}}</td>
                        <td>
                            @can('permission-edit')
                                <a class="btn btn-primary text-white" href="{{ route('tunjangan.edit',$row->id) }}"><i class="fa fa-edit"></i></a>
                            @endcan
                            @can('permission-delete')
                                {!! Form::open(['method' => 'DELETE','route' => ['tunjangan.destroy', $row->id],'style'=>'display:inline']) !!}
                                    <button type="submit" class="btn btn-sm-2 btn-danger m-2" title="Hapus">
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
