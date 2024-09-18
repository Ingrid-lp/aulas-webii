<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Genero extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function Livro()
    {
        return $this->belongsTo('App\Models\Livro');
    }

    public function Autor()
    {
        return $this->hasMany('App\Models\Livro');
    }
}

