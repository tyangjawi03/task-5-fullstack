@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-4">
            <div class="col-md-6 d-flex justify-content-end gap-4">
                @can('create', App\Models\Post::class)
                    <a href="{{ route('posts.create') }}" class="btn btn-primary">Add Post</a>
                @endcan
                <a href="{{ route('categories.index') }}" class="btn btn-outline-primary">Categories</a>
            </div>
        </div>

        @foreach ($posts as $key => $post)
            <div class="row justify-content-center mb-4">
                <div class="col-md-6">

                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="fw-bold">
                                {{ $post->title }}
                            </div>
                        </div>

                        <div class="card-body">
                            {{ \Illuminate\Support\Str::limit($post->content, 64, '...') }}
                        </div>

                        <div class="card-footer">
                            <a class="btn btn-link btn-sm float-end" href="{{ route('posts.show', ['post' => $post]) }}">
                                Read More
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        @endforeach

        <div class="row justify-content-center">
            <div class="col-md-6">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
@endsection
