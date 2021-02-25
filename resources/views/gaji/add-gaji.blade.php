@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Generator Gaji</h1>    

@stop

@section('content')
    <div class="row mx-auto px-2">
        <div class="col-md-6">
        {!! Form::open(array('route' => 'gaji.store','method'=>'POST')) !!}
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-money-bill"></i> Generate</button>
            {{ Form::date('period', \Carbon\Carbon::now()) }}
        {!! Form::close() !!}
        </div>
    </div>

        <div class="row">
        <div class="col-12">
            <div class="card ">
                <div class="card-body table-responsive">
                    <table class="table table-hover text-nowrap" id="table">
                    <thead class="text-center">
                        <tr>
                        <th>#</th>
                        <th>Nama Pegawai</th>
                        <th>Gaji Pokok</th>
                        <th>Total Tunjangan</th>
                        <th>Bonus Loyalitas</th>
                        <th>Total Gaji</th>
                        <th>Periode</th>
                        @can('gaji-list')
                            <th>Action</th>
                        @endcan
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @foreach ($gaji as $row)
                            <tr>
                            <td class="align-middle">{{ $row->id }}</td>
                            <td class="align-middle">{{ $row->nama }}</td>
                            <td class="align-middle text-right">{{ number_format($row->gaji_pokok,0,",",".") }}</td>
                            <td class="align-middle text-right">{{ number_format($row->total_tunjangan,0,",",".") }}</td>
                            <td class="align-middle text-right">{{ number_format($row->bonus_profesional,0,",",".") }}</td>
                            <td class="align-middle text-right">{{ number_format($row->total_gaji,0,",",".") }}</td>
                            <td class="align-middle">{{ $row->period }}</td>
                            @can('gaji-list')
                                <td>
                                    <a class="btn btn-primary m-2" href="{{ route('gaji.show',$row->id) }}"><i class="fa fa-info"></i></a>
                                </td>
                            @endcan
                            {{-- <td class="align-middle text-right">
                                @if($row->bonus_profesional == 0)
                                    Tidak ada
                                    @else
                                    {{ number_format($row->bonus_profesional,0,",",".") }}</td>
                                @endif
                            <td>
                                <a class="btn btn-primary m-2" href="{{ route('jabatan.show',$row->id) }}"><i class="fa fa-info"></i></a>
                                @can('jabatan-edit')
                                    <a class="btn btn-warning text-white" href="{{ route('jabatan.edit',$row->id) }}"><i class="fa fa-edit"></i></a>
                                @endcan
                                @can('jabatan-delete')
                                    {!! Form::open(['method' => 'DELETE','route' => ['jabatan.destroy', $row->id],'style'=>'display:inline']) !!}
                                        <button type="submit" class="btn btn-sm-2 btn-secondary m-2" title="Hapus">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    {!! Form::close() !!}
                                @endcan --}}
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
