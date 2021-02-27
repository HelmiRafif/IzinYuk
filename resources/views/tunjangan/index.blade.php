@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>        
@stop

@section('content')
@can('tunjangan-create')
    <a href="<?= route('tunjangan.create') ?>" class="btn btn-app float-right">
        <i class="fas fa-edit"></i> Tambah
    </a>
@endcan
    <div class="row">
        <div class="col-12">
            <div class="card">                            
                <div class="card-body table-responsive">
                    <table class="table text-nowrap">
                    <thead class="text-center">
                        <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Besar Tunjangan</th>
                        @can('tunjangan-edit','tunjangan-delete')
                        <th>Action</th>
                        @endcan
                        </tr>
                    </thead>
                    <tbody class="text-center">
                    @foreach($tunjangans as $row)
                        <tr>
                        <td class="align-middle">{{ $row->id }}</td>
                        <td class="align-middle">{{ $row->name }}</td>
                        <td class="align-middle text-right">{{ number_format($row->besar_tunjangan,0,",",".") }}</td>
                        <td>
                            @can('tunjangan-edit')
                                <a class="btn btn-warning text-white" href="{{ route('tunjangan.edit',$row->id) }}"><i class="fa fa-edit"></i></a>
                            @endcan
                            @can('tunjangan-delete')
                                {!! Form::open(['method' => 'DELETE','route' => ['tunjangan.destroy', $row->id],'style'=>'display:inline']) !!}
                                    <button type="submit" class="btn btn-sm-2 btn-secondary m-2" title="Hapus">
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
