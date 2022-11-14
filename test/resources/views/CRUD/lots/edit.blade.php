@extends('layouts.main')

@section('title', 'Редактирование лота')

@section('content')
    <div class="mt-3">
        <a href="{{ url()->previous() }}">
            <button class="btn btn-warning">назад</button>
        </a>
    </div>
    <form method="post" action="{{ route('lots.update', $lot->id) }}" class="form-control mt-5">
        @method('PATCH')
        @csrf
        <div class="form-group mb-3">
            <label for="title">Название Лота</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $lot->title }}">
        </div>
        @error('title')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="form-group mb-3">
            <div class="mb-2">
                Категории Лота:
            </div>
            @if($categories->isNotEmpty())
                <select name="categories[]" id="categories" multiple>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $lot->categories->contains($category) ? 'selected' : '' }}
                        >
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
            @else
                <div class="alert alert-info">
                    <a href="{{ route('categories.create') }}">Создайте категорию</a>
                </div>
            @endif
        </div>
        @error('categories')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <div class="form-group mb-3">
            <label for="editor">Описание Лота</label>
            <textarea name="description" id="editor" class="form-control">{{ $lot->description }}</textarea>
        </div>
        @error('description')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <button class="btn btn-warning" type="submit">Сохранить</button>
    </form>
@endsection
