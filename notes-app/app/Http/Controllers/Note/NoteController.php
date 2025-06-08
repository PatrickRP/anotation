<?php

namespace App\Http\Controllers\Note;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Note\Note;
use Illuminate\Support\Str;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::latest()->paginate(10);
        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(Request $request)
    {
        $note = Note::create($request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]));

        $this->syncBacklinks($note);

        return redirect()->route('notes.index')->with('success', 'Nota criada com sucesso.');
    }

    public function show(Note $note)
    {
        // Substituir [[Título]] por link real
        $content = preg_replace_callback('/\[\[(.*?)\]\]/', function ($matches) {
            $linked = Note::where('title', $matches[1])->first();
            if ($linked) {
                return '<a href="' . route('notes.show', $linked) . '">[[' . e($linked->title) . ']]</a>';
            }
            return '[[' . e($matches[1]) . ']]';
        }, $note->content);

        $noteHtml = Str::markdown($content);

        return view('notes.show', compact('note', 'noteHtml'));
    }

    public function edit(Note $note)
    {
        return view('notes.edit', compact('note'));
    }

    public function update(Request $request, Note $note)
    {
        $note->update($request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]));

        $this->syncBacklinks($note);

        return redirect()->route('notes.index')->with('success', 'Nota atualizada com sucesso.');
    }

    public function destroy(Note $note)
    {
        $note->delete();
        return redirect()->route('notes.index')->with('success', 'Nota deletada.');
    }

        private function syncBacklinks(Note $note)
    {
        // Remove links antigos
        $note->linkedNotes()->detach();

        // Procura por [[Nome da Nota]]
        preg_match_all('/\[\[(.*?)\]\]/', $note->content, $matches);
        $titles = array_unique($matches[1]);

        $linkedNotes = Note::whereIn('title', $titles)->get();

        $note->linkedNotes()->sync($linkedNotes->pluck('id'));
    }
}
