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
    @can('jabatan-create')        
        <a href="<?= route('jabatan.create') ?>" class="btn btn-app float-right">
            <i class="fas fa-edit"></i> Tambah
        </a>
    @endcan
    <div class="row">
        <div class="col-12">
            <div class="card ">
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                    <thead class="text-center">
                        <tr>
                        <th>No</th>
                        <th>Nama Jabatan</th>
                        <th>Gaji Pokok</th>
                        <th>Bonus Profesional</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($jabatan as $row)
                            <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $row->name }}</td>
                            <td>{{ $row->gaji_pokok}}</td>
                            <td>{{ $row->bonus_profesional}}</td>
                            <td>
                                <a class="btn btn-primary" href="{{ route('jabatan.show',$row->id) }}"><i class="fa fa-info"></i></</a>
                                @can('jabatan-edit')
                                    <a class="btn btn-warning" href="{{ route('jabatan.edit',$row->id) }}"><i class="fa fa-edit"></i></</a>
                                @endcan
                                @can('jabatan-delete')
                                    {!! Form::open(['method' => 'DELETE','route' => ['jabatan.destroy', $row->id],'style'=>'display:inline']) !!}
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
    <script> console.log('Hi!'); </script>
@stop
