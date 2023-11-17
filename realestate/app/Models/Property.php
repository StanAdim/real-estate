<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;
    protected $casts = [
        'files' => 'array',
    ];
    

    protected $fillable = [
        'name',
        'price',
        'user_id',
        'location',
        'is_available',
        'is_verified',
        'description',
        'files',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
