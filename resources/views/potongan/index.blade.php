@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Data Potongan Gaji</h1>    

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

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
            <div class="card-header">
                <h3 class="card-title">Responsive Hover Table</h3>

                <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                    </button>
                    </div>
                </div>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                <thead>
                    <tr>
                    <th>No</th>
                    <th>Jenis Potongan</th>
                    <th>Besar Potongan</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($potongan as $row)
                        <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->besar_potongan}}</td>                        
                        <td>
                            <a class="btn btn-info" href="{{ route('potongan.show',$row->id) }}">Show</a>
                            @can('potongan-edit')
                                <a class="btn btn-primary" href="{{ route('potongan.edit',$row->id) }}">Edit</a>
                            @endcan
                            @can('potongan-delete')
                                {!! Form::open(['method' => 'DELETE','route' => ['potongan.destroy', $row->id],'style'=>'display:inline']) !!}
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
