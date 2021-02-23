@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Data Potongan Gaji</h1>    

@stop

@section('content')
    @can('role-create')        
        <a href="<?= route('potongan.create') ?>" class="btn btn-app float-right">
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
                    <th>Jenis Potongan</th>
                    <th>Besar Potongan</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach ($potongan as $row)
                        <tr>
                        <td class="align-middle">{{ ++$i }}</td>
                        <td class="align-middle">{{ $row->name }}</td>
                        <td class="align-middle text-right">{{ number_format($row->besar_potongan,0,",",".") }}</td>
                        <td>
                            <a class="btn btn-primary m-2" href="{{ route('potongan.show',$row->id) }}"><i class="fa fa-info"></i></a>
                            @can('potongan-edit')
                                <a class="btn btn-warning text-white" href="{{ route('potongan.edit',$row->id) }}"><i class="fa fa-edit"></i></a>
                            @endcan
                            @can('potongan-delete')
                                {!! Form::open(['method' => 'DELETE','route' => ['potongan.destroy', $row->id],'style'=>'display:inline']) !!}
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
