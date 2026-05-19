@extends('layouts.app') {{-- [cite: 1042] --}}

@section('content') {{-- [cite: 1043] --}}
<div class="container"> {{-- [cite: 1044] --}}
    <h1 class="my-4">Editar Usuário</h1> {{-- [cite: 1045] --}}
    
    <form action="{{ route('users.update', $user) }}" method="POST"> {{-- [cite: 1046] --}}
        @csrf
        @method('PUT') {{-- [cite: 1047] --}}
        
        <div class="mb-3"> {{-- [cite: 1048] --}}
            <label for="name" class="form-label">Nome</label> {{-- [cite: 1049] --}}
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required> {{-- [cite: 1050, 1051] --}}
        </div> {{-- [cite: 1051] --}}
        
        <div class="mb-3"> {{-- [cite: 1052] --}}
            <label for="email" class="form-label">Email</label> {{-- [cite: 1054] --}}
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required> {{-- [cite: 1055, 1056] --}}
        </div> {{-- [cite: 1057] --}}
        
        <button type="submit" class="btn btn-success">Salvar</button> {{-- [cite: 1058] --}}
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancelar</a> {{-- [cite: 1059, 1063] --}}
    </form> {{-- [cite: 1060] --}}
</div> {{-- [cite: 1061] --}}
@endsection {{-- [cite: 1062] --}}