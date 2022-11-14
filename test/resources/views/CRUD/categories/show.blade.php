@extends('layouts.main')

@section('title', 'Обзор категории')

@section('content')
    <div class="card offset-5 mt-5 mb-3" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Категория: {{ $category->title }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">Создана: {{ $category->created_at->toDateString() }}</h6>
            <a href="{{ url()->previous() }}">
                <button class="btn btn-warning mt-2">назад</button>
            </a>
        </div>
    </div>
@endsection
