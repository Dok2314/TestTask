@extends('layouts.main')

@section('title', 'Список лотов')

@section('content')
    <div class="container mt-4 mb-4">
        <div class="row">
            <div class="col-md-8">
                @include('CRUD.lots.filter')
            </div>
            <div class="col-md-4">
                <a href="{{ route('lots.create') }}">
                    <button class="btn btn-primary">Создать</button>
                </a>
            </div>
        </div>
    </div>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Created AT</th>
            <th scope="col">Categories</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($lots as $lot)
            <tr>
                <th scope="row">{{ $lot->id }}</th>
                <td>{{ $lot->title }}</td>
                <td>{{ $lot->created_at->toDateString() }}</td>
                <td>
                    @foreach($lot->categories as $category)
                        <strong>
                            <a href="{{ route('categories.show', $category->id) }}">
                                {{ $category->title }}
                            </a>
                        </strong><br>
                    @endforeach
                </td>
                <td>
                    @if($lot->deleted_at)
                        <form method="post" action="{{ route('lots.restore', $lot->id) }}">
                            @csrf
                            @method('PUT')
                            <button type="submit" style="background: none; color: red; border: none;">
                                <i class="fa-solid fa-trash-can-arrow-up" style="color: orange;"></i>
                            </button>
                        </form>
                    @else
                        <form method="post" action="{{ route('lots.destroy', $lot->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="background: none; color: red; border: none;">
                                <i class="fa-sharp fa-solid fa-delete-left"></i>
                            </button>
                        </form>
                        <a href="{{ route('lots.edit', $lot->id) }}">
                            <i class="fa-solid fa-pen-to-square" style="color: blue; margin-left: 10px;"></i>
                        </a>
                        <br>
                        <a href="{{ route('lots.show', $lot->id) }}" style="margin-left: 8px">
                            <i class="fa-solid fa-eye"></i>
                        </a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="mb-5">
        {{ $lots->withQueryString()->links('vendor.pagination.bootstrap-4') }}
    </div>
@endsection
