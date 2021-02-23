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
                        <th>Status</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($izin as $i=>$row)
                            <tr>
                            <td class="align-middle">{{ ++$i }}</td>
                            <td class="align-middle">{{ $row->user_id }}</td>
                            <td class="align-middle">{{ $row->type_izin }}</td>
                            <td class="align-middle">{{ $row->tanggal_mulai }}</td>
                            <td class="align-middle">{{ $row->tanggal_selesai }}</td>
                            <td class="align-middle"> 
                                @if($row->status_diterima == 'Menunggu konfirmasi')
                                    <label class="badge badge-warning">Menunggu konfirmasi</label>
                                    @else
                                            <label class="badge badge-success">{{ $row->status_diterima }}</label>
                                @endif
                            </td>
                            <td class="text-center" style="text-align: center">
                                    <div class="row text-center align-middle">
                                        <a class="btn btn-sm-2 btn-primary m-2" title="Detail" href="{{ route('izin.show',$row->id) }}"><i class="fa fa-info"></i></a>
                                        @can('izin-edit')
                                            <a class="btn btn-sm-2 btn-warning m-2 text-white" title="Edit" href="{{ route('izin.edit',$row->id) }}"><i class="fa fa-edit"></i></a>
                                        @endcan
                                    </div>
                                </td>
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
