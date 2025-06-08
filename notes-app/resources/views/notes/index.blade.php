@extends('layout')

@section('title', 'Lista de Notas')

@section('content')
    <a href="{{ route('notes.create') }}" class="btn btn-primary mb-3">Nova Nota</a>

    @forelse ($notes as $note)
        <div class="mb-3">
            <h4><a href="{{ route('notes.show', $note) }}">{{ $note->title }}</a></h4>
            <small>Atualizada em {{ $note->updated_at->format('d/m/Y H:i') }}</small>
        </div>
    @empty
        <p>Nenhuma nota encontrada.</p>
    @endforelse

    {{ $notes->links() }}
@endsection