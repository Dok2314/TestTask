@extends('layouts.main')

@section('title', 'Список категорий')

@section('content')
    <div class="mt-4 mb-4">
        <a href="{{ route('categories.create') }}">
            <button class="btn btn-primary">Создать категорию</button>
        </a>
    </div>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Created AT</th>
            <th scope="col">Lots</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <th scope="row">{{ $category->id }}</th>
                <td>{{ $category->title }}</td>
                <td>{{ $category->created_at->toDateString() }}</td>
                <td>
                    @foreach($category->lots as $lot)
                        <strong>
                            <a href="{{ route('lots.show', $lot->id) }}">
                                {{ $lot->title }}
                            </a>
                        </strong><br>
                    @endforeach
                </td>
                <td>
                    @if($category->deleted_at)
                        <form method="post" action="{{ route('categories.restore', $category->id) }}">
                            @csrf
                            @method('PUT')
                            <button type="submit" style="background: none; color: red; border: none;">
                                <i class="fa-solid fa-trash-can-arrow-up" style="color: orange;"></i>
                            </button>
                        </form>
                    @else
                        <form method="post" action="{{ route('categories.destroy', $category->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; color: red; border: none;">
                                <i class="fa-sharp fa-solid fa-delete-left"></i>
                            </button>
                        </form>
                        <a href="{{ route('categories.edit', $category->id) }}">
                            <i class="fa-solid fa-pen-to-square" style="color: blue; margin-left: 10px;"></i>
                        </a>
                        <br>
                        <a href="{{ route('categories.show', $category->id) }}" style="margin-left: 8px">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="mb-5">
        {{ $categories->withQueryString()->links('vendor.pagination.bootstrap-4') }}
    </div>
@endsection
