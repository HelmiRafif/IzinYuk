@extends('adminlte::page')

@section('title', 'Data User')

@section('content_header')
    <h1>Data User</h1>
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
                <div class="card-body table-responsive">
                    <table class="table table-hover text-nowrap" id="table">
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
                        <td class="align-middle">{{ $row->id }}</td>
                        <td class="align-middle">{{ $row->name }}</td>
                        <td class="align-middle">{{ $row->email}}</td>
                        <td class="align-middle">
                            @if(!empty($row->getRoleNames()))
                                @foreach($row->getRoleNames() as $v)
                                <label class="badge badge-success">{{ $v }}</label>
                                @endforeach
                            @endif
                        </td>
                        <td>
                            @can('user-edit')
                                <a class="btn btn-warning text-white" href="{{ route('users.edit',$row->id) }}"><i class="fa fa-edit"></i></a>
                            @endcan
                            @can('user-delete')
                                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $row->id],'style'=>'display:inline']) !!}
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
    <script>
        $(function(){
            $('#table').DataTable();
        })
    </script>
@stop
