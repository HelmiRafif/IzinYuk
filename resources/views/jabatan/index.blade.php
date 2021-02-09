@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>    

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

@stop

@section('content')
    @can('role-create')        
        <a href="<?= route('jabatan.create') ?>" class="btn btn-app float-right">
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
                    <th>ID</th>
                    <th>Name</th>
                    <th>Gaji Pokok</th>
                    <th>Bonus Profesional</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jabatan as $row)
                        <tr>
                        <td>{{ ++$i }}</td>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->gaji_pokok}}</td>
                        <td>{{ $row->bonus_profesional}}</td>
                        <td>
                            <a class="btn btn-info" href="{{ route('jabatan.show',$row->id) }}">Show</a>
                            @can('jabatan-edit')
                                <a class="btn btn-primary" href="{{ route('jabatan.edit',$row->id) }}">Edit</a>
                            @endcan
                            @can('jabatan-delete')
                                {!! Form::open(['method' => 'DELETE','route' => ['jabatan.destroy', $row->id],'style'=>'display:inline']) !!}
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
