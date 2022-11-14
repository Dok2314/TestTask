<header class="p-3 bg-dark text-white">
<div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            <li><a href="{{ route('homePage') }}" class="nav-link px-2 text-secondary">Главная</a></li>
        </ul>

<div class="text-end">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('categories.index') }}">
                        <button type="button" class="btn btn-outline-light me-2">Категории</button>
                    </a>
                    <a href="{{ route('lots.index') }}">
                        <button type="button" class="btn btn-outline-light me-2">Лоты</button>
                    </a>
                </div>
            </div>
        </div>
</div>
    </div>
</div>
</header>
