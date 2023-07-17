<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    use HasFactory;

    const ADMIN = 1;
    const USER = 2;
    const API = 3;

    const ROLES = [
        self::ADMIN => 'admin',
        self::USER => 'user',
        self::API => 'api',
    ];

    protected $fillable = [
        'name',
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}
