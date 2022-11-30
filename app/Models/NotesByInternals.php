<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class NotesByInternals extends Eloquent
{
    use HasFactory;

    protected $table = 'notes_by_internals';

    protected $id = '_id';

    protected $fillable = [
        'instruction_id',
        'history_data',
    ];
}