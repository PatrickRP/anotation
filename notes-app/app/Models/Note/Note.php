<?php

namespace App\Models\Note;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content'];

    public function linkedNotes()
    {
        return $this->belongsToMany(Note::class, 'note_relationships', 'source_note_id', 'linked_note_id')
                    ->withTimestamps();
    }

    public function backlinks()
    {
        return $this->belongsToMany(Note::class, 'note_relationships', 'linked_note_id', 'source_note_id')
                    ->withTimestamps();
    }
}
