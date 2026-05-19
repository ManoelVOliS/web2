@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Detalhes do Livro</h1>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4">
        <div class="card-header"><strong>Título:</strong> {{ $book->title }}</div>
        <div class="card-body">
            <p><strong>Autor:</strong> <a href="{{ route('authors.show', $book->author->id) }}">{{ $book->author->name }}</a></p>
            <p><strong>Páginas:</strong> {{ $book->pages }}</p>
            <p><strong>Editora:</strong> <a href="{{ route('publishers.show', $book->publisher->id) }}">{{ $book->publisher->name }}</a></p>
            <p><strong>Categoria:</strong> <a href="{{ route('categories.show', $book->category->id) }}">{{ $book->category->name }}</a></p>
        </div>
    </div>

    <div class="card mb-4"> {{-- [cite: 833] --}}
        <div class="card-header">Registrar Empréstimo</div> {{-- [cite: 834] --}}
        <div class="card-body"> {{-- [cite: 835] --}}
            <form action="{{ route('books.borrow', $book) }}" method="POST"> {{-- [cite: 836] --}}
                @csrf
                <div class="mb-3"> {{-- [cite: 838] --}}
                    <label for="user_id" class="form-label">Usuário</label> {{-- [cite: 839] --}}
                    <select class="form-select" id="user_id" name="user_id" required> {{-- [cite: 840] --}}
                        <option value="" selected disabled>Selecione um usuário</option> {{-- [cite: 841] --}}
                        @foreach($users as $user) {{-- [cite: 841] --}}
                            <option value="{{ $user->id }}">{{ $user->name }}</option> {{-- [cite: 842] --}}
                        @endforeach
                    </select> {{-- [cite: 843] --}}
                </div> {{-- [cite: 844] --}}
                <button type="submit" class="btn btn-success">Registrar Empréstimo</button> {{-- [cite: 845, 846] --}}
            </form> {{-- [cite: 847] --}}
        </div> {{-- [cite: 848] --}}
    </div> {{-- [cite: 849] --}}

    <div class="card"> {{-- [cite: 851] --}}
        <div class="card-header">Histórico de Empréstimos</div> {{-- [cite: 852] --}}
        <div class="card-body"> {{-- [cite: 853] --}}
            @if($book->users->isEmpty()) {{-- [cite: 854] --}}
                <p>Nenhum empréstimo registrado para este livro.</p> {{-- [cite: 855] --}}
            @else
                <table class="table table-bordered"> {{-- [cite: 857] --}}
                    <thead> {{-- [cite: 857] --}}
                        <tr> {{-- [cite: 859] --}}
                            <th>Usuário</th> {{-- [cite: 860] --}}
                            <th>Data de Empréstimo</th> {{-- [cite: 861] --}}
                            <th>Data de Devolução</th> {{-- [cite: 862] --}}
                            <th>Ações</th> {{-- [cite: 863] --}}
                        </tr> {{-- [cite: 864] --}}
                    </thead> {{-- [cite: 865] --}}
                    <tbody> {{-- [cite: 866] --}}
                        @foreach($book->users as $user) {{-- [cite: 867] --}}
                        <tr> {{-- [cite: 868] --}}
                            <td><a href="{{ route('users.show', $user->id) }}">{{ $user->name }}</a></td> {{-- [cite: 870, 871] --}}
                            <td>{{ $user->pivot->borrowed_at }}</td> {{-- [cite: 874] --}}
                            <td>{{ $user->pivot->returned_at ?? 'Em Aberto' }}</td> {{-- [cite: 875] --}}
                            <td> {{-- [cite: 876] --}}
                                @if(is_null($user->pivot->returned_at)) {{-- [cite: 878] --}}
                                    <form action="{{ route('borrowings.return', $user->pivot->id) }}" method="POST"> {{-- [cite: 879] --}}
                                        @csrf
                                        @method('PATCH') {{-- [cite: 881] --}}
                                        <button class="btn btn-warning btn-sm">Devolver</button> {{-- [cite: 882] --}}
                                    </form> {{-- [cite: 883] --}}
                                @else
                                    <span class="badge bg-success">Devolvido</span>
                                @endif
                            </td> {{-- [cite: 885] --}}
                        </tr> {{-- [cite: 886] --}}
                        @endforeach
                    </tbody> {{-- [cite: 888] --}}
                </table> {{-- [cite: 889] --}}
            @endif
        </div> {{-- [cite: 891] --}}
    </div> {{-- [cite: 892] --}}

    <a href="{{ route('books.index') }}" class="btn btn-secondary mt-3"><i class="bi bi-arrow-left"></i> Voltar</a>
</div>
@endsection