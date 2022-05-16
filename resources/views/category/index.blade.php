@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <div class="fw-bold">
                            {{ __('Categories') }}
                        </div>

                        @can('create', App\Models\Category::class)
                            <a href="{{ route('categories.create') }}" class="btn btn-primary btn-sm">Add Category</a>
                        @endcan
                    </div>

                    <div class="card-body">

                        <ul class="list-group">
                            @foreach ($categories as $key => $category)
                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="fw-bold">
                                        {{ $categories->firstItem() + $key }}.
                                    </div>
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">
                                            {{ $category->name }}
                                        </div>
                                        {{ $category->updated_at }}
                                    </div>

                                    <div class="float-end d-flex w-30 gap-3">
                                        @can('update', $category)
                                            <a href="{{ route('categories.edit', ['category' => $category]) }}"
                                                class="btn btn-warning btn-sm">
                                                Edit
                                            </a>
                                        @endcan
                                        @can('delete', $category)
                                            <form action="{{ route('categories.destroy', ['category' => $category]) }}"
                                                method="POST">
                                                @method('Delete')
                                                @csrf

                                                <button class="btn btn-danger btn-sm">
                                                    Delete
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </li>
                            @endforeach
                        </ul>


                    </div>

                    <div class="card-footer">
                        {{ $categories->links() }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
