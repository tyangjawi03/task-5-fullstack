@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card">
                    <div class="card-header">{{ __('Edit Post') }}</div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('posts.update', ['post' => $post]) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row mb-3">
                                <label for="title" class="col-md-3 col-form-label text-md-end">{{ __('Post Title') }}</label>

                                <div class="col-md-9">
                                    <input id="title" type="title" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $post->title }}" required autocomplete="title" autofocus>

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="category" class="col-md-3 col-form-label text-md-end">{{ __('Select Category') }}</label>

                                <div class="col-md-9">
                                    <select name="category" id="category" type="category" class="form-select @error('category') is-invalid @enderror" aria-label="Default select example" required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}" {{ ($post->category_id === $category->id ? 'selected' : '')}}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="content" class="col-md-3 col-form-label text-md-end">{{ __('Post Content') }}</label>

                                <div class="col-md-9">
                                    <textarea
                                        id="content"
                                        type="content"
                                        class="form-control @error('content') is-invalid @enderror"
                                        name="content"
                                        rows="8"
                                        required>{{ old('content') ?? $post->content }}</textarea>


                                    @error('content')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="image" class="col-md-3 col-form-label text-md-end">{{ __('Post Image') }}</label>

                                <div class="col-md-9">
                                    <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}">

                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-9 offset-md-3">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
