@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Detalhes do Usuário</h1>
    
    <div class="card mb-4">
        <div class="card-header">{{ $user->name }}</div> {{-- [cite: 1030] --}}
        <div class="card-body"> {{-- [cite: 1032] --}}
            <p><strong>Email:</strong> {{ $user->email }}</p> {{-- [cite: 1033] --}}
        </div> {{-- [cite: 1034] --}}
    </div> {{-- [cite: 1035] --}}

    <div class="card"> {{-- [cite: 896] --}}
        <div class="card-header">Histórico de Empréstimos</div> {{-- [cite: 897] --}}
        <div class="card-body">
            @if($user->books->isEmpty()) {{-- [cite: 898] --}}
                <p>Este usuário não possui empréstimos registrados.</p> {{-- [cite: 899] --}}
            @else
                <table class="table table-bordered"> {{-- [cite: 900] --}}
                    <thead> {{-- [cite: 900] --}}
                        <tr> {{-- [cite: 902] --}}
                            <th>Livro</th> {{-- [cite: 903] --}}
                            <th>Data de Empréstimo</th> {{-- [cite: 904] --}}
                            <th>Data de Devolução</th> {{-- [cite: 905] --}}
                            <th>Ações</th> {{-- [cite: 906] --}}
                        </tr> {{-- [cite: 907] --}}
                    </thead> {{-- [cite: 908] --}}
                    <tbody> {{-- [cite: 909] --}}
                        @foreach($user->books as $book) {{-- [cite: 910] --}}
                        <tr> {{-- [cite: 911] --}}
                            <td><a href="{{ route('books.show', $book->id) }}">{{ $book->title }}</a></td> {{-- [cite: 912, 913, 914] --}}
                            <td>{{ $book->pivot->borrowed_at }}</td> {{-- [cite: 917, 918] --}}
                            <td>{{ $book->pivot->returned_at ?? 'Em Aberto' }}</td> {{-- [cite: 919, 920] --}}
                            <td> {{-- [cite: 921] --}}
                                @if(is_null($book->pivot->returned_at)) {{-- [cite: 923] --}}
                                    <form action="{{ route('borrowings.return', $book->pivot->id) }}" method="POST"> {{-- [cite: 924] --}}
                                        @csrf
                                        @method('PATCH') {{-- [cite: 926] --}}
                                        <button class="btn btn-warning btn-sm">Devolver</button> {{-- [cite: 927] --}}
                                    </form> {{-- [cite: 928] --}}
                                @else
                                    <span class="badge bg-success">Devolvido</span>
                                @endif
                            </td> {{-- [cite: 930] --}}
                        </tr> {{-- [cite: 931] --}}
                        @endforeach
                    </tbody> {{-- [cite: 933] --}}
                </table> {{-- [cite: 934] --}}
            @endif
        </div>
    </div>

    <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3"><i class="bi bi-arrow-left"></i> Voltar</a>
</div>
@endsection