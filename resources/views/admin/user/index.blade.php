@extends('adminlte::page')

@section('title', 'Data User')

@section('content_header')
    <h1>Data User</h1>
    @if(session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
@stop

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
            <div class="col-12">
                <div class="card">
                <div class="card-header">
                    <h3 class="card-title">DataTable with minimal features & hover style</h3>
                    <a  href="<?= route('users.create') ?>" class="btn btn-app float-right">
                        <i class="fas fa-edit"></i> Tambah
                    </a>                    
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $row)                                     
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->email}}</td>
                        <td>
                            @if(!empty($data->getRoleNames()))
                                @foreach($data->getRoleNames() as $v)
                                <label class="badge badge-success">{{ $v }}</label>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            <a href="<?= route('edit',$row->id) ?>" class="btn btn-app"><i class="fas fa-file"></i> Edit</a>

                            {!! Form::open(['route' => ['delete',$row->id], 'method' => 'delete'])!!}
                                <button type="submit" class="btn btn-app"><i class="fas fa-trash"></i> Hapus</a>
                            {!! Form::close() !!}
                        </td>
                    </tr>  
                    @endforeach                  
                    </tbody>    
                    </table>
                    {!! $data->render() !!}
                </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@stop
                
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
