<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    
    
    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }
    public function element()
    {
        return $this->belongsTo(Element::class);
    }
}
