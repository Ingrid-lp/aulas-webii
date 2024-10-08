<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Livro extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function Autor()
    {
        return $this->belongsTo('App\Models\Autor');
    }

    public function Editora()
    {
        return $this->belongsTo('App\Models\Editora');
    }

    public function Genero()
    {
        return $this->belongsTo('App\Models\Genero');
    }
}

