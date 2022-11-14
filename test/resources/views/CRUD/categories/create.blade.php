@extends('layouts.main')

@section('title', 'Создание категории')

@section('content')
    <form method="post" action="{{ route('categories.store') }}" class="form-control mt-5">
        @method('POST')
        @csrf
        <div class="form-group mb-3">
            <label for="title">Название Категории</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}">
        </div>
        @error('title')
        <div class="text-danger">{{ $message }}</div>
        @enderror
        @error('slug')
            <div class="text-danger">{{ $message }}</div>
        @enderror
        <button class="btn btn-success" type="submit">Создать</button>
    </form>
@endsection
