@extends('layouts.main')

@section('title', 'Обзор лота: ' . $lot->title)

@section('content')
    <div class="card offset-5 mt-5 mb-3" style="width: 18rem;">
        <div class="card-body">
            <h5 class="card-title">Лот: {{ $lot->title }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">Создан: {{ $lot->created_at->toDateString() }}</h6>
            <p>Категории:<br>
                @foreach($lot->categories as $category)
                    <strong>
                        <a href="{{ route('categories.show', $category->id) }}">{{ $category->title }}</a>
                    </strong><br>
                @endforeach
            </p>
            <a href="{{ url()->previous() }}">
                <button class="btn btn-warning mt-2">назад</button>
            </a>
        </div>
    </div>
@endsection
