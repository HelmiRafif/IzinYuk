@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>List Data Pegawai</h1>    

@stop

@section('content')
    @can('pegawai-create')        
        <a href="<?= route('pegawai.create') ?>" class="btn btn-app float-right">
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
                    <th>#</th>
                    <th>Nama Pegawai</th>
                    <th>Email</th>
                    <th>Alamat</th>
                    <th>Tanggal Masuk</th>
                    <th>Rekening</th>
                    <th>Tipe Pegawai</th>
                    <th>Bank</th>
                    <th>Jabatan</th>
                    <th>Bonus Loyalitas</th>
                    <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-center align-middle">
                    @foreach ($pegawai as $row)
                        <tr>
                        <td class="align-middle">{{ ++$i }}</td>
                        <td class="align-middle">{{ $row->nama }}</td>
                        <td class="align-middle">{{ $row->email}}</td>
                        <td class="align-middle">{{ $row->alamat}}</td>
                        <td class="align-middle">
                            @if (!empty($row->tanggal_masuk))
                            {{ $pegawai->tanggal_masuk }}
                                @else
                                -
                            @endif
                        </td>
                        <td class="align-middle">{{ $row->rekening}}</td>
                        <td class="align-middle">{{ $row->type_pegawai}}</td>
                        <td class="align-middle">{{ $row->bank}}</td>
                        <td class="align-middle">
                            @if (!empty($row->jabatanName($row->jabatan_id)))
                                {{ $row->jabatanName($row->jabatan_id) }}
                                @else
                                -
                            @endif
                        </td>
                        <td class="align-middle">
                            @if($row->jabatanBonus($row->jabatan_id) == 0) 
                                -
                                @elseif(!empty($row->jabatanBonus($row->jabatan_id)))
                                {{ $row->jabatanBonus($row->jabatan_id)}}
                            @endif
                        </td>
                        {{-- <td>{{ $row->jabatanBonus($row->bonus_loyalitas) }}</td> --}}
                        <td class="align-middle">
                            <a class="btn btn-primary m-2" href="{{ route('pegawai.show',$row->id) }}"><i class="fa fa-info"></i></a>
                            @can('pegawai-edit')
                                <a class="btn btn-warning text-white" href="{{ route('pegawai.edit',$row->id) }}"><i class="fa fa-edit"></i></a>
                            @endcan
                            @can('pegawai-delete')
                                {!! Form::open(['method' => 'DELETE','route' => ['pegawai.destroy', $row->id],'style'=>'display:inline']) !!}
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
