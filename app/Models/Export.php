<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Export extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_name',
        'url',
        'service',
    ];

    protected $casts = [
      'created_at' => 'datetime:d.m.Y'
    ];

    protected function url(): Attribute
    {
        return new Attribute(
          get: fn ($value) => url($value)
        );
    }
}
