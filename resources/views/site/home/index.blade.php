@extends('layouts.dashboard')

@section('title', 'Home')

@section('css')
    <link href="{{ asset('vendor/vegas/vegas.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card vegas-fixed-background" id="home-cover">
                    <div class="card-body py-home">
                        <h1 class="text-center text-info">Okaeri {{ auth()->user()->username }}-chan</h1>
                    </div>
                </div>
            </div>
        </div>

        <!-- News -->
        @include('site.home.block_news')
        <!-- End News -->

        <!-- Last Topics -->
        @include('site.home.block_last_topics')
        <!-- End Last Topics -->

        <!-- Last Post -->
        @include('site.home.block_last_posts')
        <!-- End Last Post -->

        <!-- Last Poll -->
        @include('site.home.block_last_polls')
        <!-- End Last Poll -->

        <!-- Last Users Online -->
        @include('site.home.block_last_users_online')
        <!-- End Last Users Online -->

    </div>

@endsection

@section('scripts')
    <!-- VegasJS -->
    <script src="{{ asset('vendor/vegas/vegas.js') }}"></script>

    <script nonce="{{ Bepsvpt\SecureHeaders\SecureHeaders::nonce() }}">
        $(function() {
            // Fixed bg
            $('#home-cover').vegas({
                delay: 25000,
                shuffle: true,
                timer: true,
                slides: [
                    @foreach($covers as $cover)
                        { src: "{{ asset("storage/homecovers/{$cover}") }}" },
                    @endforeach
                ],
                //overlay: '{{ asset('vendor/vegas/overlays/07.png') }}',
                transition: ['fade', 'zoomOut', 'zoomIn', 'blur'],
                animation: ['kenburnsUp', 'kenburnsDown', 'kenburnsLeft', 'kenburnsRight']
            });
        });
    </script>

@endsection
