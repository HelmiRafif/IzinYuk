@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Detail Izin</h1>

@stop

@section('content')

    {{-- <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Name :</strong>
                {{ $role->name }}
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Permissions: </strong>
                @if(!empty($rolePermissions))
                <ul>
                    @foreach($rolePermissions as $v)                        
                            <li>{{ $v->name }}</li>
                    @endforeach
                </ul>
                @endif                
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right pb-5">
                <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
            </div>
        </div>
    </div> --}}

        <table class="table table-hover text-nowrap">
                    <thead class="text-center">
                        <tr>
                        <th>#</th>
                        <th>ID User</th>
                        <th>Tipe Izin</th>
                        <th>Tanggal Mulai</th>
                        <th>Tanggal Selesai</th>
                        <th style="width: 40%">Status</th>
                        {{-- <th>Action</th> --}}
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($izin as $i=>$row)
                            <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $row->user_id }}</td>
                            <td>{{ $row->type_izin }}</td>
                            <td>{{ $row->tanggal_mulai }}</td>
                            <td>{{ $row->tanggal_selesai }}</td>
                            <td> 
                                @if($row->status_diterima == 'Menunggu konfirmasi')
                                    <label class="badge badge-warning">Menunggu konfirmasi</label>
                                    @else
                                            <label class="badge badge-success">{{ $row->status_diterima }}</label>
                                @endif
                            </td>
                            {{-- <td>
                                <a class="btn btn-sm btn-secondary" href="{{ route('izin.show',$row->id) }}">Show</a>
                                @can('izin-edit')
                                    <a class="btn btn-sm btn-primary" href="{{ route('izin.edit',$row->id) }}">Edit</a>
                                @endcan
                                @can('izin-delete')
                                    {!! Form::open(['method' => 'DELETE','route' => ['izin.destroy', $row->id],'style'=>'display:inline']) !!}
                                        {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger']) !!}
                                    {!! Form::close() !!}
                                @endcan
                                @can('izin-admit')
                                    @if(!empty($row->status_diterima))
                                        @else
                                            {!! Form::open(['method' => 'PATCH' ,'route' => ['izin.admit',$row->id]]) !!}
                                                <button class="btn btn-sm btn-success" type="submit" name="status_diterima" value="Diterima">
                                                Setujui
                                                </button>
                                            {!! Form::close() !!}
                                    @endif
                                @endcan
                            </td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                    </table>


@stop
                
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
