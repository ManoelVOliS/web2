@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Cadastrar Livro (Inserindo ID)</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <form action="{{ route('books.store.id') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="title" class="form-label">Título do Livro</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="author_id" class="form-label">ID do Autor</label>
                    <input type="number" class="form-control @error('author_id') is-invalid @enderror" id="author_id" name="author_id" value="{{ old('author_id') }}" required>
                    @error('author_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="category_id" class="form-label">ID da Categoria</label>
                    <input type="number" class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" value="{{ old('category_id') }}" required>
                    @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="publisher_id" class="form-label">ID da Editora</label>
                    <input type="number" class="form-control @error('publisher_id') is-invalid @enderror" id="publisher_id" name="publisher_id" value="{{ old('publisher_id') }}" required>
                    @error('publisher_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="pages" class="form-label">Número de Páginas</label>
                    <input type="number" class="form-control @error('pages') is-invalid @enderror" id="pages" name="pages" value="{{ old('pages') }}" required>
                    @error('pages') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="cover_image" class="form-label">Imagem de Capa (Opcional)</label>
                    <input type="file" class="form-control @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image" accept="image/*">
                    <div class="form-text">Formatos permitidos: jpg, jpeg, png. Máximo: 2MB.</div>
                    @error('cover_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-success">
                    <i class="bi bi-check-circle"></i> Salvar Livro
                </button>
                <a href="{{ route('books.index') }}" class="btn btn-secondary">Cancelar</a>
            </form>
        </div>
    </div>
</div>
@endsection