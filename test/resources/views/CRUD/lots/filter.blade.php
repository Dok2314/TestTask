<label for="cars">Отфильтровать по категории(ям):</label>
<form action="{{ route('lots.index') }}" class="w-50">
    <div class="form-group mb-2">
        <select name="categories[]" id="categories" multiple class="form-control">
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->title }}</option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-success">Фильтровать</button>
</form>
