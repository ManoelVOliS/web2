@extends('layouts.app') {{-- [cite: 986] --}}

@section('content') {{-- [cite: 987] --}}
<div class="container"> {{-- [cite: 988] --}}
    <h1 class="my-4">Lista de Usuários</h1> {{-- [cite: 989] --}}
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped"> {{-- [cite: 990] --}}
        <thead> {{-- [cite: 992] --}}
            <tr> {{-- [cite: 993] --}}
                <th>ID</th> {{-- [cite: 994] --}}
                <th>Nome</th> {{-- [cite: 995] --}}
                <th>Email</th> {{-- [cite: 996] --}}
                <th>Ações</th> {{-- [cite: 997] --}}
            </tr> {{-- [cite: 998] --}}
        </thead> {{-- [cite: 999] --}}
        <tbody> {{-- [cite: 1000] --}}
            @foreach($users as $user) {{-- [cite: 1001] --}}
            <tr> {{-- [cite: 1002] --}}
                <td>{{ $user->id }}</td> {{-- [cite: 1003] --}}
                <td>{{ $user->name }}</td> {{-- [cite: 1004] --}}
                <td>{{ $user->email }}</td> {{-- [cite: 1005] --}}
                <td> {{-- [cite: 1006] --}}
                    <a href="{{ route('users.show', $user) }}" class="btn btn-info btn-sm"> {{-- [cite: 1007] --}}
                        <i class="bi bi-eye"></i> Visualizar {{-- [cite: 1008] --}}
                    </a>
                    <a href="{{ route('users.edit', $user) }}" class="btn btn-primary btn-sm"> {{-- [cite: 1011] --}}
                        <i class="bi bi-pencil"></i> Editar {{-- [cite: 1012] --}}
                    </a>
                </td> {{-- [cite: 1014] --}}
            </tr> {{-- [cite: 1015] --}}
            @endforeach
        </tbody> {{-- [cite: 1016] --}}
    </table> {{-- [cite: 1017] --}}
    
    <div class="d-flex justify-content-center"> {{-- [cite: 1018] --}}
        {{ $users->links() }} {{-- [cite: 1019] --}}
    </div> {{-- [cite: 1020] --}}
</div> {{-- [cite: 1021] --}}
@endsection {{-- [cite: 1022] --}}