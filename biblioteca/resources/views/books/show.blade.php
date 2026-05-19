@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Detalhes do Livro</h1>
    
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card mb-4 shadow-sm">
        <div class="row g-0">
            <div class="col-md-3 text-center p-3 bg-light d-flex align-items-center justify-content-center border-end rounded-start">
                <img src="{{ $book->cover_image ? asset('storage/' . $book->cover_image) : asset('images/default-cover.png') }}" 
                     alt="Capa do Livro: {{ $book->title }}" 
                     class="img-fluid rounded shadow" 
                     style="max-height: 280px; object-fit: cover;">
            </div>
            
            <div class="col-md-9">
                <div class="card-header bg-white border-bottom-0 pt-3">
                    <h3 class="card-title text-primary mb-0">{{ $book->title }}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <p><strong>Autor:</strong> {{ $book->author->name }}</p>
                            <p><strong>Páginas:</strong> <span class="badge bg-secondary">{{ $book->pages }} págs</span></p>
                        </div>
                        <div class="col-sm-6">
                            <p><strong>Editora:</strong> {{ $book->publisher->name }}</p>
                            <p><strong>Categoria:</strong> {{ $book->category->name }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-dark text-white">Registrar Novo Empréstimo</div>
                <div class="card-body d-flex flex-column justify-content-between">
                    <form action="{{ route('books.borrow', $book->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="user_id" class="form-label">Selecionar Usuário</label>
                            <select class="form-select @error('user_id') is-invalid @enderror" id="user_id" name="user_id" required>
                                <option value="" selected disabled>Escolha o leitor...</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                                @endforeach
                            </select>
                            @error('user_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <button type="submit" class="btn btn-success w-100">
                            <i class="bi bi-journal-plus"></i> Conceder Empréstimo
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-8 mb-4">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-dark text-white">Histórico de Movimentações</div>
                <div class="card-body">
                    @if($book->users->isEmpty())
                        <div class="text-center py-4 text-muted">
                            <i class="bi bi-archive style=font-size: 2rem;"></i>
                            <p class="mt-2 mb-0">Nenhum empréstimo registrado para este livro até o momento.</p>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Usuário</th>
                                        <th>Retirada</th>
                                        <th>Devolução</th>
                                        <th class="text-center">Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($book->users as $user)
                                    <tr>
                                        <td>
                                            <a href="{{ route('users.show', $user->id) }}" class="text-decoration-none fw-bold">
                                                {{ $user->name }}
                                            </a>
                                        </td>
                                        <td class="small">{{ $user->pivot->borrowed_at }}</td>
                                        <td class="small">
                                            {{ $user->pivot->returned_at ?? 'Em Aberto' }}
                                        </td>
                                        <td class="text-center">
                                            @if(is_null($user->pivot->returned_at))
                                                <form action="{{ route('borrowings.return', $user->pivot->id) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-warning btn-sm">
                                                        <i class="bi bi-arrow-counterclockwise"></i> Devolver
                                                    </button>
                                                </form>
                                            @else
                                                <span class="badge bg-success p-2">Devolvido</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <a href="{{ route('books.index') }}" class="btn btn-secondary shadow-sm">
        <i class="bi bi-arrow-left"></i> Voltar para a Listagem
    </a>
</div>
@endsection