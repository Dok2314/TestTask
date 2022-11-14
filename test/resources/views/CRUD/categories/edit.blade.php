@extends('layouts.main')

@section('title', 'Редактирование категории')

@section('content')
    <div class="mt-3">
        <a href="{{ url()->previous() }}">
            <button class="btn btn-warning">назад</button>
        </a>
    </div>
    <form method="post" action="{{ route('categories.update', $category->id) }}" class="form-control mt-5">
        @method('PATCH')
        @csrf
        <div class="form-group mb-3">
            <label for="title">Название Категории</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ $category->title }}">
        </div>
        @error('title')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        @error('slug')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        <button class="btn btn-warning" type="submit">Сохранить</button>
    </form>
@endsection
