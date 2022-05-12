@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-4">
            <div class="col-md-6">

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="fw-bold fs-3">
                            {{ $post->title }}
                        </div>
                    </div>

                    @isset($post->image)
                        <img class="card-img-top" src="{{ $post->image }}" alt="{{ $post->title }}" />
                    @endisset

                    <div class="card-body">

                        <div class="row mb-4">
                            <div class="col-12">
                                Author : <span class="fst-italic">{{ $post->user->name }}</span>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-12">
                                {{ $post->content }}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12 d-flex justify-content-between">
                                <span class="badge bg-info badge-pill">Created at : {{ $post->created_at }}</span>
                                <span class="badge bg-info badge-pill">Updated at : {{ $post->updated_at }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-between">
                        <form action="{{ route('posts.destroy', ['post' => $post]) }}"
                            method="POST">
                            @method('Delete')
                            @csrf

                            <button class="btn btn-danger btn-sm">
                                Delete
                            </button>
                        </form>
                        <a class="btn btn-warning btn-sm" href="{{ route('posts.edit', ['post' => $post]) }}">
                            Edit
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
