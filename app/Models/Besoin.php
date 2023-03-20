<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Besoin extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'user_id',
        'titre'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
