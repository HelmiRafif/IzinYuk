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
    <a href="<?= route('tunjangan.create') ?>" class="btn btn-app float-right">
        <i class="fas fa-edit"></i> Tambah
    </a>
    <div class="row">
        <div class="col-12">
            <div class="card">                            
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Besar Nominal Tunjangan</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($tunjangans as $row)
                        <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->besar_tunjangan}}</td>
                        <td>
                            @can('permission-edit')
                                <a class="btn btn-primary" href="{{ route('tunjangan.edit',$row->id) }}">Edit</a>
                            @endcan
                            @can('permission-delete')
                                {!! Form::open(['method' => 'DELETE','route' => ['tunjangan.destroy', $row->id],'style'=>'display:inline']) !!}
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
