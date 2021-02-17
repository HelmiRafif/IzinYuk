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
        <a  href="<?= route('users.create') ?>" class="btn btn-app float-right">
            <i class="fas fa-edit"></i> Tambah
        </a>
            <div class="row">
            <div class="col-12">
                <div class="card">                 
                    
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                    <thead class="text-center">
                    <tr>
                        <th>ID</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    @foreach($data as $row)                                     
                    <tr>
                        <td>{{ $row->id }}</td>
                        <td>{{ $row->name }}</td>
                        <td>{{ $row->email}}</td>
                        <td>
                            @if(!empty($row->getRoleNames()))
                                @foreach($row->getRoleNames() as $v)
                                <label class="badge badge-success">{{ $v }}</label>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @can('user-edit')
                                <a class="btn btn-primary" href="{{ route('users.edit',$row->id) }}">Edit</a>
                            @endcan
                            @can('user-delete')
                                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $row->id],'style'=>'display:inline']) !!}
                                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            @endcan
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
        </table>
    </div> 
@stop
                
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
