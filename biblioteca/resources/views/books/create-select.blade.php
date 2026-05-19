@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Cadastrar Livro (Selecionando Componentes)</h1>

    {{-- Bloco global para exibição de erros de validação --}}
    @if ($errors->any())
        <div class="alert alert-danger shadow-sm">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            {{-- O atributo enctype="multipart/form-data" é obrigatório para o upload do arquivo binário --}}
            <form action="{{ route('books.store.select') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Campo: Título --}}
                <div class="mb-3">
                    <label for="title" class="form-label fw-bold">Título do Livro</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" placeholder="Digite o título do livro" required>
                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Campo: Autor --}}
                <div class="mb-3">
                    <label for="author_id" class="form-label fw-bold">Autor</label>
                    <select class="form-select @error('author_id') is-invalid @enderror" id="author_id" name="author_id" required>
                        <option value="" disabled {{ old('author_id') ? '' : 'selected' }}>Selecione um autor...</option>
                        @foreach($authors as $author)
                            {{-- Preserva a seleção caso haja erro de validação em outro campo --}}
                            <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                        @endforeach
                    </select>
                    @error('author_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Campo: Categoria --}}
                <div class="mb-3">
                    <label for="category_id" class="form-label fw-bold">Categoria</label>
                    <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                        <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Selecione uma categoria...</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Campo: Editora --}}
                <div class="mb-3">
                    <label for="publisher_id" class="form-label fw-bold">Editora</label>
                    <select class="form-select @error('publisher_id') is-invalid @enderror" id="publisher_id" name="publisher_id" required>
                        <option value="" disabled {{ old('publisher_id') ? '' : 'selected' }}>Selecione uma editora...</option>
                        @foreach($publishers as $publisher)
                            <option value="{{ $publisher->id }}" {{ old('publisher_id') == $publisher->id ? 'selected' : '' }}>{{ $publisher->name }}</option>
                        @endforeach
                    </select>
                    @error('publisher_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Campo: Páginas --}}
                <div class="mb-3">
                    <label for="pages" class="form-label fw-bold">Número de Páginas</label>
                    <input type="number" class="form-control @error('pages') is-invalid @enderror" id="pages" name="pages" value="{{ old('pages') }}" min="1" placeholder="Ex: 250" required>
                    @error('pages') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Campo: Imagem de Capa (Módulo 6) --}}
                <div class="mb-4">
                    <label for="cover_image" class="form-label fw-bold">Imagem de Capa <span class="text-muted fw-normal">(Opcional)</span></label>
                    <input type="file" class="form-control @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image" accept="image/jpeg,image/png,image/jpg">
                    <div class="form-text">Formatos aceitos: JPG, JPEG ou PNG. Tamanho máximo permitido: 2MB.</div>
                    @error('cover_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Botões de Ação --}}
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle"></i> Salvar Livro
                    </button>
                    <a href="{{ route('books.index') }}" class="btn btn-secondary">
                        <i class="bi bi-x-circle"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection