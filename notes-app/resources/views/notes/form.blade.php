@extends('layout')

@section('title', $title = isset($note) ? 'Editar Nota' : 'Nova Nota')

@section('content')
    <form action="{{ isset($note) ? route('notes.update', $note) : route('notes.store') }}" method="POST">
        @csrf
        @if(isset($note)) @method('PUT') @endif

        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" id="title" name="title" class="form-control" required
                   value="{{ old('title', $note->title ?? '') }}">
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Conteúdo (Markdown)</label>
            <textarea id="content" name="content" class="form-control" rows="10" required>{{ old('content', $note->content ?? '') }}</textarea>
        </div>

        <button class="btn btn-success">{{ isset($note) ? 'Salvar alterações' : 'Criar nota' }}</button>
    </form>
@endsection