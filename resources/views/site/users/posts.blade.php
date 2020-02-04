@extends('layouts.dashboard')

@section('title', 'Meus Posts')

@section('content')

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Home</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ url('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="{{ url('torrents') }}">Torrents</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Meus Posts</li>
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
                        <h4 class="card-title">Meus Posts</h4>
                        <div class="table-responsive m-t-15">
                            <table class="table" id="datatable">
                                <thead>
                                <tr>
                                    <th>Fórum</th>
                                    <th>Tópico</th>
                                    <th>Autor</th>
                                    <th>Stats</th>
                                    <th>Última Mensagem</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $post)
                                    @if ($post->topic->viewable())
                                    <tr>
                                        <th>
                                            <span class="badge badge-extra text-bold">{{ $topic->forum->name }}</span>
                                        </th>
                                        <td>
                                            <a href="{{ route('forum.topic', ['id' => $post->id, 'slug' => $post->slug]) }}">{{ $post->name }}</a>
                                            @if ($post->is_locked)
                                                <span class="badge badge-dark">Fechado</span>
                                            @endif
                                            @if ($post->is_pinned)
                                                <span class="badge badge-success">Pinned</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('user.profile', ['slug' => Str::slug($post->first_post_username)]) }}">
                                                {{ $post->first_post_username }}
                                            </a>
                                        </td>
                                        <td>
                                            {{ $post->posts->count() - 1 }} Respostas / {{ $post->views }} Views
                                        </td>
                                        <td>
                                            <a href="{{ route('user.profile', ['slug' => Str::slug($post->last_post_username)]) }}">
                                                {{ $post->last_post_username }}
                                            </a>,
                                            @if($post->updated_at && $post->updated_at != null)
                                                <time datetime="{{ format_date_time($post->updated_at) }}">
                                                    {{ format_date_time($post->updated_at) }}
                                                </time>
                                            @else
                                                <time datetime="N/A">N/A</time>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5" class="some-padding button-padding">
                                            <div class="topic-posts button-padding">
                                                <div class="post" id="post-{{ $post->id }}">
                                                    <div class="button-holder">
                                                        <div class="button-left">
                                                            <a href="{{ route('user.profile', ['slug' => $post->user->slug]) }}" style="color:{{ $post->user->group->color }}; display:inline;">
                                                                {{ $post->user->name }}
                                                            </a>
                                                            {{ format_date_time($post->created_at) }}
                                                        </div>
                                                        <div class="button-right">
                                                            <a class="font-weight-bold" href="{{ route('forum.topic', ['id' => $post->topic->id, 'slug' => $post->topic->slug]) }}?page={{$post->pageNumber()}}#post-{{$post->id}}">#{{$post->id}}</a>
                                                        </div>
                                                    </div>
                                                    <hr class="some-margin">
                                                    {!! $post->contentHtml() !!}
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endif
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