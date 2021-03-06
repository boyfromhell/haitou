@extends('layouts.dashboard')

@section('title', trans('dashboard.settings'))

@section('css')
    <!-- sceditor -->
    <link href="{{ asset('vendor/sceditor/minified/themes/default.min.css') }}" rel="stylesheet">
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
                            <li class="breadcrumb-item active" aria-current="page">@lang('dashboard.settings')</li>
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
                        <h4 class="card-title">@lang('dashboard.settings')</h4>
                        <h6 class="card-subtitle">Use default tab with class <code>nav-tabs &amp; tabcontent-border </code></h6>
                        @includeIf('errors.errors', [$errors])
                        @include('includes.messages')
                        <div class="row">
                            @include('staff.settings.nav')
                            <div class="col-lg-8 col-xl-9">
                                {!! Form::open(['url' => 'staff/settings/policy', 'class' => 'form-horizontal']) !!}
                                <div class="form-group">
                                    {!! Form::label('terms', 'Termos:') !!}
                                    {!! Form::textarea('terms', setting('terms'), ['class' => 'form-control editor', 'rows' => 8]) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('privacy', 'Privacidade:') !!}
                                    {!! Form::textarea('privacy', setting('privacy'), ['class' => 'form-control editor', 'rows' => 8]) !!}
                                </div>
                                <div class="form-group">
                                    {!! Form::label('disclaimer', 'Aviso Legal:') !!}
                                    {!! Form::textarea('disclaimer', setting('disclaimer'), ['class' => 'form-control editor', 'rows' => 8]) !!}
                                </div>
                                {!! Form::submit('Atualizar', ['class' => 'btn btn-success btn-rounded']) !!}
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <!-- sceditor -->
    <script src="{{ asset('vendor/sceditor/minified/sceditor.min.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/minified/formats/xhtml.js') }}"></script>
    <script src="{{ asset('vendor/sceditor/languages/pt-BR.js') }}"></script>

    <!-- Page JS Code -->
    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(document).ready(function () {
            //terms
            let terms = document.getElementById('terms');
            sceditor.create(terms, {
                format: 'xhtml',
                locale: 'pt-BR',
                emoticonsRoot: '/vendor/sceditor/',
                style: '/vendor/sceditor/minified/themes/content/default.min.css'
            });
            //privacy
            let privacy = document.getElementById('privacy');
            sceditor.create(privacy, {
                format: 'xhtml',
                locale: 'pt-BR',
                emoticonsRoot: '/vendor/sceditor/',
                style: '/vendor/sceditor/minified/themes/content/default.min.css'
            });
            //disclaimer
            let disclaimer = document.getElementById('disclaimer');
            sceditor.create(disclaimer, {
                format: 'xhtml',
                locale: 'pt-BR',
                emoticonsRoot: '/vendor/sceditor/',
                style: '/vendor/sceditor/minified/themes/content/default.min.css'
            });
        });
    </script>
@endsection
