@extends('layouts.dashboard')

@section('subtitle', 'Tráfico: Mensal')

@section('content')

    <div class="font-weight-bold py-3 h4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ url('staff') }}">@lang('dashboard.title')</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ url('staff/traffics') }}">Tráficos</a>
            </li>
            <li class="breadcrumb-item active">Mensal</li>
        </ol>
    </div>

    <hr class="container-m-nx border-light mt-0 mb-5">

    <div class="card">
        <div class="card-header">Tráfico: Mensal</div>
        <table class="table card-table">
            <thead class="thead-light">
                <tr>
                    <th>Mensal</th>
                    <th>Recebido</th>
                    <th>Enviado</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
            @foreach($monthly as $key => $value)
                <tr>
                    <td>{{ $value['label'] }}</td>
                    <td>{{ $value['rx'] }}</td>
                    <td>{{ $value['tx'] }}</td>
                    <td>{{ $value['total'] }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection
