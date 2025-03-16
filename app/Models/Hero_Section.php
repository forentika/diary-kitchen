<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero_Section extends Model
{
    use HasFactory;
    protected $table = 'hero_section';

        protected $fillable = [
            'header',
            'paragraph',
        ];
}