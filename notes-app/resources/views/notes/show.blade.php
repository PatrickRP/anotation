@extends('layout')

@section('title', $note->title)

@section('content')
    <div class="mb-3">
        <h2>{{ $note->title }}</h2>
        <p><small>Criada em {{ $note->created_at->format('d/m/Y H:i') }}</small></p>
    </div>

    <div class="mb-4">
        {!! $noteHtml !!}
    </div>

    @if ($note->backlinks->count())
        <h5>🔗 Backlinks</h5>
        <ul>
            @foreach ($note->backlinks as $backlink)
                <li><a href="{{ route('notes.show', $backlink) }}">{{ $backlink->title }}</a></li>
            @endforeach
        </ul>
    @endif

    <a href="{{ route('notes.edit', $note) }}" class="btn btn-warning">Editar</a>

    <form action="{{ route('notes.destroy', $note) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza?')">
        @csrf
        @method('DELETE')
        <button class="btn btn-danger">Excluir</button>
    </form>
@endsection