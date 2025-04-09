<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PasswordResets extends Model
{
    use HasFactory;
    protected $table = 'password_resets';
    public $timestamps = false; // Karena tabel ini tidak memiliki created_at dan updated_at dari Laravel
    protected $primaryKey = 'email';
    public $incrementing = false;
    protected $fillable = ['email', 'token', 'created_at'];
}
