<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'path',
        'type',
        'size',
        'likes',
        'saves',
        'shares',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
