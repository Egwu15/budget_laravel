<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name, default, user_id'];

    public function transactions()
    {
        $this->hasMany(Transaction::class);
    }

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
