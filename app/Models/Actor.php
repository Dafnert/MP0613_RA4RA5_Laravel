<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Actor extends Model
{
    use HasFactory;
    protected $table = "actors";
    protected $fillable = ['name', 'surname', 'birthdate', 'country', 'salary', 'img_url'];

    public function films()
    {
        return $this->belongsToMany(Film::class);
    }
}
