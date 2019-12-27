@extends('layouts.dashboard')

@section('title', trans('dashboard.fansubs'))

@section('css')
    <!-- DataTables -->
    <link href="{{ asset('vendor/datatables/DataTables-1.10.20/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Staff Painel</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('staff') }}">@lang('dashboard.title')</a></li>
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.fansubs')</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">@lang('dashboard.fansubs')</h4>
                        <a href="{{ url('staff/fansubs/create') }}">
                            <button type="button" class="btn btn-xs btn-primary">
                                <span class="ion ion-md-add"></span> Adicionar
                            </button>
                        </a>
                        <div class="table-responsive m-t-15">
                            <table class="table" id="datatable">
                                <thead>
                                <tr>
                                    <th><i class="fas fa-user"></i></th>
                                    <th>Nome</th>
                                    <th><i class="fas fa-file-alt text-warning"></i> Torrents</th>
                                    <th><i class="fas fa-eye"></i> Views</th>
                                    <th>Opções</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($fansubs as $fansub)
                                    <tr>
                                        <th><img src="{{ $fansub->logo }}" alt="{{ $fansub->name }}" width="70px"></th>
                                        <td>{{ $fansub->name }}</td>
                                        <td>{{ $fansub->torrents->count() }}</td>
                                        <td><span class="badge badge-info">{{ $fansub->views }}</span></td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ url('staff/fansub/' . $fansub->id . '/members') }}" data-toggle="tooltip" title="Fansub Membros"><i class="fas fa-users text-success"></i></a>
                                                <a class="m-l-15" href="{{ url('staff/fansubs/' . $fansub->id . '/edit') }}" data-toggle="tooltip" title="Editar Fansub"><i class="fas fa-pencil-alt text-info"></i></a>
                                                <a class="m-l-15" href="javascript:;" onclick="document.getElementById('fansub-del-{{ $fansub->id }}').submit();" data-toggle="tooltip" title="Remover Fansub"><i class="fas fa-times text-danger"></i></a>
                                                {!! Form::open(['url' => 'staff/fansubs/' . $fansub->id, 'method' => 'DELETE', 'id' => 'fansub-del-' . $fansub->id , 'style' => 'display: none']) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="{{ asset('vendor/datatables/datatables.min.js') }}"></script>
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
            $('#datatable').DataTable({
                "displayLength": 50,
                "searching": true,
                "responsive": true,
                "order": [[ 1, "asc" ]],
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
                }
            });
        });
    </script>
@endsection
