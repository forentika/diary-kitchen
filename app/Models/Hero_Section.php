<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero_Section extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_hero_section';
    protected $table = 'hero_section';
    public $incrementing = false;

        protected $fillable = [
            'id_hero_section',
            'header',
            'paragraph',
            'active',
        ];
        protected $casts = [
            'active' => 'boolean',
        ];
}