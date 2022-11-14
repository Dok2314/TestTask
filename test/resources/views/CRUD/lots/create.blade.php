@extends('layouts.main')

@section('title', 'Создание лота')

@section('content')
    <form method="post" action="{{ route('lots.store') }}" class="form-control mt-5">
        @method('POST')
        @csrf
        <div class="form-group mb-3">
            <label for="title">Название Лота</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
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
                        <option value="{{$category->id}}">{{$category->title}}</option>
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
            <textarea name="description" id="editor" class="form-control">{{ old('description') }}</textarea>
        </div>
        @error('description')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        <button class="btn btn-success" type="submit">Создать</button>
    </form>
@endsection
